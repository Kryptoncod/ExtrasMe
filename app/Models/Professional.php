<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Professional extends Model
{
    protected $fillable = [
        'company_name', 'category', 'first_name', 'last_name', 'phone', 'zipcode', 'state', 
        'country', 'address', 'user_id', 'credit'
    ];

    public function user()
    {
    	return $this->belongsTo('App\Models\User');
    }

    public function extra()
    {
    	return $this->hasMany('App\Models\Extra');
    }

    public function students()
    {
        return $this->belongsToMany('App\Models\Student', 'favoris');
    }
}
