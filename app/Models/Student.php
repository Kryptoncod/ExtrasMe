<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'students';

    protected $fillable = [
        'last_name', 'first_name', 'nationality', 'school_year', 'phone', 
        'gender', 'birthdate','registration_done', 'user_id', 'group', 'zipcode', 'state', 
        'country', 'address',
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
        return $this->hasOne('App\Models\Cv');
    }

    public function dashboard()
    {
        return $this->hasOne('App\Models\Dashboard');
    }

    public function numberExtrasProfessionals()
    {
        return $this->belongsToMany('App\Models\professional', 'number_extras_establishement');
    }
}
