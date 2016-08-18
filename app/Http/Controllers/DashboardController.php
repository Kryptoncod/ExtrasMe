<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\CvUpdateRequest;
use App\Http\Requests\CardAvsRequest;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ProfileController;

use App\Models\User;
use App\Models\Student;
use App\Models\Professional;
use App\Models\Cv;
use App\Models\Education;
use App\Models\Experience;

use App\Repositories\CvRepository;
use App\Repositories\StudentRepository;
use App\Repositories\ProfessionalRepository;
use App\Repositories\UserRepository;
use App\Repositories\ExperienceRepository;
use App\Repositories\EducationRepository;
use App\Repositories\SkillRepository;
use App\Repositories\LanguageRepository;

use Carbon\Carbon;

use Auth, DB, Validator;

class DashboardController extends Controller
{
	public function show()
	{
		$AuthID = Auth::user()->id;
		$student = User::find($AuthID)->student;
		$name = $student->first_name." ".$student->last_name;

		return view('user.dashboard', ['name' => $name, 'dashboard' => Student::find($student->id)->dashboard]);
	}
}