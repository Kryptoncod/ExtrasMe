<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class RegisterStudentRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
      $nationalities = count(config('international.nationalities'))-1;

        return [
           'name'                  => 'required',
           'last_name'             => 'required',
           'gender'                => 'required|in:male,female',
           'day'                   => 'required|numeric|between:1,31',
           'month'                 => 'required|numeric|between:1,12',
           'year'                  => 'required|numeric|between:1900,2000',
           'nationality'           => "required|between:0,$nationalities",
           'school_year'           => 'required|between:0,3',
           'phone'                 => 'required',
           'email_address'         => 'required|unique:users|email|regex:/.+@ehl\.ch$/|confirmed', //only @ehl.com addresses
           'password'              => 'required|min:8|confirmed',
           'conditions'            => 'required',
        ];
    }
}
