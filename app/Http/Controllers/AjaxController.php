<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use ExtrasMe\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use ExtrasMeApi;
use Auth;
use App\Models\Extra;
use App\Models\Student;
use App\Models\User;
use App\Models\Cv;
use App\Models\Professional;

use Carbon\Carbon;

class AjaxController extends Controller
{
	public function loadCard(Request $request){
		$user = Auth::user();
		$cardId = $request->input('id');

		if($user->type == 0)
		{
			$extra = Extra::find($cardId);
			$student = User::find($user->id)->student;
			$can_apply = 0;
			$professional = Professional::find($extra->professional_id);
			if(count($student->extras) > 0){
				if(!$student->extras->contains('id', $extra->id)){
					$can_apply = 1;
				}
			}

			$email_pro = User::find($professional->user_id)->email;
			return view('user.card-content', ['extra' => $extra, 'user' => $user, 'student' => $student, 'can_apply' => $can_apply, 'search' => $request->input('search'), "professional" => $professional, 'email' => $email_pro]);
		}
		else 
		{
			$id = $user->id;
			$professional = User::find($id)->professional;
			$professionalID = $professional->id;
			$extra = Extra::find($cardId);
			$name = User::find($id)->professional->company_name;
			$student = null;
			$students = null;
			$email_pro = User::find($professional->user_id)->email;
			$studentToSort = [];

			$find = DB::table('extras_students')->where('extra_id', $extra->id)
				->where('doing', 1)->get();

			if(count($find) == $extra->number_persons)
			{
				$studentsAlreadyChosen = $extra->students()->where('doing', 1)->get();

			} else
			{
				$students = $extra->students()->where('doing', 0)->get();

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

				$studentsAlreadyChosen = $extra->students()->where('doing', 1)->get();
			}
			$can_apply = 0;
			return view('user.card-content', ['extra' => $extra, 'user' => $user, 'student' => $student, 'can_apply' => $can_apply, 'search' => $request->input('search'), "professional" => $professional, "email" => $email_pro, 'students' => $studentToSort, 'studentsAlreadyChosen' => $studentsAlreadyChosen]);
		}
		
	}

	public function loadList(Request $request){
		try
		{
			$user = Auth::user();
			$listId = $request->input('id');

			if($listId == 1)
			{
				$id = $user->id;
				$title = "Past Extras";
			    $student = User::find($id)->student;
			    $name = $student->first_name." ".$student->last_name;
				$first_name = $student->first_name;
				$last_name = $student->last_name;
				$name = $first_name . " " . $last_name;
			    $extras = $student->extras()->where('find', 1)->where('date_start', '<', Carbon::now())->orderBy('date_start', 'DESC')->get();
			    $professionals = array();
			    
			    if(count($extras) > 0){
					for($i=0; $i < count($extras); $i++)
					{
						array_push($professionals, DB::table('professionals')->where('id', $extras[$i]->professional_id )->value('company_name'));
					}
				}
			    return view('user.list-content', ['name' => $name, 'extras' => $extras, 'user' => Auth::user(), 'professional' => $professionals, 'username' => $id, 'student' => $student, 'title' => $title, 'listId' => $listId])->with('name', $name);
			}
			else if($listId == 2)
			{
				$id = $user->id;
				$title = "Future Extras";
			    $student = User::find($id)->student;
			    $name = $student->first_name." ".$student->last_name;
				$first_name = $student->first_name;
				$last_name = $student->last_name;
				$name = $first_name . " " . $last_name;
			    $extras = $student->extras()->where('doing', 1)->where('date_start', '>=', Carbon::now())->orderBy('date_start', 'ASC')->get();
			    $professionals = array();
			    if(count($extras) > 0){
					for($i=0; $i < count($extras); $i++)
					{
						array_push($professionals, DB::table('professionals')->where('id', $extras[$i]->professional_id )->value('company_name'));
					}
				}
			    return view('user.list-content', ['name' => $name, 'extras' => $extras, 'user' => Auth::user(), 'professional' => $professionals, 'username' => $id, 'student' => $student, 'title' => $title, 'listId' => $listId])->with('name', $name);
			}
			else if($listId == 3)
			{
				try
				{
					$id = $user->id;
					$title = "Applied Extras";
				    $student = User::find($id)->student;
				    $name = $student->first_name." ".$student->last_name;
					$first_name = $student->first_name;
					$last_name = $student->last_name;
					$name = $first_name . " " . $last_name;
				    $extras = $student->extras()->where('doing', 0)->where('find', 0)->where('date_start', '>=', Carbon::now())->orderBy('date_start', 'ASC')->get();
				    $professionals = array();
				    if(count($extras) > 0){
						for($i=0; $i < count($extras); $i++)
						{
							array_push($professionals, DB::table('professionals')->where('id', $extras[$i]->professional_id )->value('company_name'));
						}
					}
				    return view('user.list-content', ['name' => $name, 'extras' => $extras, 'user' => Auth::user(), 'professional' => $professionals, 'username' => $id, 'student' => $student, 'title' => $title, 'listId' => $listId])->with('name', $name);
					}
				catch(\Exception $e)
				{
					dd($e);
				}
			}
			else if($listId == 4)
			{
				$id = $user->id;
				$title = "Past Extras";
				$professional = User::find($id)->professional;
				$professionalID = $professional->id;
				$name = $professional->first_name." ".$professional->last_name;
				$extras = Professional::find($professionalID)->extra()->where('date_start', '<=', Carbon::now())->orderBy('date_start', 'DESC')->get();
				$name = User::find($id)->professional->company_name;
				$student = null;
				$studentsAlreadyChosen = null;
				$professionals = array();

				if(count($extras) > 0)
				{
					$find = DB::table('extras_students')->where('extra_id', $extras[0]->id)
						->where('doing', 1)->get();

					if(!empty($find))
					{
						$studentsAlreadyChosen = $extras[0]->students()->where('doing', 1)->get();
					}
				}
				return view('user.list-content', ['name' => $name, 'extras' => $extras, 'user' => Auth::user(), 'professional' => $professional, 'username' => $id, 'student' => $student, 'title' => $title, 'studentsAlreadyChosen' => $studentsAlreadyChosen, 'listId' => $listId])->with('name', $name);
			}
			else if($listId == 5)
			{
				$id = $user->id;
				$title = "Future Extras";
				$professional = User::find($id)->professional;
				$professionalID = $professional->id;
				$name = $professional->first_name." ".$professional->last_name;
				$extras = Professional::find($professionalID)->extra()->where('date_start', '>=', Carbon::now())->orderBy('date_start', 'ASC')->get();
				$name = User::find($id)->professional->company_name;
				$student = null;
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

				return view('user.list-content', ['name' => $name, 'extras' => $extras, 'user' => Auth::user(), 'professional' => $professional, 'username' => $id, 'student' => $student, 'title' => $title, 'students' => $studentToSort, 'studentsAlreadyChosen' => $studentsAlreadyChosen, 'listId' => $listId])->with('name', $name);
			}
		}
		catch(\Exception $e)
		{
			dd($e);
		}
	}
	public function loadStudent(Request $request){

		$user = Auth::user();
		$studId = $request->input('id');
		$student = Student::find($studId);

		$professionalID = $user->professional->id;

		$alreadyFav = DB::table('favoris')->where('professional_id', $professionalID)
						->where('student_id', $studId)->get();


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
        $name = $student->first_name." ".$student->last_name;
        return view('user.student-fav', ['student' => $student, 'experiences' => $experiences, 'educations' => $educations, 'languages' => $languages, 'skills' => $skills, 'name' => $name, 'alreadyFav' => $alreadyFav]);
	}

	public function loadProfessional(Request $request){
		$user = Auth::user();
		$proId = $request->input('id');
		$professional = Professional::find($proId);
		$mail = User::find($professional->user_id)->email;
		$studentID = $user->student->id;

		$alreadyFav = DB::table('favoris')->where('professional_id', $proId)
						->where('student_id', $studentID)->get();

		return view('user.pro-fav', ['professional' => $professional, 'mail' => $mail, 'alreadyFav' => $alreadyFav]);
	}
}
