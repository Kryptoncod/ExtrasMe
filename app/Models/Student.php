<?php

namespace App\Models;

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
    	return $this->belongsTo('App\Models\User');
    }

    public function extras()
    {
    	return $this->belongsToMany('App\Models\Extra', 'extras_students');
    }

    public function professionals()
    {
        return $this->belongsToMany('App\Models\Professional', 'favoris');
    }

    public function cv()
    {
        return $this->hasMany('App\Models\Cv');
    }
}
