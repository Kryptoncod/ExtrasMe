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

class AjaxController extends Controller
{
	public function loadCard(Request $request){

		$cardId = $request->input('id');
		$extra = Extra::find($cardId);
		$user = Auth::user()->id;
		$student = User::find($user)->student;
		$can_apply = 0;
		if(!$student->extras->contains('id', $extra->id)){
			$can_apply = 1;
		}
		return view('user.card-content', ['extra' => $extra, 'user_id' => $user, 'student' => $student, 'can_apply' => $can_apply]);
	}
}
