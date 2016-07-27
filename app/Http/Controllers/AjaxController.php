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

class AjaxController extends Controller
{
	public function loadCard(Request $request){

		$cardId = $request->input('id');
		$extra = DB::select('select * from extras where id = :id', ['id' => $cardId]);
		$user = Auth::user()->id;
		return view('user.card-content', ['extra' => $extra, 'user' => $user]);
	}
}
