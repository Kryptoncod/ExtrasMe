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

use Carbon\Carbon;

use Auth;

use App\ApiClient\Models\User;
use App\ApiClient\Models\Student;

class SignupController extends Controller
{

    protected $userRepository;
    protected $studentRepository;
    protected $professionalRepository;

   public function __construct(UserRepository $userRepository, 
                                StudentRepository $studentRepository,
                                ProfessionalRepository $professionalRepository)
   {
      $this->middleware('guest');
      $this->userRepository = $userRepository;
      $this->studentRepository = $studentRepository;
      $this->professionalRepository = $professionalRepository;
   }

    /**
     * Display the student sign up form
     *
     * @return \Illuminate\Http\Response
     */
    public function showStudent()
    {
        return view('signup.student');
    }

    /**
     * Checks the submitted form and saves the resource
     *
     * @return \Illuminate\Http\Response
     */
    public function registerStudent(Request $request)
    {
        $userInputs = array(
            'email' => $request->input('email_address'),
            'password' => $request->input('password'),
            'type' => 0,
            );

        $user = $this->userRepository->store($userInputs);
        $id = $user->id;

        $studentInputs = array(
            'first_name' => $request->input('name'),
            'last_name' => $request->input('last_name'),
            'gender' => $request->input('gender'),
            'birthdate' => Carbon::createFromDate($request->input('year'), $request->input('month'), $request->input('day'), 'GMT'),
            'nationality'   => config('international.nationalities')[$request->input('nationality')],
            'school_year' => config('international.ehl_years')[$request->input('school_year')],
            'phone'  => $request->input('phone'),
            'user_id' => $id,
            );

        $student = $this->studentRepository->store($studentInputs);

        return redirect()->route('index');
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
            'user_id' =>$id,
            'credit' =>0,
            );

        $professional = $this->professionalRepository->store($professionalInputs);

        return redirect()->route('index');
    }
}
