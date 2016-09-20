<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

class Extra extends Model
{
    protected $fillable = [
        'broadcast', 'type', 'date', 'date_time', 'duration', 'salary', 'language', 'benefits', 'requirements', 'informations', 'professional_id'
    ];

    public function students()
    {
    	return $this->belongsToMany('App\Models\Student', 'extras_students');
    }

    public function professional()
    {
    	return $this->belongsTo('App\Models\Professional');
    }

    public function dateExtra()
    {
        return Carbon::parse($this->date)->format('d/m/Y');
    }

    public function timeExtra()
    {
        return Carbon::parse($this->date_time)->format('H:i');
    }
}
