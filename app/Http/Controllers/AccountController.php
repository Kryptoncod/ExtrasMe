<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\ExtraSearchRequest;
use App\Http\Requests\ExtraSubmitRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\FavoriteSearchRequest;

use App\Models\User;
use App\Models\Extra;
use App\Models\Student;
use App\Models\Professional;

use App\Repositories\ExtraRepository;
use App\Repositories\ProfessionalRepository;

use Carbon\Carbon;
use Redirect;
use Auth, DB, GeoIP;

class AccountController extends Controller
{
	public function registerUpdate(Request $request){
		$id = Auth::user()->id;
		$first_name = User::find($id)->student->first_name;
    	$last_name = User::find($id)->student->last_name;
   		$name = $first_name . " " . $last_name;
		$extensions_valides = array("jpg", "png", "pdf", "gif", "jpeg", "tiff", "doc", "docx", "odt");
		$file_max_size = 8388608;
		$error = "";
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
		}
		return Redirect::route('account', $id)->with('error', $error);
	}
	public function cvUpdate(Request $request){

	}
	public function profileUpdate(Request $request){

	}

}