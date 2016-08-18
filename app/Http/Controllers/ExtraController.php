<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CvUpdateRequest;
use App\Http\Requests\CardAvsRequest;

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
use App\Repositories\ExperienceRepository;
use App\Repositories\EducationRepository;
use App\Repositories\SkillRepository;
use App\Repositories\LanguageRepository;

use Carbon\Carbon;

use Auth, DB, Validator;

class ExtraController extends Controller
{

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
				$extras = Extra::all();
			} else {
				$extras = Extra::where('type', $type_extra)->get();
			}

      //On récupère le nom des professionnels qui proposent des extras
			$professionals = array();
			for($i=0; $i < count($extras); $i++)
			{
				array_push($professionals, DB::table('professionals')->where('id', $extras[$i]->professional_id )->value('company_name'));
			}
			$can_apply = 0;
			if(!$student->extras->contains('id', $extras[0]->id)){
				$can_apply = 1;
			}
			return view('user.extra', ['extras' => $extras, 'user' => Auth::user(), 'professional' => $professionals, 'username' => $id, 'student' => $student, 'can_apply' => $can_apply])->with('name', $name);
		}
	}

	public function submit(ExtraSubmitRequest $request)
	{
		$id = Auth::user()->id;
		$professionalID = User::find($id)->professional->id;
		$type = config('international.last_minute_types')[$request->input('type')];
		$date_time = preg_split("/[\s,]+/", $request->input('date'));
		$date = Carbon::createFromFormat('d/m/Y', $date_time[0]);
		$time = Carbon::createFromFormat('H:i', $date_time[1]);
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

			DB::table('extras_students')->insert(array(
				'extra_id' => $id,
				'student_id' => Auth::user()->student->id,
				));

			return redirect()->route('home', Auth::user()->id);
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
		$extras = Professional::find($professionalID)->extra;
		$name = User::find($id)->professional->company_name;

		return view('user.myExtrasList', ['user' => Auth::user(), 'professional' => User::find($id)->professional, 'extras' => $extras, 'username' => $id, 'name' => $name]);
	}

	

	

	public function showFavorite()
	{
		$id = Auth::user()->id;
		$results = null;

		if(User::find($id)->type == 0)
		{
			$name = User::find($id)->student->first_name." ".User::find($id)->student->last_name;
			$studentID = User::find($id)->student->id;
			$results = Student::find($studentID)->professionals()->where('type', 0)->get();

			return view('user.favExtrasList', ['name' => $name, 'results' => $results]);
		}
		else if(User::find($id)->type == 1)
		{
			$name = User::find($id)->professional->company_name;
			$professionalID = User::find($id)->professional->id;
			$results = Professional::find($professionalID)->students()->where('type', 1)->get();

			return view('user.favExtrasList', ['name' => $name, 'results' => $results]);
		}

		return view('user.favExtrasList', ['name' => $name, 'results' => $results]);
	}

	public function showFavoriteSearch(Request $favoriteSearchRequest)
	{
		$favoriteName = $favoriteSearchRequest->input('searchFav');

		$id = Auth::user()->id;

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
		}

		return view('user.favExtrasSearch', ['name' => $name, 'results' => $results]);
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
