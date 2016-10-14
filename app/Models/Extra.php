<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

class Extra extends Model
{
    protected $fillable = [
        'broadcast', 'type', 'date_start', 'date_start_time', 'date_finish', 'date_finish_time', 'duration', 'number_persons', 'salary', 'language', 'benefits', 'requirements', 'informations', 'professional_id', 'open'
    ];

    public function students()
    {
    	return $this->belongsToMany('App\Models\Student', 'extras_students');
    }

    public function professional()
    {
    	return $this->belongsTo('App\Models\Professional');
    }

    public function dateStartExtra()
    {
        return Carbon::parse($this->date_start)->format('d/m/Y');
    }

    public function timeStartExtra()
    {
        return Carbon::parse($this->date_start_time)->format('H:i');
    }

    public function dateFinishExtra()
    {
        return Carbon::parse($this->date_finish)->format('d/m/Y');
    }

    public function timeFinishExtra()
    {
        return Carbon::parse($this->date_finish_time)->format('H:i');
    }

    public function getPaginate($n)
    {
        return $this->paginate($n);
    }
}
