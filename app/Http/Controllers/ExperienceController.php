<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CvUpdateRequest;
use App\Http\Requests\CardAvsRequest;
use App\Http\Requests\ExtraSubmitRequest;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ProfileController;

use App\Models\User;
use App\Models\Student;
use App\Models\Professional;
use App\Models\Cv;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Extra;

use App\Repositories\CvRepository;
use App\Repositories\StudentRepository;
use App\Repositories\ProfessionalRepository;
use App\Repositories\UserRepository;
use App\Repositories\ExtraRepository;
use App\Repositories\ExperienceRepository;
use App\Repositories\EducationRepository;
use App\Repositories\SkillRepository;
use App\Repositories\LanguageRepository;

use Carbon\Carbon;

use Auth, DB, Validator;

class ExperienceController extends Controller
{
	  public function show()
	  {
	    $id = Auth::user()->id;
	    $student = User::find($id)->student;
	    $name = $student->first_name." ".$student->last_name;
		$first_name = $student->first_name;
		$last_name = $student->last_name;
		$name = $first_name . " " . $last_name;
	    $extras = $student->extras()->where('doing', 1)->where('date', '>=', Carbon::now())->orderBy('date', 'ASC')->get();
	    $professionals = array();
	   	if(count($extras) > 0){
	   		for($i=0; $i < count($extras); $i++)
			{
				array_push($professionals, DB::table('professionals')->where('id', $extras[$i]->professional_id )->value('company_name'));
			}
	   	}
	    return view('user.experience', ['name' => $name, 'extras' => $extras, 'user' => Auth::user(), 'professional' => $professionals, 'username' => $id, 'student' => $student])->with('name', $name);
	  }
}