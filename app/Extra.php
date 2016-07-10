<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Extra extends Model
{
    protected $fillable = [
        'broadcast', 'type', 'date', 'duration', 'salary', 'benefits', 'requirements', 
        'informations', 'professional_id'
    ];

    public function student()
    {
    	return $this->belongsToMany('App\Student');
    }

    public function professional()
    {
    	return $this->belongsTo('App\Professional');
    }
}
