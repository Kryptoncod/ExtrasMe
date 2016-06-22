<?php

namespace ExtrasMe\Http\Controllers;

use Illuminate\Http\Request;

use ExtrasMe\Http\Requests;
use ExtrasMe\Http\Controllers\Controller;
use ExtrasMe\Http\Requests\RegisterStudentRequest;
use ExtrasMe\Http\Requests\RegisterProfessionalRequest;
use ExtrasMeApi;
use Carbon\Carbon;

use Auth;

use ExtrasMe\ApiClient\Models\User;
use ExtrasMe\ApiClient\Models\Student;

class SignupController extends Controller
{

   public function __construct()
   {
      $this->middleware('guest');
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
    public function registerStudent(RegisterStudentRequest $request)
    {
      try {
         $birthdate = Carbon::createFromDate($request->input('year'), $request->input('month'), $request->input('day'), 'GMT');
         $school_year = config('international.ehl_years')[$request->input('school_year')];
         $nationality = config('international.nationalities')[$request->input('nationality')];

         $student = ExtrasMeApi::newStudent([
            'first_name'    => $request->input('name'),
            'last_name'     => $request->input('last_name'),
            'gender'        => $request->input('gender'),
            'birthdate'     => $birthdate,
            'nationality'   => $nationality,
            'school_year'   => $school_year,
            'phone_number'  => $request->input('phone'),
         ]);

         $id = $student->save();

         $user = ExtrasMeApi::newUser([
            'email'         => $request->input('email_address'),
            'password'      => $request->input('password'),
            'type'          => 0,
            'group_id'      => $id,
            'newsletter'    => $request->input('newsletter'),
            'username'      => strtolower($request->input('name').'.'.$request->input('last_name')),
         ]);

         $user->save();

         Auth::attempt([
            'email' => $request->input('email_address'),
            'password' => $request->input('password'),
         ]);

         return redirect()->route('index');

      } catch (\Exception $e) {
         return redirect()->back();
      }
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
    public function registerProfessional(RegisterProfessionalRequest $request)
    {
      try {
         $category = config('international.professionals_categories')[$request->input('category')];
         $country = config('international.countries')[$request->input('country')];

         $professional = ExtrasMeApi::newProfessional([
            'company_name'             => $request->input('company_name'),
            'category'                 => $category,
            'country'                  => $country,
            'representative_name'      => $request->input('representative_name'),
            'representative_last_name' => $request->input('representative_last_name'),
            'contact_number'           => $request->input('contact_number'),
            'address'                  => $request->input('address'),
         ]);

         $id = $professional->save();

         $user = ExtrasMeApi::newUser([
            'email'         => $request->input('email_address'),
            'password'      => $request->input('password'),
            'type'          => 1,
            'group_id'      => $id,
            'newsletter'    => $request->input('newsletter'),
            'username'      => strtolower($request->input('company_name')),
         ]);

         $user->save();

         Auth::attempt([
            'email' => $request->input('email_address'),
            'password' => $request->input('password'),
         ]);

         return redirect()->route('index');

      } catch (\Exception $e) {
         dd($e);
         return redirect()->back();
      }
    }
}
