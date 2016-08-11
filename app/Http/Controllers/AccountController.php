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
use App\Repositories\ExperienceRepository;
use App\Repositories\EducationRepository;
use App\Repositories\SkillRepository;
use App\Repositories\LanguageRepository;

use Carbon\Carbon;

use Auth, DB, Validator;

class AccountController extends Controller
{

	protected $cvRepository;
    protected $experienceRepository;
    protected $educationRepository;
    protected $skillRepository;
    protected $languageRepository;
    protected $studentRepository;

   public function __construct(CvRepository $cvRepository,
   								StudentRepository $studentRepository, 
                                ExperienceRepository $experienceRepository,
                                EducationRepository $educationRepository,
                                SkillRepository $skillRepository,
                                LanguageRepository $languageRepository)
   {
      $this->middleware('auth');
      $this->cvRepository = $cvRepository;
      $this->studentRepository = $studentRepository;
      $this->experienceRepository = $experienceRepository;
      $this->educationRepository = $educationRepository;
      $this->skillRepository = $skillRepository;
      $this->languageRepository = $languageRepository;
      $this->studentRepository = $studentRepository;

   }

	public function registerUpdate(Request $request){
		$id = Auth::user()->id;
		$studentID = User::find($id)->student->id;
		$first_name = User::find($id)->student->first_name;
    	$last_name = User::find($id)->student->last_name;
   		$name = $first_name . " " . $last_name;
   		$message = "";
   		
   		
   		$rule = 'required|file|mimes:jpg,png,pdf,gif,jpeg,tiff,doc,docx,odt|max:10000';
	    $validator = Validator::make($request->all(), [
	          'carte-id'   => $rule,
	          'avs'   => $rule,
	          'permit' => $rule,
	      ]);

	    if ($validator->fails()) {
	        return redirect()->route('account', $id)->with('message', $message)->withErrors($validator)->withInput();
	      }


		if ($request->hasFile('carte-id'))
		{
			$image1 = $request->file('carte-id');
			if($image1->isValid())
			{
				if ($request->hasFile('avs'))
				{
					$image2 = $request->file('avs');

					if($image2->isValid())
					{
						if ($request->hasFile('permit'))
						{
							$image3 = $request->file('permit');

							if($image3->isValid())
							{
								$path = config('card.path')."/$id";
							    $name = "carte-id.".$image1->getClientOriginalExtension();
							    $image1->move($path, $name);
							    $path = config('card.path')."/$id";
							    $name = "avs.".$image2->getClientOriginalExtension();
							    $image2->move($path, $name);
							    $path = config('card.path')."/$id";
							    $name = "permit.".$image3->getClientOriginalExtension();
							    $image3->move($path, $name);
								$message = "Super ! Vous avez importé tous les fichiers nécessaires.";
								//ici on dit dans la DB que l'utilisateur à uploadé tous les fichiers
<<<<<<< HEAD
								$student = Student::findOrFail($id);
								$student->registration_done = 1;
								$student->save();
=======
								$studentInput = array(
							        'registration_done' => 1,
							    );
							    $student = $this->studentRepository->update($studentID, $studentInput);
>>>>>>> 924a178e614733c87da0391d6b81e5afc4608d00
							}
						}
					}
				}
			}
			
		}
		
		return redirect()->route('account', $id)->with('message', $message);
	}

	public function cvUpdate(Request $request){

		$i = 1;
		
		$id = Auth::user()->id;
	    $studentID = User::find($id)->student->id;
	    $cvInput = array(
	        'summary' => $request->input('resume'),
	        'languages' => '0',
	        'skills' => '0',
	        'student_id' => $studentID,
	    );

	    $cv = $this->cvRepository->store($cvInput);

	    while ($request->input('experience-title'.$i)) {

	    	$experienceInput = array(
	    		'title' => $request->input('experience-title'.$i),
	    		'from_date' => Carbon::createFromFormat('m/d/Y', $request->input('experience-from'.$i)),
	    		'to_date' => Carbon::createFromFormat('m/d/Y', $request->input('experience-to'.$i)),
	    		'summary' => $request->input('experience-description'.$i),
	    		'cv_id' => $cv->id,
	    		);

	    	$experience = $this->experienceRepository->store($experienceInput);

	    	$i++;
	    }

	    $i = 1;

	    while ($request->input('education-title'.$i)) {

	    	$educationInput = array(
	    		'title' => $request->input('education-title'.$i),
	    		'from_date' => Carbon::createFromFormat('m/d/Y', $request->input('education-from'.$i)),
	    		'to_date' => Carbon::createFromFormat('m/d/Y', $request->input('education-to'.$i)),
	    		'summary' => $request->input('education-description'.$i),
	    		'cv_id' => $cv->id,
	    		);

	    	$education = $this->educationRepository->store($educationInput);

	    	$i++;
	    }

	    $i = 1;

	    while ($request->input('skill'.$i)) {

	    	$skillInput = array(
	    		'title' => $request->input('skill'.$i),
	    		'cv_id' => $cv->id,
	    		);

	    	$skill = $this->skillRepository->store($skillInput);

	    	$i++;
	    }

	    $i = 1;

	    while ($request->input('language'.$i)) {

	    	$languageInput = array(
	    		'title' => $request->input('language'.$i),
	    		'cv_id' => $cv->id,
	    		);

	    	$language = $this->languageRepository->store($languageInput);

	    	$i++;
	    }

	    return redirect()->route('account', Auth::user()->id);
	}

	public function profileUpdate(Request $request){

	}

}