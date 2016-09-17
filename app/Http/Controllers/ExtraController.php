<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CvUpdateRequest;
use App\Http\Requests\CardAvsRequest;
use App\Http\Requests\ExtraSubmitRequest;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ProfileController;

use App\Models\User;
use App\Models\Student;
use App\Models\Professional;
use App\Models\Cv;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Extra;

use App\Repositories\CvRepository;
use App\Repositories\StudentRepository;
use App\Repositories\ProfessionalRepository;
use App\Repositories\UserRepository;
use App\Repositories\ExtraRepository;
use App\Repositories\ExperienceRepository;
use App\Repositories\EducationRepository;
use App\Repositories\SkillRepository;
use App\Repositories\LanguageRepository;

use Carbon\Carbon;

use Auth, DB, Validator, Mail;

class ExtraController extends Controller
{
	protected $extraRepository;
	protected $professionalRepository;

	public function __construct(ExtraRepository $extraRepository,
	                          ProfessionalRepository $professionalRepository)
	{
		$this->middleware('auth');
		$this->extraRepository = $extraRepository;
		$this->professionalRepository = $professionalRepository;
	}

	public function show ($username, $extraId){
		$id = Auth::user()->id;
		$modif = 0;

		if(Auth::user()->type == 0)
		{
			$student = User::find($id)->student;
			$first_name = $student->first_name;
			$last_name = $student->last_name;
			$name = $first_name . " " . $last_name;
		}
		else
		{
			$name = null;
		}
			$extra = Extra::find($extraId);
			$professional = Professional::find($extra->professional_id);
			$email_pro = User::find($professional->user_id)->email;

		if($professional->user_id == $id){
			$modif = 1;
		}
		return view('user.extra-only', ['username' => $username, 'user' => Auth::user(), 'professional' => $professional, 'extra' => $extra, 'email' => $email_pro, 'edit_ok' => $modif])->with('name', $name);
	}
	public function showList($username, $type_extra)
	{

		$id = Auth::user()->id;
		$type = User::find($id)->type;
		if($type == 0)
		{
			$student = User::find($id)->student;
			$first_name = $student->first_name;
			$last_name = $student->last_name;
			$name = $first_name . " " . $last_name;
			if($type_extra == 'Tout')
			{
				$extras = Extra::where('find', 0)->get();
			} else {
				$extras = Extra::where('type', $type_extra)->where('find', 0)->get();
			}

      //On récupère le nom des professionnels qui proposent des extras
			$professionals = array();
			for($i=0; $i < count($extras); $i++)
			{
				array_push($professionals, Professional::find($extras[$i]->professional_id));
			}
			$can_apply = 0;
			if(!$student->extras->contains('id', $extras[0]->id)){
				$can_apply = 1;
			}
			$email_pro = User::find($professionals[0]->user_id)->email;
			return view('user.extra', ['extras' => $extras, 'user' => Auth::user(), 'professional' => $professionals, 'username' => $id, 'student' => $student, 'can_apply' => $can_apply, 'email' => $email_pro])->with('name', $name);
		}
	}

	public function submit(ExtraSubmitRequest $request)
	{
		$id = Auth::user()->id;
		$professionalID = User::find($id)->professional->id;
		$type = config('international.last_minute_types')[$request->input('type')];
		$date_time = preg_split("/[\s,]+/", $request->input('date'));
		$date = Carbon::createFromFormat('d/m/Y', $date_time[0], 'America/Mexico_City');
		$date->setTimezone('UTC');
		$time = Carbon::createFromFormat('H:i', $date_time[1], 'America/Mexico_City');
		$time->setTimezone('UTC');
		$last_minute = $request->input('broadcast') == 'last_minute';
		$extraInput = array(
			'broadcast' => $last_minute,
			'type' => $type,
			'date' => $date->format('Y-m-d'),
			'date_time' => $time->format('H:i'),
			'duration' => $request->input('duration'),
			'salary' => $request->input('salary'),
			'requirements' => $request->input('requirements'),
			'benefits' => $request->input('benefits'),
			'informations' => $request->input('informations'),
			'professional_id' => $professionalID,
			'find' => 0,
			);

		$credit_left = Professional::find($professionalID)->credit;

		if($last_minute == 0)
		{
			$professional = $this->professionalRepository->update($professionalID, ['credit' => $credit_left - 1]);
		} else
		{
			$professional = $this->professionalRepository->update($professionalID, ['credit' => $credit_left - 3]);
		}

		$extra = $this->extraRepository->store($extraInput);

		return redirect()->route('home', Auth::user()->id);
	}

	public static function apply($username, $id)
	{
		try
		{
			$student = Auth::user()->student;
			DB::table('extras_students')->insert(array(
				'extra_id' => $id,
				'student_id' => $student->id,
				'done' => 0,
				));
			$extra = Extra::find($id);
			$professionalUser = $extra->professional->user;
			$student_name = $student->first_name.' '.$student->last_name;
			$notif_to_send = $student_name.' subscribed to your Extra : '.$extra->type;
			Mail::send('mails.notification', ['notification' => $notif_to_send, 'user' => $professionalUser], function($message) use ($professionalUser){
				$message->to($professionalUser->email)->subject('New notification ExtrasMe');
			});
			return redirect()->back();
		}
		catch (Exception $e)
		{
			dd($e);
			abort(404);
		}
	}

	public function search(Request $request)
	{
		$input = config('international.last_minute_types')[$request->input('type')];
		return redirect()->route('extra_list', ['username' => Auth::user()->id, 'type_extra' => $input]);
	}


	public function myExtras()
	{
		$id = Auth::user()->id;
		$professionalID = User::find($id)->professional->id;
		$extras = Professional::find($professionalID)->extra()->where('date', '>=', Carbon::now())->orderBy('date', 'ASC')->get();
		$name = User::find($id)->professional->company_name;
		$student = null;
		$studentToSort = [];

		if(count($extras) > 0)
		{
			$find = DB::table('extras_students')->where('extra_id', $extras[0]->id)
				->where('done', 1)->get();

			if(!empty($find))
			{
				if($find[0]->done == 1)
				{
					$student = Student::find($find[0]->student_id);
				}
			} else
			{
				$students = $extras[0]->students;

				if(!empty($students))
				{
					foreach ($students as $student) {
						$numberExtra = DB::table('number_extras_establishement')->where('student_id', $student->id)
						->where('professional_id', $professionalID)->value('number_extras');

						$studentToSort[] = array($student, $numberExtra);
					}

					usort($studentToSort, function($a, $b)
					{
					    return $b[1] - $a[1];
					});
				}
			}
		}
		return view('user.myExtrasList', ['user' => Auth::user(), 'professional' => User::find($id)->professional, 'extras' => $extras, 'username' => $id, 'name' => $name, 'student' => $student, 'students' => $studentToSort]);
	}

	public static function acceptExtra($extraID, $studentID)
	{
		DB::table('extras_students')->where('extra_id', $extraID)
			->where('student_id', $studentID)
			->update(['done' => 1]);

		DB::table('extras')->where('id', $extraID)->update(['find' => 1]);

		$extra = Extra::find($extraID);
		$professional = $extra->professional;
		$studentUser = Student::find($studentID)->user;

		$notif_to_send = $professional->company_name." accepted you for the Extra : ".$extra->type." the ".$extra->date." at ".$extra->date_time.".";

		Mail::send('mails.notification', ['notification' => $notif_to_send, 'user' => $studentUser], function($message) use ($studentUser){

				$message->to($studentUser->email)->subject('New notification ExtrasMe');
		});

		return redirect()->back();
	}

	public function showModifyExtra($username, $extraID)
	{
		$name = null;
		$id = Auth::user()->id;
		$extra = Extra::find($extraID);
		$professional = Professional::find($extra->professional_id);
		$email_pro = User::find($professional->user_id)->email;

		if($professional->user_id == $id){
			$modif = 1;
		}
		return view('user.extra-only-modify', ['username' => $username, 'user' => Auth::user(), 'professional' => $professional, 'extra' => $extra, 'email' => $email_pro, 'edit_ok' => $modif])->with('name', $name);
	}

	public function modifyExtra($username, $extraID, Request $request)
	{
		$save = $request->input('save');
		$date = [];
		$i = 0;

		if($save == 1)
		{
			$type = config('international.last_minute_types')[$request->input('type')];
			$date_time = $request->input('date');
			foreach(explode(' ', $date_time) as $info) 
			{
				if($i == 0)
					$date[$i] = Carbon::createFromFormat('d/m/Y', $info, 'America/Mexico_City');
				elseif($i == 1)
					$date[$i] = Carbon::createFromFormat('H:i', $info, 'America/Mexico_City');

				$date[$i]->setTimezone('UTC');
				$i++;
			}
			$extraInput = array(
				'type' => $type,
				'date' => $date[0]->format('Y-m-d'),
				'date_time' => $date[1]->format('H:i'),
				'duration' => $request->input('duration'),
				'salary' => $request->input('salary'),
				'requirements' => $request->input('requirements'),
				'benefits' => $request->input('benefits'),
				'informations' => $request->input('informations'),
				);

			$this->extraRepository->update($extraID, $extraInput);
		}

		return redirect()->back();
	}

	public function deleteExtra($username, $extraID)
	{
		$this->extraRepository->destroy($extraID);

		return redirect()->route('home', Auth::user()->id);
	}

	public function showFavorite()
	{
		$id = Auth::user()->id;
		$results = null;

		if(User::find($id)->type == 0)
		{
			$name = User::find($id)->student->first_name." ".User::find($id)->student->last_name;
			$student = User::find($id)->student;
			$studentID = $student->id;
			$results = Student::find($studentID)->professionals()->where('type', 0)->get();
			try{
	          $cvID = $student->cv->id;
	          $experiences = Cv::find($cvID)->experiences;
	          $educations = Cv::find($cvID)->educations;
	          $languages = Cv::find($cvID)->languages;
	          $skills = Cv::find($cvID)->skills;
	        } catch(\Exception $e){
	          $experiences = null;
	          $educations = null;
	          $languages = null;
	          $skills = null;
	        }

			return view('user.favExtrasList', ['name' => $name, 'results' => $results, 'student' => $student, 'experiences' => $experiences, 'educations' => $educations, 'languages' => $languages, 'skills' => $skills, 'back' => false]);
		}
		else if(User::find($id)->type == 1)
		{
			$experiences = null;
			$educations = null;
			$languages = null;
			$skills = null;

			$name = User::find($id)->professional->company_name;
			$professionalID = User::find($id)->professional->id;
			$results = Professional::find($professionalID)->students()->where('type', 1)->get();

			return view('user.favExtrasList', ['name' => $name, 'results' => $results, 'professional' => User::find($id)->professional,'experiences' => $experiences, 'educations' => $educations, 'languages' => $languages, 'skills' => $skills, 'back' => false]);
		}
	}

	public function showFavoriteSearch(Request $favoriteSearchRequest)
	{

		$favoriteName = $favoriteSearchRequest->input('searchFav');

		$id = Auth::user()->id;

		$experiences = null;
		$educations = null;
		$languages = null;
		$skills = null;

		if(User::find($id)->type == 0)
		{
			$name = User::find($id)->student->first_name." ".User::find($id)->student->last_name;
			$results = DB::table('professionals')->where('company_name', $favoriteName)->get();
		}
		else if(User::find($id)->type == 1)
		{
			$name = User::find($id)->professional->company_name;
			list($first_name, $last_name) = explode(" ", $favoriteName);
			$results = DB::table('students')->where('last_name', $last_name)->where('first_name', $first_name)->get();

			return view('user.favExtrasList', ['name' => $name, 'results' => $results, 'professional' => User::find($id)->professional,'experiences' => $experiences, 'educations' => $educations, 'languages' => $languages, 'skills' => $skills, 'back' => true]);
		}
	}

	public static function favoriteAdd($id)
	{
		$AuthID = Auth::user()->id;
		$test = NULL;

		if(User::find($AuthID)->type == 0)
		{
			$studentID = User::find($AuthID)->student->id;
			$results = Student::find($studentID)->professionals()->where('type', 0)->get();

			if(sizeof($results) < 5 && $test == NULL)
			{
				DB::table('favoris')->insert(array(
					'professional_id' => $id,
					'student_id' => Auth::user()->student->id,
					'type' => 0,
					));
			}
		}
		else if(User::find($AuthID)->type == 1)
		{
			$professionalID = User::find($AuthID)->professional->id;
			$results = Professional::find($professionalID)->students()->where('type', 1);

			if(sizeof($results) < 5 && $test == NULL)
			{
				DB::table('favoris')->insert(array(
					'professional_id' => Auth::user()->professional->id,
					'student_id' => $id,
					'type' => 1,
					));
			}
		}

		return redirect()->route('my_favorite_extras', Auth::user()->id);
	}

	public static function favoriteDelete($id)
	{
		$AuthID = Auth::user()->id;

		if(User::find($AuthID)->type == 0)
		{
			$studentID = User::find($AuthID)->student->id;
			$results = Student::find($studentID)->professionals()->where('type', 0)->detach($id);
		}
		else if(User::find($AuthID)->type == 1)
		{
			$professionalID = User::find($AuthID)->professional->id;
			$results = Professional::find($professionalID)->students()->where('type', 1)->detach($id);
		}

		return redirect()->route('my_favorite_extras', Auth::user()->id);
	}
}
