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

use ExtrasMeApi;
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
        $studentInputs = array(
            'first_name' => $request->input('name'),
            'last_name' => $request->input('last_name'),
            'gender' => $request->input('gender'),
            'birthdate' => Carbon::createFromDate($request->input('year'), $request->input('month'), $request->input('day'), 'GMT'),
            'nationality'   => config('international.nationalities')[$request->input('nationality')],
            'school_year' => config('international.ehl_years')[$request->input('school_year')],
            'phone'  => $request->input('phone'),
            );

        $student = $this->studentRepository->store($studentInputs);
        $id = $student->id;

        $userInputs = array(
            'email' => $request->input('email_address'),
            'password' => $request->input('password'),
            'type' => 0,
            'student_id' => $id,
            'professional_id' => 1,
            );
        
        $user = $this->userRepository->store($userInputs);

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
            );

        $professional = $this->professionalRepository->store($professionalInputs);
        $id = $professional->id;

        $userInputs = array(
            'email' => $request->input('email_address'),
            'password' => $request->input('password'),
            'type' => 1,
            'student_id' => 1,
            'professional_id' => $id,
            );

        $user = $this->userRepository->store($userInputs);

        return redirect()->route('index');
    }
}
