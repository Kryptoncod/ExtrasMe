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

    public function User()
    {
    	return $this->belongsTo('App\User');
    }
}
