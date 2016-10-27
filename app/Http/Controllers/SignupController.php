<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterStudentRequest;
use App\Http\Requests\RegisterProfessionalRequest;

use App\Repositories\UserRepository;
use App\Repositories\StudentRepository;
use App\Repositories\ProfessionalRepository;
use App\Repositories\DashboardRepository;
use App\Repositories\CandidateRepository;

use Carbon\Carbon;

use Auth, DB, Mail;

class SignupController extends Controller
{

    protected $userRepository;
    protected $studentRepository;
    protected $professionalRepository;
    protected $dashboardRepository;
    protected $candidateRepository;

   public function __construct(UserRepository $userRepository, 
                                StudentRepository $studentRepository,
                                ProfessionalRepository $professionalRepository,
                                DashboardRepository $dashboardRepository,
                                CandidateRepository $candidateRepository)
   {
      $middleware = array('guest', 'signUp');
      $this->middleware($middleware, ['except' => 'registerCandidate']);
      $this->userRepository = $userRepository;
      $this->studentRepository = $studentRepository;
      $this->professionalRepository = $professionalRepository;
      $this->dashboardRepository = $dashboardRepository;
      $this->candidateRepository = $candidateRepository;
   }

    /**
     * Display the student sign up form
     *
     * @return \Illuminate\Http\Response
     */
    public function registerCandidate(Request $request)
    {
      $email = $request->input('email');
      
      if($email == 'extrasmeEHL2016')
      {
        $request->session()->put('signUpAuthorization', $email);
        return redirect()->route('charter');
      }
      else
      {

         $this->validate($request, [
            'email' => 'required|unique:candidates|max:255|email',
          ]);

        $this->candidateRepository->store(['email' => $email]);

        return redirect()->route('index');
      }
    }

    public function showStudent()
    {
        return view('signup.student');
    }

    public function verificationConditions(Request $request)
    {
      
      $this->validate($request, [
          'conditions' => 'required',
      ]);

      return redirect()->route('signUp_student');
    }

    /**
     * Checks the submitted form and saves the resource
     *
     * @return \Illuminate\Http\Response
     */
    public function registerStudent(Request $request)
    {
        $confirmation_code = str_random(30);

        $userInputs = array(
            'email' => $request->input('email_address'),
            'password' => $request->input('password'),
            'type' => 0,
            'confirmation_code' => $confirmation_code,
            );

        $user = $this->userRepository->store($userInputs);
        $id = $user->id;

        $studentInputs = array(
            'first_name' => $request->input('name'),
            'last_name' => $request->input('last_name'),
            'gender' => $request->input('gender'),
            'birthdate' => Carbon::createFromDate($request->input('year'), $request->input('month'), $request->input('day'), 'UTC'),
            'nationality'   => config('international.nationalities')[$request->input('nationality')],
            'school_year' => config('international.ehl_years')[$request->input('school_year')],
            'phone'  => $request->input('phone'),
            'address' => $request->input('address'),
            'city' => $request->input('city'),
            'zipcode' => $request->input('zipcode'),
            'state' => $request->input('state'),
            'country' => config('international.countries')[$request->input('country')],
            'group' => 2,
            'user_id' => $id,
            );

        $student = $this->studentRepository->store($studentInputs);

        $dashBoardInput = array(
            'total_earned' => 0,
            'total_hours' => 0,
            'numbers_extras' => 0,
            'numbers_establishement' => 0, 
            'level' => 0, 
            'student_id' => $student->id,
            );

        $dashBoard = $this->dashboardRepository->store($dashBoardInput);

        session()->put('signUpAuthorization', 'no');

        $notif_to_send = "Please click here to verify your account : ".route('confirmation_account', $confirmation_code);

        Mail::send('mails.notification', ['notification' => $notif_to_send, 'user' => $user], function($message) use ($student){
            $message->to($student->user->email)->subject('New notification ExtrasMe');
          });

        return redirect()->route('confirm_email_view');
    }

    /**
     * Display the profesional sign up form
     *
     * @return \Illuminate\Http\Response
     */
    public function showProfessional()
    {
        return view('signup.professional');
    }

    /**
     * Checks the submitted form and saves the resource
     *
     * @return \Illuminate\Http\Response
     */
    public function registerProfessional(Request $request)
    {
        $userInputs = array(
            'email' => $request->input('email_address'),
            'password' => $request->input('password'),
            'type' => 1,
            );

        $user = $this->userRepository->store($userInputs);
        $id = $user->id;

        $category = config('international.professionals_categories')[$request->input('category')];
        $country = config('international.countries')[$request->input('country')];

        $professionalInputs = array(
            'company_name'             => $request->input('company_name'),
            'category'                 => $category,
            'country'                  => $country,
            'first_name'      => $request->input('representative_name'),
            'last_name' => $request->input('representative_last_name'),
            'phone'           => $request->input('contact_number'),
            'address'                  => $request->input('address'),
            'city' => $request->input('city'),
            'zipcode' => $request->input('zipcode'),
            'state' => $request->input('state'),
            'user_id' =>$id,
            'credit' => 100,
            );

        $professional = $this->professionalRepository->store($professionalInputs);

        return redirect()->route('confirm_email_view');
    }
}
