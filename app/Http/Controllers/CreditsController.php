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

use Auth, DB, Mail, Password, Log;

class CreditsController extends Controller
{

	protected $invoiceRepository;
	protected $professionalRepository;

	public function __construct(InvoiceRepository $invoiceRepository,
								ProfessionalRepository $professionalRepository)
	{
		$middleware = array('auth');
		$this->middleware($middleware);
		$this->invoiceRepository = $invoiceRepository;
		$this->professionalRepository = $professionalRepository;
	}

	public function show($username){
		$user = User::find($username);
		$professional = $user->professional;

		session()->forget('what_payment');

		$dueInvoices = DB::table('invoices')->where('professional_id', $professional->id)
			->where('paid', 0)->get();

		$pastInvoices = DB::table('invoices')->where('professional_id', $professional->id)
			->where('paid', 1)->get();

		return view('payment.myCredit', ['user' => $user, 'professional' => $professional, 'username' => $username, 'dueInvoices' => $dueInvoices, 'pastInvoices' => $pastInvoices]);
	}

	public function options($username, Request $request){
		$user = User::find($username);
		$professional = $user->professional;
		
		$this->validate($request, [
	        'mail' => 'required|email',
	        'password' => 'required',
    	]);

		if(Auth::validate(['email' => $request->input('mail'), 'password' => $request->input('password')]) && $user->email == $request->input('mail'))
		{
			session()->flash('credentialsConfirm', 1);
			session()->reflash();

		    return view('payment.options', ['user' => $user, 'professional' => $professional, 'username' => $username]);
		}
		else {

    		return redirect()->back();
    	}
	}

	public function confirmation($username, TypeCreditRequest $request)
	{
		$whatPayment = $request->input('what_payment');

		switch ($whatPayment) {
			case 1:
				session()->flash('what_payment', [25, 227]);
				break;
			case 2:
				session()->flash('what_payment', [50, 433]);
				break;
			case 3:
				session()->flash('what_payment', [100, 743]);
				break;
			case 4:
				session()->flash('what_payment', [250, 1548]);
				break;
		}

		$user = User::find($username);
		$professional = $user->professional;

		return redirect()->route('confirm_form', Auth::user()->id);
	}

	public function confirmationView($username)
	{
		$user = User::find($username);
		$professional = $user->professional;

		session()->reflash();

		return view('payment.confirmation', ['user' => $user, 'professional' => $professional, 'username' => $username]);
	}

	public function paymentOptionsCash($username)
	{

		$notif_to_send = "Your demand for ".session()->get('what_payment')[0]." Extras is now being processing. You will receive your credits as soon as the payment is effective.";

		$professionalUser = User::find($username);

		Mail::send('mails.notification', ['notification' => $notif_to_send, 'user' => $professionalUser], function($message) use ($professionalUser){
			$message->to($professionalUser->email)->subject('New notification ExtrasMe');
		});

		$professional = $professionalUser->professional;

		$invoiceInputs = array(
			'paid' => 0,
			'number_announce' => session()->get('what_payment')[0],
			'price' => session()->get('what_payment')[1],
			'price_announce' => session()->get('what_payment')[1] / session()->get('what_payment')[0],
			'type_payment' => 0,
			'professional_id' => $professional->id,
			'created_at' => Carbon::now(),
			'updated_at' => Carbon::now(),
			);

		$invoice = $this->invoiceRepository->store($invoiceInputs);

		$this->professionalRepository->update($professionalUser->professional->id, ['credit' => (session()->get('what_payment')[0]/5) + $professionalUser->professional->credit]);

		return redirect()->route('credits', $username);
	}

	public function paymentOptionsTransfer($username)
	{
		\Log::info(session()->get('what_payment'));

		$notif_to_send = "Your demand for ".session()->get('what_payment')[0]." Extras is now being processing. You will receive your credits as soon as the payment is effective.";

		$professionalUser = User::find($username);

		Mail::send('mails.notification', ['notification' => $notif_to_send, 'user' => $professionalUser], function($message) use ($professionalUser){
			$message->to($professionalUser->email)->subject('New notification ExtrasMe');
		});

		$professional = $professionalUser->professional;

		$invoiceInputs = array(
			'paid' => 0,
			'number_announce' => session()->get('what_payment')[0],
			'price' => session()->get('what_payment')[1],
			'price_announce' => session()->get('what_payment')[1] / session()->get('what_payment')[0],
			'type_payment' => 1,
			'professional_id' => $professional->id,
			'created_at' => Carbon::now(),
			'updated_at' => Carbon::now(),
			);

		$invoice = $this->invoiceRepository->store($invoiceInputs);

		$this->professionalRepository->update($professionalUser->professional->id, ['credit' => (session()->get('what_payment')[0]/5) + $professionalUser->professional->credit]);

		return redirect()->route('credits', $username);
	}
}