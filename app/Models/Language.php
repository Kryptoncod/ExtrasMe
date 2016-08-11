<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
	protected $table = 'languages';

    protected $fillable = [
        'title', 'cv_id'
    ];

    public function cv()
    {
    	return $this->belongsTo('App\Models\Cv');
    }
}
