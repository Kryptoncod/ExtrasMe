<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ExtraSearchRequest extends Request
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
      $types = count(config('international.last_minute_types'))-1;

        return [
           'type'         => "required|between:0,$types",
           'date'         => "required|date_format:m/d/Y",
        ];
    }
}
