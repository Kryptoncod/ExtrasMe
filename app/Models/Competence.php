<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Competence extends Model
{
	protected $table = 'competences';

    protected $fillable = [
        'title', 'cv_id'
    ];

    public function cv()
    {
    	return $this->belongsTo('App\Models\Cv');
    }
}
