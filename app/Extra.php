<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Extra extends Model
{
    protected $fillable = [
        'broadcast', 'type', 'date', 'date_time', 'duration', 'salary', 'benefits', 'requirements', 'informations', 'professional_id'
    ];

    public function students()
    {
    	return $this->belongsToMany('App\Student', 'extras_students');
    }

    public function professional()
    {
    	return $this->belongsTo('App\Professional');
    }
}
