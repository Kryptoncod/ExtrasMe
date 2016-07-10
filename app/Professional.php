<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Professional extends Model
{
    protected $fillable = [
        'company_name', 'category', 'first_name', 'last_name', 'phone', 'zipcode', 'state', 
        'country', 'address', 'user_id', 'credit'
    ];

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function extra()
    {
    	return $this->belongsToMany('App\Extra');
    }
}
