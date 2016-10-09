<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
        'paid', 'number_announce', 'price', 'price_announce', 'professional_id', 'type_payment',
    ];

    public function professional()
    {
    	return $this->belongsTo('App\Models\Professional');
    }
}
