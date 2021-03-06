<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    protected $fillable = [
        'title', 'from_date', 'to_date', 'summary', 'cv_id'
    ];
    protected $dates = ['from_date', 'to_date'];
    public function cv()
    {
    	return $this->belongsTo('App\Models\Cv');
    }
}