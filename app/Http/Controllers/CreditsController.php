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
use App\Models\Invoice;

use App\Repositories\ExtraRepository;
use App\Repositories\ProfessionalRepository;
use App\Repositories\InvoiceRepository;

use Carbon\Carbon;

use Auth, DB, Mail, Password;

class CreditsController extends Controller
{

	protected $invoiceRepository;

	public function __construct(InvoiceRepository $invoiceRepository)
	{
		$middleware = array('auth', 'credit');
		$this->middleware($middleware);
		$this->invoiceRepository = $invoiceRepository;
	}

	public function show($username){
		$user = User::find($username);
		$professional = $user->professional;

		return view('payment.myCredit', ['user' => $user, 'professional' => $professional, 'username' => $username]);
	}

	public function options($username, Request $request, $data0, $data1){
		$user = User::find($username);
		$professional = $user->professional;

		$this->validate($request, [
	        'mail' => 'required|email',
	        'password' => 'required',
    	]);

    	$credentials = array('email' => $request->input('mail'),'password' => $request->input('password'));

		if(Auth::attempt(['email' => $request->input('mail'),'password' => $request->input('password')]))
		{
		    return view('payment.options', ['user' => $user, 'professional' => $professional, 'username' => $username, 'data1' => $data1, 'data0' => $data0]);
		}
		else {

    		return redirect()->back();
    	}
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

	public function paymentOptionsCash($username, $data0, $data1)
	{
		$notif_to_send = "Your demand for ".$data0." Extras is now being processing. You will receive your credits as soon as the payment is effective.";

		$professionalUser = User::find($username);

		Mail::send('mails.notification', ['notification' => $notif_to_send, 'user' => $professionalUser], function($message) use ($professionalUser){
			$message->to($professionalUser->email)->subject('New notification ExtrasMe');
		});

		$professional = $professionalUser->professional;

		$invoiceInputs = array(
			'paid' => 0,
			'number_announce' => $data0,
			'price' => $data1,
			'price_announce' => $data1 / $data0,
			'professional_id' => $professional->id,
			'created_at' => Carbon::now(),
			'updated_at' => Carbon::now(),
			);

		$invoice = $this->invoiceRepository->store($invoiceInputs);

		return redirect()->route('credits', $username);
	}
}