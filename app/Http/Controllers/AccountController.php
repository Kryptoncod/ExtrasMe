<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\CvUpdateRequest;
use App\Http\Requests\CardAvsRequest;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ProfileController;

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

	public function registerUpdate(CardAvsRequest $request){
		$id = Auth::user()->id;
		$first_name = User::find($id)->student->first_name;
    	$last_name = User::find($id)->student->last_name;
   		$name = $first_name . " " . $last_name;
   		$message = "";
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
							}
						}
					}
				}
			}
			
		}
		return redirect()->route('account', $id)->with('message', $message);
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