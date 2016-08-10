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
		/*$extensions_valides = array("jpg", "png", "pdf", "gif", "jpeg", "tiff", "doc", "docx", "odt");
		$file_max_size = 8388608;
		$error = null;
		if ($request->hasFile('carte-id')){
			$carte_id = $request->file('carte-id');
		    if(in_array($carte_id->guessExtension(), $extensions_valides)){
		    	if($carte_id->getClientSize() <= $file_max_size){
		    		$path = "uploads/$id/carte_id";
		    		$name = "carte_id.".$carte_id->guessExtension();
		    		$carte_id->move($path, $name);
		    	}else{
		    		$error = "Taille du fichier pour la carte d'identité trop grande (Max : 8Mo).";
		    	}
		    }else{
		    	$error = "Extension du fichier pour la carte d'identité non valide (format autorisés : jpg, jpeg, png, gif, tiff, pdf, doc, docx, odt).";
		    }
		}
		
		if ($request->hasFile('avs')) {
			$avs = $request->file('avs');
		    if(in_array($avs->guessExtension(), $extensions_valides)){
		    	if($avs->getClientSize() <= $file_max_size){
		    		$path = "uploads/$id/carte_avs";
		    		$name = "avs.".$avs->guessExtension();
		    		$avs->move($path, $name);
		    	}else{
		    		$error = "Taille du fichier pour la carte AVS trop grande (Max : 8Mo).";
		    	}
		    }else{
		    	$error = "Extension du fichier pour la carte AVS non valide (format autorisés : jpg, jpeg, png, gif, tiff, pdf, doc, docx, odt).";
		    }
		}
		if ($request->hasFile('permit')) {
			$permit = $request->file('permit');
		    if(in_array($permit->guessExtension(), $extensions_valides)){
		    	if($permit->getClientSize() <= $file_max_size){
		    		$path = "uploads/$id/permit";
		    		$name = "permit.".$permit->guessExtension();
		    		$permit->move($path, $name);
		    	}else{
		    		$error = "Taille du fichier pour le permis de travail trop grande (Max : 8Mo).";
		    	}
		    }else{
		    	$error = "Extension du fichier pour le permis de travail non valide (format autorisés : jpg, jpeg, png, gif, tiff, pdf, doc, docx, odt).";
		    }
		}*/

		if ($request->hasFile('carte-id'))
		{
			$image = $request->file('carte-id');

			if($image->isValid())
			{
				$chemin = config('card.path');

				$extension = $image->getClientOriginalExtension();

				do {
					$nom = 'carte_id.' . $extension;
				} while(file_exists($chemin . '/' . $nom));

				if($image->move($chemin, $nom)) {
					return redirect()->route('account', $id);
				}
			}
		}

		return redirect()->route('account', $id)->with('error', 'Désolé mais impossible');
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