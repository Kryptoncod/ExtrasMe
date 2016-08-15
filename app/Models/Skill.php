<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
	protected $table = 'skills';

    protected $fillable = [
        'title', 'cv_id'
    ];

    public function cv()
    {
    	return $this->belongsTo('App\Models\Cv');
    }
}
