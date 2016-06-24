<?php

namespace ExtrasMe\Http\Requests;

use ExtrasMe\Http\Requests\Request;

class RegisterProfessionalRequest extends Request
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
      $categories = count(config('international.professionals_categories'))-1;
      $countries = count(config('international.countries'))-1;

        return [
            'company_name'             => 'required',
            'category'                 => "required|between:0,$categories",
            'country'                  => "required|between:0,$countries",
            'representative_name'      => 'required',
            'representative_last_name' => 'required',
            'contact_number'           => 'required',
            'address'                  => 'required',
            'email_address'            => 'required|email|confirmed',
            'password'                 => 'required|min:8|confirmed',
            'conditions'               => 'required',

        ];
    }
}
