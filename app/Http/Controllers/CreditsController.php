<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\ExtraSearchRequest;
use App\Http\Requests\ExtraSubmitRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\FavoriteSearchRequest;
use App\Http\Requests\TypeCreditRequest;

use App\Models\User;
use App\Models\Extra;
use App\Models\Student;
use App\Models\Professional;
use App\Models\Cv;
use App\Models\Experience;
use App\Models\Education;
use App\Models\Language;
use App\Models\Competence;
use App\Models\EventModel;
use App\Models\Dashboard;

use App\Repositories\ExtraRepository;
use App\Repositories\ProfessionalRepository;

use Carbon\Carbon;

use Auth, DB;

class CreditsController extends Controller
{


	public function __construct()
	{
		$middleware = array('auth', 'credit');
		$this->middleware($middleware);
	}

	public function show($username){
		$user = User::find($username);
		$professional = $user->professional;

		return view('payment.myCredit', ['user' => $user, 'professional' => $professional, 'username' => $username]);
	}

	public function options($username, Request $request){
		$user = User::find($username);
		$professional = $user->professional;

		$this->validate($request, [
	        'company_name' => 'required',
	        'responsable' => 'required',
	        'mail' => 'required|email|confirmed',
    	]);

		return view('payment.options', ['user' => $user, 'professional' => $professional, 'username' => $username]);
	}

	public function confirmation($username, TypeCreditRequest $request){
		$user = User::find($username);
		$professional = $user->professional;
		$data = [];
		$i = 0;

		$radio = $request->input('what_payment');

		foreach(explode(' ', $radio) as $info) 
		{
			$data[$i] = $info;
			$i++;
		}

		return view('payment.confirmation', ['user' => $user, 'professional' => $professional, 'username' => $username, 'data' => $data]);
	}
}