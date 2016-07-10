<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Extra extends Model
{
    protected $fillable = [
        'broadcast', 'type', 'date', 'duration', 'salary', 'benefits', 'requirements', 
        'informations'
    ];

    public function student()
    {
    	return $this->belongsToMany('App\Student');
    }

    public function professional()
    {
    	return $this->belongsToMany('App\Professional');
    }
}
