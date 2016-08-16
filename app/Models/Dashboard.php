<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dashboard extends Model
{
    protected $table = 'dashboards';
	
    protected $fillable = [
        'total_earned', 'total_hours', 'numbers_extras', 'numbers_establishement', 'level', 'student_id',
    ];

    public function student()
    {
    	return $this->belongsTo('App\Models\Student');
    }
}
