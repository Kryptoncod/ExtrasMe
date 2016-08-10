<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CardAvsRequest extends Request
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
        return [
            'carte-id' => 'mimes:jpg,png,pdf,gif,jpeg,tiff,doc,docx,odt|max:10000',
            'avs' => 'mimes:jpg,png,pdf,gif,jpeg,tiff,doc,docx,odt|max:10000',
            'permit' => 'mimes:jpg,png,pdf,gif,jpeg,tiff,doc,docx,odt|max:10000',
        ];
    }
}
