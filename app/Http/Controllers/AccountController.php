<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\CvUpdateRequest;
use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\Extra;
use App\Models\Student;
use App\Models\Professional;
use App\Models\Cv;
use App\Models\Education;
use App\Models\Experience;

use App\Repositories\CvRepository;
use App\Repositories\ExperienceRepository;
use App\Repositories\EducationRepository;

use Carbon\Carbon;
use Auth, DB;

class AccountController extends Controller
{

	protected $cvRepository;
    protected $experienceRepository;
    protected $educationRepository;

   public function __construct(CvRepository $cvRepository, 
                                ExperienceRepository $experienceRepository,
                                EducationRepository $educationRepository)
   {
      $this->middleware('auth');
      $this->cvRepository = $cvRepository;
      $this->experienceRepository = $experienceRepository;
      $this->educationRepository = $educationRepository;
   }

	public function registerUpdate(Request $request){

	}

	public function cvUpdate(Request $request){
		
		$id = Auth::user()->id;
	    $studentID = User::find($id)->student->id;
	    $cvInput = array(
	        'summary' => $request->input('resume'),
	        'languages' => '0',
	        'skills' => '0',
	        'student_id' => $studentID,
	    );

	    $cv = $this->cvRepository->store($cvInput);

	    return redirect()->route('home', Auth::user()->id);
	}

	public function profileUpdate(Request $request){

	}

}