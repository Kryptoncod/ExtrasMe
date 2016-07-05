<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Professional extends Model
{
    protected $fillable = [
        'company_name', 'category', 'first_name', 'last_name', 'phone', 'zipcode', 'state', 
        'country', 'address', 'user_id'
    ];
}
