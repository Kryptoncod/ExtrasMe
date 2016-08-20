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
use App\Models\Professional;

use Carbon\Carbon;

class AjaxController extends Controller
{
	public function loadCard(Request $request){
		$user = Auth::user();
		$cardId = $request->input('id');
		if($user->type == 0){
			$extra = Extra::find($cardId);
			$student = User::find($user->id)->student;
			$can_apply = 0;
			if(count($student->extras) > 0){
				if(!$student->extras->contains('id', $extra->id)){
					$can_apply = 1;
				}
			}
			return view('user.card-content', ['extra' => $extra, 'user' => $user, 'student' => $student, 'can_apply' => $can_apply, 'search' => $request->input('search')]);
		}else{
			$id = $user->id;
			$professionalID = User::find($id)->professional->id;
			$extra = Extra::find($cardId);
			$name = User::find($id)->professional->company_name;
			$student = null;
			$find = DB::table('extras_students')->where('extra_id', $extra->id)
				->where('done', 1)->get();

			if(!empty($find))
			{
				if($find[0]->done == 1)
				{
					$student = Student::find($find[0]->student_id);
				}
			}
			$can_apply = 0;
			return view('user.card-content', ['extra' => $extra, 'user' => $user, 'student' => $student, 'can_apply' => $can_apply, 'search' => $request->input('search')]);
		}
		
	}

	public function loadList(Request $request){
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
		    $extras = $student->extras()->where('find', 1)->where('date', '<', Carbon::now())->orderBy('date', 'DESC')->get();
		    $professionals = array();
		    if(count($extras) > 0){
				for($i=0; $i < count($extras); $i++)
				{
					array_push($professionals, DB::table('professionals')->where('id', $extras[$i]->professional_id )->value('company_name'));
				}
			}
		    return view('user.list-content', ['name' => $name, 'extras' => $extras, 'user' => Auth::user(), 'professional' => $professionals, 'username' => $id, 'student' => $student, 'title' => $title])->with('name', $name);
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
		    $extras = $student->extras()->where('find', 1)->where('date', '>=', Carbon::now())->orderBy('date', 'ASC')->get();
		    $professionals = array();
		    if(count($extras) > 0){
				for($i=0; $i < count($extras); $i++)
				{
					array_push($professionals, DB::table('professionals')->where('id', $extras[$i]->professional_id )->value('company_name'));
				}
			}
		    return view('user.list-content', ['name' => $name, 'extras' => $extras, 'user' => Auth::user(), 'professional' => $professionals, 'username' => $id, 'student' => $student, 'title' => $title])->with('name', $name);
		}
		else if($listId == 3)
		{
			$id = $user->id;
			$title = "Applied Extras";
		    $student = User::find($id)->student;
		    $name = $student->first_name." ".$student->last_name;
			$first_name = $student->first_name;
			$last_name = $student->last_name;
			$name = $first_name . " " . $last_name;
		    $extras = $student->extras()->where('find', 0)->where('date', '>=', Carbon::now())->orderBy('date', 'ASC')->get();
		    $professionals = array();
		    if(count($extras) > 0){
				for($i=0; $i < count($extras); $i++)
				{
					array_push($professionals, DB::table('professionals')->where('id', $extras[$i]->professional_id )->value('company_name'));
				}
			}
		    return view('user.list-content', ['name' => $name, 'extras' => $extras, 'user' => Auth::user(), 'professional' => $professionals, 'username' => $id, 'student' => $student, 'title' => $title])->with('name', $name);
		}
		else if($listId == 4)
		{
			$id = $user->id;
			$title = "Past Extras";
			$professional = User::find($id)->professional;
			$professionalID = $professional->id;
			$name = $professional->first_name." ".$professional->last_name;
			$extras = Professional::find($professionalID)->extra()->where('date', '<=', Carbon::now())->orderBy('date', 'ASC')->get();
			$name = User::find($id)->professional->company_name;
			$student = null;
			$professionals = array();

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
				}
			}
			return view('user.list-content', ['name' => $name, 'extras' => $extras, 'user' => Auth::user(), 'professional' => $professionals, 'username' => $id, 'student' => $student, 'title' => $title])->with('name', $name);
		}
		else if($listId == 5)
		{
			$id = $user->id;
			$title = "Future Extras";
			$professional = User::find($id)->professional;
			$professionalID = $professional->id;
			$name = $professional->first_name." ".$professional->last_name;
			$extras = Professional::find($professionalID)->extra()->where('date', '>=', Carbon::now())->orderBy('date', 'ASC')->get();
			$name = User::find($id)->professional->company_name;
			$student = null;
			$professionals = array();

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
				}
		}
		return view('user.list-content', ['name' => $name, 'extras' => $extras, 'user' => Auth::user(), 'professional' => $professionals, 'username' => $id, 'student' => $student, 'title' => $title])->with('name', $name);
	}
	}
}
