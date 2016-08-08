<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cv extends Model
{
    protected $fillable = [
        'languages', 'skills', 'summary'
    ];

    public function student()
    {
    	return $this->belongsTo('App\Models\Student');
    }

    public function education()
    {
    	return $this->hasMany('App\Models\Education');
    }

    public function experience()
    {
    	return $this->hasMany('App\Models\Experience');
    }
}
