<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cv extends Model
{
    protected $table = 'cvs';

    protected $fillable = [
        'languages', 'skills', 'summary', 'student_id'
    ];

    public function student()
    {
    	return $this->belongsTo('App\Models\Student');
    }

    public function educations()
    {
    	return $this->hasMany('App\Models\Education');
    }

    public function experiences()
    {
    	return $this->hasMany('App\Models\Experience');
    }

    public function competences()
    {
        return $this->hasMany('App\Models\Competence');
    }

    public function languages()
    {
        return $this->hasMany('App\Models\Language');
    }
}
