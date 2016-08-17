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

class AccountController extends Controller
{

	protected $cvRepository;
	protected $experienceRepository;
	protected $educationRepository;
	protected $skillRepository;
	protected $languageRepository;
	protected $studentRepository;
	protected $userRepository;
	protected $professionalRepository;

	public function __construct(CvRepository $cvRepository,
		StudentRepository $studentRepository, 
		ExperienceRepository $experienceRepository,
		EducationRepository $educationRepository,
		SkillRepository $skillRepository,
		LanguageRepository $languageRepository,
		UserRepository $userRepository,
		ProfessionalRepository $professionalRepository)
	{
		$this->middleware('auth');
		$this->cvRepository = $cvRepository;
		$this->studentRepository = $studentRepository;
		$this->experienceRepository = $experienceRepository;
		$this->educationRepository = $educationRepository;
		$this->skillRepository = $skillRepository;
		$this->languageRepository = $languageRepository;
		$this->studentRepository = $studentRepository;
		$this->userRepository = $userRepository;
		$this->professionalRepository = $professionalRepository;

	}


	public function show()
	{
		$id = Auth::user()->id;
		$experiences = null;
        $educations = null;
        $languages = null;
        $skills = null;
        $student = null;

		if(Auth::user()->type == 0)
		{
			$student = Student::find(User::find($id)->student->id);
			$first_name = User::find($id)->student->first_name;
			$last_name = User::find($id)->student->last_name;
			$name = $first_name . " " . $last_name;

			try{
	          $cvID = $student->cv->id;
	          $experiences = Cv::find($cvID)->experiences->sortByDesc('date_to');
	          $educations = Cv::find($cvID)->educations->sortByDesc('date_to');
	          $languages = Cv::find($cvID)->languages;
	          $skills = Cv::find($cvID)->skills;
	        } catch(\Exception $e){
	          $experiences = null;
	          $educations = null;
	          $languages = null;
	          $skills = null;
	        }

		return view('user.account', ['user' => Auth::user(), 'name' => $name, 'student' => $student, 'experiences' => $experiences, 'educations' => $educations, 'languages' => $languages, 'skills' => $skills]);
		}
		elseif(Auth::user()->type == 1)
		{
			$name = User::find($id)->professional->company_name;
        	$professionalID = User::find($id)->professional->id;
        	$professional = Professional::find(User::find($id)->professional->id);

        	return view('user.account', ['user' => Auth::user(), 'name' => $name, 'student' => $student, 'experiences' => $experiences, 'educations' => $educations, 'languages' => $languages, 'skills' => $skills, 'professional' => $professional]);
		}
	}

	public function registerUpdate(Request $request)
	{
		$id = Auth::user()->id;
		$studentID = User::find($id)->student->id;
		$first_name = User::find($id)->student->first_name;
		$last_name = User::find($id)->student->last_name;
		$name = $first_name . " " . $last_name;
		$message = "";


		$rule = 'required|file|mimes:jpeg,jpg|max:10000';
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
								$image1->move("$path", $name);
								$path = config('card.path')."/$id";
								$name = "avs.".$image2->getClientOriginalExtension();
								$image2->move("$path", $name);
								$path = config('card.path')."/$id";
								$name = "permit.".$image3->getClientOriginalExtension();
								$image3->move("$path", $name);
								$message = "Super ! Vous avez importé tous les fichiers nécessaires.";
								//ici on dit dans la DB que l'utilisateur à uploadé tous les fichiers
								$studentInput = array(
									'registration_done' => 1,
									);
								$student = $this->studentRepository->update($studentID, $studentInput);
							}
						}
					}
				}
			}
			
		}
		
		return redirect()->route('account', $id)->with('message', $message);
	}

	public function cvUpdate(Request $request)
	{

		$i = 1;
		
		$id = Auth::user()->id;
		$student = User::find($id)->student;
		$studentID = $student->id;
		if($student->cv != null){
			$student->cv->delete();
		}
		$cvInput = array(
			'summary' => $request->input('resume'),
			'student_id' => $studentID,
			);

		$cv = $this->cvRepository->store($cvInput);

		while ($request->input('experience-title'.$i)) {
			//dd($request->input('experience-from'.$i));
			$experienceInput = array(
				'title' => $request->input('experience-title'.$i),
				'from_date' => Carbon::createFromFormat('d/m/Y', $request->input('experience-from'.$i)),
				'to_date' => Carbon::createFromFormat('d/m/Y', $request->input('experience-to'.$i)),
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
				'from_date' => Carbon::createFromFormat('d/m/Y', $request->input('education-from'.$i)),
				'to_date' => Carbon::createFromFormat('d/m/Y', $request->input('education-to'.$i)),
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
		$message = "Vos modification ont bien été prises en compte";
		return redirect()->route('account', $id)->with('message', $message);
	}

	public function profileUpdate(Request $request)
	{
		$userId = Auth::user()->id;
		if(Auth::user()->type == 0)
		{
			$studentId = User::find($userId)->student->id;
			$studentInput = array(
				'first_name' => $request->input('first-name'),
				'last_name' => $request->input('last-name'),
				'phone' => $request->input('phone'),
				'school_year' => config('international.ehl_years')[$request->input('school_year')],
			);
			
			$student = $this->studentRepository->update($studentId, $studentInput);

			$userInput = array(
				'email' => $request->input('email'),
			);
			$user = $this->userRepository->update($userId, $userInput);
			if($request->input('image-data') != ""){
				//save your data into a variable - last part is the base64 encoded image
			    $encoded = $request->input('image-data');

			    $exp = explode(',', $encoded);
			    //decode the image and finally save it
			    $data = base64_decode($exp[1]);
			    $file = "uploads/pp/$userId.png";
			    //make sure you are the owner and have the rights to write content
			    file_put_contents($file, $data);
			}
			$message = "Vos modification ont bien été prises en compte";
			return redirect()->route('account', $userId)->with('message', $message);
		}
		else
		{
			$professionalID = User::find($userId)->professional->id;
			$professionalInput = array(
				'company_name' => $request->input('company-name'),
				'category' => config('international.professionals_categories')[$request->input('category')],
				'first_name' => $request->input('first-name'),
				'last_name' => $request->input('last-name'),
				'phone' => $request->input('phone'),
				'address' => $request->input('address'),
				'zipcode' => $request->input('zipcode'),
				'state' => $request->input('state'),
				'country' => config('international.countries')[$request->input('country')],
			);

			$professional = $this->professionalRepository->update($professionalID, $professionalInput);

			$userInput = array(
				'email' => $request->input('email'),
			);
			$user = $this->userRepository->update($userId, $userInput);
			if($request->input('image-data') != ""){
				//save your data into a variable - last part is the base64 encoded image
			    $encoded = $request->input('image-data');

			    $exp = explode(',', $encoded);
			    //decode the image and finally save it
			    $data = base64_decode($exp[1]);
			    $file = "uploads/pp/$userId.png";
			    //make sure you are the owner and have the rights to write content
			    file_put_contents($file, $data);
			}
			$message = "Vos modification ont bien été prises en compte";
			return redirect()->route('account', $userId)->with('message', $message);
		}
	}

	public function filesReset()
	{
		$id = Auth::user()->id;
		$studentID = User::find($id)->student->id;
		$studentInput = array(
			'registration_done' => 0,
			);
		$student = $this->studentRepository->update($studentID, $studentInput);
		unlink("uploads/$id/carte-id.jpg");
		unlink("uploads/$id/avs.jpg");
		unlink("uploads/$id/permit.jpg");
		return redirect()->route('account', $id);
	}

	public function descriptionUpdate(Request $request)
	{
		$id = Auth::user()->id;
		$professionalID = User::find($id)->professional->id;
		
		$professionalInput = array(
			'description' => $request->input('description'),
			);

		$professional = $this->professionalRepository->update($professionalID, $professionalInput);

		return redirect()->route('account', $id); 
	}
}