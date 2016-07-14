<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'students';

    protected $fillable = [
        'last_name', 'first_name', 'nationality', 'school_year', 'phone', 
        'gender', 'birthdate', 'user_id'
    ];

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function extras()
    {
    	return $this->belongsToMany('App\Extra', 'extras_students');
    }
}
