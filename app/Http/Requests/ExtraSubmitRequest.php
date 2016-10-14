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
      $dateStart = $this->input('date_start');

        return [
            'broadcast'    => 'required|in:last_minute,normal',
            'type'         => "required|between:0,$types",
            'date_start'         => "required|date_format:d/m/Y H:i|after:$date",
            'date_finish'         => "required|date_format:d/m/Y H:i|after:date_start",
            'salary'       => 'required|numeric|min:1',
            'requirements' => 'required',
            'benefits'     => 'required',
            'nom' => 'required',
        ];
    }
}
