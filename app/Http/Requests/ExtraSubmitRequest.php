<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Carbon\Carbon;

class ExtraSubmitRequest extends Request
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
      $date = Carbon::now()->toDateString();
        return [
            'broadcast'    => 'required|in:last_minute,normal',
            'type'         => "required|between:0,$types",
            'date'         => "required|date_format:d/m/Y H:i|after:$date",
            'duration'     => 'required|numeric|min:1',
            'salary'       => 'required|numeric|min:1',
            'requirements' => 'required',
            'benefits'     => 'required',
        ];
    }
}
