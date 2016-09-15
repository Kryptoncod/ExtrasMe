<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Professional extends Model
{
    protected $fillable = [
        'company_name', 'category', 'first_name', 'last_name', 'phone', 'zipcode', 'state', 
        'country', 'address', 'user_id', 'credit', 'description',
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

    public function numberExtrasStudents()
    {
        return $this->belongsToMany('App\Models\Student', 'number_extras_establishement');
    }

    public function invoices()
    {
        return $this->hasMany('App\Models\Invoice');
    }
}
