<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CvUpdateRequest;
use App\Http\Requests\CardAvsRequest;
use App\Http\Requests\ExtraSubmitRequest;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;

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

use Auth, DB, Validator, Mail, Route;

class ExtraController extends Controller
{
	protected $extraRepository;
	protected $professionalRepository;
	protected $dashboardController;

	public function __construct(ExtraRepository $extraRepository,
	                          ProfessionalRepository $professionalRepository,
	                          DashboardController $dashboardController)
	{
		$this->middleware('auth');
		$this->extraRepository = $extraRepository;
		$this->professionalRepository = $professionalRepository;
		$this->dashboardController = $dashboardController;
	}

	public function show ($username, $extraId){
		$id = Auth::user()->id;
		$modif = 0;
		$can_apply = null;

		if(Auth::user()->type == 0)
		{
			$student = User::find($id)->student;
			$first_name = $student->first_name;
			$last_name = $student->last_name;
			$name = $first_name . " " . $last_name;

			$alreadyApplied = DB::table('extras_students')->where('extra_id', $extraId)
							->where('student_id', $student->id)->get();
			
			if(count($alreadyApplied) == 0)
			{
				$can_apply = 1;
			}
		}
		else
		{
			$name = null;
			$student = null;
		}
			$extra = Extra::find($extraId);
			$professional = Professional::find($extra->professional_id);
			$email_pro = User::find($professional->user_id)->email;

		if($professional->user_id == $id){
			$modif = 1;
		}

		session()->put('returnAfterModifyExtra', Route::current()->getName());

		return view('user.extra-only', ['username' => $username, 'user' => Auth::user(), 'professional' => $professional, 'extra' => $extra, 'email' => $email_pro, 'edit_ok' => $modif, 'student' => $student, 'can_apply' => $can_apply])->with('name', $name);
	}

	public function showList($username, $type_extra, $date)
	{

		try
		{
			$id = Auth::user()->id;
			$type = User::find($id)->type;

			if($type == 0)
			{
				$student = User::find($id)->student;
				$first_name = $student->first_name;
				$last_name = $student->last_name;
				$name = $first_name . " " . $last_name;

				$dateMinest = Carbon::createFromFormat('Y-m-d', $date)->subDays(3)->toDateString();
				$datePlus = Carbon::createFromFormat('Y-m-d', $date)->addDays(3)->toDateString();

				if($type_extra == 'Tout')
				{
					if($student->group == 1)
					{
						$extras = Extra::where('find', 0)->whereBetween('date_start', [$dateMinest, $datePlus])->get();
					}
					else
					{
						$extras = Extra::where('find', 0)->whereBetween('date_start', [$dateMinest, $datePlus])->where('open', 1)->get();
					}

				} else {
					
					if($student->group == 1)
					{
						$extras = Extra::where('type', $type_extra)->where('find', 0)->whereBetween('date_start', [$dateMinest, $datePlus])->get();
					}
					else
					{
						$extras = Extra::where('type', $type_extra)->where('find', 0)->whereBetween('date_start', [$dateMinest, $datePlus])->get();
					}
				}

	      //On récupère le nom des professionnels qui proposent des extras
				$professionals = array();
				for($i=0; $i < count($extras); $i++)
				{
					array_push($professionals, Professional::find($extras[$i]->professional_id));
				}
				$can_apply = 0;
				$email_pro = null;

				if($extras->first())
				{
					if(!$student->extras->contains('id', $extras[0]->id)){
						$can_apply = 1;
					}

					$email_pro = User::find($professionals[0]->user_id)->email;
				}

				return view('user.extra', ['extras' => $extras, 'user' => Auth::user(), 'professional' => $professionals, 'username' => $id, 'student' => $student, 'can_apply' => $can_apply, 'email' => $email_pro])->with('name', $name);
			}
		}
		catch(\Exception $e)
		{
			dd($e);
		}
	}

	public function submit(ExtraSubmitRequest $request)
	{
		$id = Auth::user()->id;
		$professionalID = User::find($id)->professional->id;
		$type = config('international.last_minute_types')[$request->input('type')];
		$language = config('international.language')[$request->input('language')];
		$date_time_start = preg_split("/[\s,]+/", $request->input('date_start'));
		$date_start = Carbon::createFromFormat('d/m/Y', $date_time_start[0]);
		$date_start->setTimezone('UTC');
		$time_start = Carbon::createFromFormat('H:i', $date_time_start[1]);
		$time_start->setTimezone('UTC');
		$date_time_finish = preg_split("/[\s,]+/", $request->input('date_finish'));
		$date_finish = Carbon::createFromFormat('d/m/Y', $date_time_finish[0]);
		$date_finish->setTimezone('UTC');
		$time_finish = Carbon::createFromFormat('H:i', $date_time_finish[1]);
		$time_finish->setTimezone('UTC');
		$last_minute = $request->input('broadcast') == 'last_minute';
		$duration = Carbon::parse($date_start.' '.$time_start)->diffInHours(Carbon::parse($date_finish.' '.$time_finish));
		$extraInput = array(
			'broadcast' => $last_minute,
			'type' => $type,
			'date_start' => $date_start->format('Y-m-d'),
			'date_start_time' => $time_start->format('H:i'),
			'date_finish' => $date_finish->format('Y-m-d'),
			'date_finish_time' => $time_finish->format('H:i'),
			'duration' => $duration,
			'number_persons' => $request->input('numberPerson'),
			'salary' => $request->input('salary'),
			'language' => $language,
			'requirements' => $request->input('requirements'),
			'benefits' => $request->input('benefits'),
			'informations' => $request->input('informations'),
			'professional_id' => $professionalID,
			'find' => 0,
			'open' => 0,
			'created_at' => Carbon::now(),
			'updated_at' => Carbon::now(),
			);

		$credit_left = Professional::find($professionalID)->credit;

		if($last_minute == 0)
		{
			$professional = $this->professionalRepository->update($professionalID, ['credit' => $credit_left - $request->input('numberPerson')]);
		} else
		{
			$professional = $this->professionalRepository->update($professionalID, ['credit' => $credit_left - (3 * $request->input('numberPerson'))]);
		}

		$extra = $this->extraRepository->store($extraInput);

		$students = Student::where('group', 1)->get();

		foreach ($students as $student) {

			$notif_to_send = User::find($id)->professional->company_name.' just posted an extra in '.$extra->type.'. To see the extra visit the link below  : '.route('show_extra', [$student->user->id, $extra->id]);

			Mail::send('mails.notification', ['notification' => $notif_to_send, 'user' => $student->user], function($message) use ($student){
				$message->to($student->user->email)->subject('New notification ExtrasMe');
			});
		}

		$message = "Votre Extras a bien été enregistré !";

		return redirect()->route('home', Auth::user()->id)->with('message', $message);
	}

	public static function apply($username, $id)
	{
		try
		{
			$student = Auth::user()->student;
			DB::table('extras_students')->insert(array(
				'extra_id' => $id,
				'student_id' => $student->id,
				'doing' => 0,
				'created_at' => Carbon::now(),
				'updated_at' => Carbon::now(),
				));

			$extra = Extra::find($id);
			$professionalUser = $extra->professional->user;
			$student_name = $student->first_name.' '.$student->last_name;
			$notif_to_send = $student_name.' subscribed to your Extra : '.$extra->type;

			Mail::send('mails.notification', ['notification' => $notif_to_send, 'user' => $professionalUser], function($message) use ($professionalUser){
				$message->to($professionalUser->email)->subject('New notification ExtrasMe');
			});

			$message = "Votre soumission à l'extra à bien été enregistrée!";

			return redirect()->back()->with('message', $message);
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
		$date = Carbon::createFromFormat('d/m/Y', $request->input('date_start'));
		$date = $date->toDateString();

		return redirect()->route('extra_list', ['username' => Auth::user()->id, 'type_extra' => $input, 'date' => $date]);
	}

	public function cancelApplication($username, $id)
	{
		try
		{
			$student = Auth::user()->student;
			DB::table('extras_students')->where('extra_id' , $id)
					->where('student_id' , $student->id)->delete();

			$find= DB::table('extras')->where('id', $id)->value('find');

			if($find == 1)
			{
				DB::table('extras')->where('id', $id)->update(['find' => 0]);
			}

			$extra = Extra::find($id);
			$professionalUser = $extra->professional->user;
			$student_name = $student->first_name.' '.$student->last_name;
			$notif_to_send = $student_name.' cancel his application to your Extra : '.$extra->type;

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


	public function myExtras()
	{
		$id = Auth::user()->id;
		$professionalID = User::find($id)->professional->id;
		$extras = Professional::find($professionalID)->extra()->where('date_start', '>=', Carbon::now())->orderBy('date_start', 'ASC')->get();
		$name = User::find($id)->professional->company_name;
		$students = null;
		$studentsAlreadyChosen = null;
		$studentToSort = [];

		if(count($extras) > 0)
		{
			$find = DB::table('extras_students')->where('extra_id', $extras[0]->id)
				->where('doing', 1)->get();

			if(count($find) == $extras[0]->number_persons)
			{
				$studentsAlreadyChosen = $extras[0]->students()->where('doing', 1)->get();

			} else
			{
				$students = $extras[0]->students()->where('doing', 0)->get();

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

				$studentsAlreadyChosen = $extras[0]->students()->where('doing', 1)->get();
			}
		}

		return view('user.myExtrasList', ['user' => Auth::user(), 'professional' => User::find($id)->professional, 'extras' => $extras, 'username' => $id, 'name' => $name, 'studentsAlreadyChosen' => $studentsAlreadyChosen, 'students' => $students]);
	}

	public static function acceptExtra($extraID, $studentID)
	{
		DB::table('extras_students')->where('extra_id', $extraID)
			->where('student_id', $studentID)
			->update(['doing' => 1]);

		$numberStudent = DB::table('extras_students')->where('extra_id', $extraID)->where('doing', 1)->get();

		if(count($numberStudent) == Extra::find($extraID)->number_persons)
		{
			DB::table('extras')->where('id', $extraID)->update(['find' => 1]);
		}

		$extra = Extra::find($extraID);
		$professional = $extra->professional;
		$studentUser = Student::find($studentID)->user;

		$notif_to_send = $professional->company_name." accepted you for the Extra : ".$extra->type." the ".$extra->date_start." at ".$extra->date_start_time.".";

		Mail::send('mails.notification', ['notification' => $notif_to_send, 'user' => $studentUser], function($message) use ($studentUser){

				$message->to($studentUser->email)->subject('New notification ExtrasMe');
		});

		return redirect()->back();
	}

	public function declineExtra($username, $extraID, $studentID)
	{
		DB::table('extras_students')->where('extra_id', $extraID)
			->where('student_id', $studentID)
			->delete();

		$extra = Extra::find($extraID);
		$professional = $extra->professional;
		$studentUser = Student::find($studentID)->user;

		$notif_to_send = $professional->company_name." declined your application for the Extra : ".$extra->type." the ".$extra->date_start." at ".$extra->date_start_time.".";

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
		$date_start = [];
		$date_finish = [];
		$i = 0;

		if($save == 1)
		{
			$type = config('international.last_minute_types')[$request->input('type')];
			$language = config('international.language')[$request->input('language')];
			$date_time_start = $request->input('dateStart');

			foreach(explode(' ', $date_time_start) as $info) 
			{
				if($i == 0)
					$date_start[$i] = Carbon::createFromFormat('d/m/Y', $info);
				elseif($i == 1)
					$date_start[$i] = Carbon::createFromFormat('H:i', $info);

				$date_start[$i]->setTimezone('UTC');
				$i++;
			}

			$i = 0;
			$date_time_finish = $request->input('dateFinish');
			foreach(explode(' ', $date_time_finish) as $info) 
			{
				if($i == 0)
					$date_finish[$i] = Carbon::createFromFormat('d/m/Y', $info);
				elseif($i == 1)
					$date_finish[$i] = Carbon::createFromFormat('H:i', $info);

				$date_finish[$i]->setTimezone('UTC');
				$i++;
			}

			$duration = Carbon::parse($date_start[0].' '.$date_start[1])->diffInHours(Carbon::parse($date_finish[0].' '.$date_finish[1]));

			$extraInput = array(
				'type' => $type,
				'date_start' => $date_start[0]->format('Y-m-d'),
				'date_start_time' => $date_start[1]->format('H:i'),
				'date_finish' => $date_finish[0]->format('Y-m-d'),
				'date_finish_time' => $date_finish[1]->format('H:i'),
				'duration' => $duration,
				'salary' => $request->input('salary'),
				'language' => $language,
				'requirements' => $request->input('requirements'),
				'benefits' => $request->input('benefits'),
				'number_persons' => $request->input('numberPeron'),
				'informations' => $request->input('informations'),
				);

			$this->extraRepository->update($extraID, $extraInput);
		}

		if(session('returnAfterModifyExtra') == 'show_extra')
		{
			return redirect()->route('show_extra', ['username' => Auth::user()->id, 'id' => $extraID]);
		}
	}

	public function deleteExtra($username, $extraID)
	{
		$extra = Extra::find($extraID);

		foreach ($extra->students as $student) {

			$studentUser = $student->user;
			$extra = Extra::find($extraID);
			$professional = $extra->professional;

			$notif_to_send = $professional->company_name." deleted the Extra : ".$extra->type." the ".$extra->date_start." at ".$extra->date_start_time.".";

			Mail::send('mails.notification', ['notification' => $notif_to_send, 'user' => $studentUser], function($message) use ($studentUser){

					$message->to($studentUser->email)->subject('New notification ExtrasMe');
			});
		}

		$this->extraRepository->destroy($extraID);

		return redirect()->route('home', Auth::user()->id);
	}

	public function showFavorite()
	{
		$id = Auth::user()->id;
		$results = null;
		$message = 'RAS';
		if(session()->has('message')){
	        $message = session('message');
	      }
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

			return view('user.favExtrasList', ['name' => $name, 'results' => $results, 'student' => $student, 'experiences' => $experiences, 'educations' => $educations, 'languages' => $languages, 'skills' => $skills, 'back' => false, 'message' => $message]);
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

			return view('user.favExtrasList', ['name' => $name, 'results' => $results, 'professional' => User::find($id)->professional,'experiences' => $experiences, 'educations' => $educations, 'languages' => $languages, 'skills' => $skills, 'back' => false, 'message' => $message]);
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
		$message = "RAS";
		if(User::find($id)->type == 0)
		{
			$name = User::find($id)->student->first_name." ".User::find($id)->student->last_name;
			$results = DB::table('professionals')->where('company_name', 'LIKE', '%' . $favoriteName . '%')->get();

			return view('user.favExtrasList', ['name' => $name, 'results' => $results, 'professional' => User::find($id)->professional,'experiences' => $experiences, 'educations' => $educations, 'languages' => $languages, 'skills' => $skills, 'back' => true, 'message' => $message]);
		}
		else if(User::find($id)->type == 1)
		{
			$name = User::find($id)->professional->company_name;

			$results = DB::table('students')->where('first_name', 'LIKE', '%' . $favoriteName . '%')->orWhere('last_name', 'LIKE', '%' . $favoriteName . '%')
				->orWhereRaw("CONCAT(first_name, ' ', last_name) LIKE '%$favoriteName%'")->get();

			return view('user.favExtrasList', ['name' => $name, 'results' => $results, 'professional' => User::find($id)->professional,'experiences' => $experiences, 'educations' => $educations, 'languages' => $languages, 'skills' => $skills, 'back' => true, 'message' => $message]);
		}
	}

	public static function favoriteAdd($username, $id)
	{
		$AuthID = Auth::user()->id;
		$test = NULL;
		$message = "RAS";
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
					'created_at' => Carbon::now(),
					'updated_at' => Carbon::now(),
					));
				$message = "L'utilisateur a bien été ajouté dans vos favoris.";
			}else{
				$message = "Vous ne pouvez pas avoir plus de 5 favoris.";
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
					'updated_at' => Carbon::now(),
					'created_at' => Carbon::now(),
					));
				$message = "L'utilisateur a bien été ajouté dans vos favoris.";
			}else{
				$message = "Vous ne pouvez pas avoir plus de 5 favoris.";
			}
		}

		return redirect()->route('my_favorite_extras', Auth::user()->id)->with('message', $message);
	}

	public static function favoriteDelete($username, $id)
	{
		$AuthID = Auth::user()->id;
		$message = "RAS";
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
		$message = "L'utilisateur a bien été retiré de vos favoris.";
		return redirect()->route('my_favorite_extras', Auth::user()->id)->with('message', $message);
	}

	public function rateStudents($username, $extraID, Request $request)
	{
		try
		{
			$i = 0;

			while($request->input('rate'.$i))
			{
				$this->dashboardController->rate($request->input('studentID'.$i), $extraID, $request->input('rate'.$i), $request->input('hours'));
				$i++;
			}

			DB::table('extras')->where('id', $extraID)->update(['finish' => 1]);

			return redirect()->route('home', Auth::user()->id);
		}
		catch(\Exception $e)
		{
			dd($e);
		}
	}

	public function rateOneExtra($username, $extraID)
	{
		$extra = Extra::find($extraID);

		if($extra->professional->user->id == Auth::user()->id)
		{
			$name = Auth::user($username)->professional->company_name;
			$studentToRate = [];


	        $find = DB::table('extras_students')->where('extra_id', $extraID)
	          ->where('doing', 1)->get();

	        foreach($find as $f)
	        {
	          $studentToRate[] = Student::find($f->student_id);
	        }


			return view('user.rating', ['user' => User::find($username), 'professional' => User::find($username)->professional, 'username' => $username,
	                'AuthId' => Auth::user()->id, 'name' => $name, 'studentToRate' => $studentToRate, 'extra' => $extra]);
		}
		else
		{
			abort(404);
		}
	}
}
