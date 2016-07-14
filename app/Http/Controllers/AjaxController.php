<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use ExtrasMe\Http\Requests;
use App\Http\Controllers\Controller;

use ExtrasMeApi;

class AjaxController extends Controller
{
	public function getCard(Request $request){
		dd($extra);
		$cardId = $request->['id'];
		$extra = DB::table('extras')->where('id', $cardId );
		dd($extra);
		return view('user.card-content', ['extra' => $extra]);
	}
}