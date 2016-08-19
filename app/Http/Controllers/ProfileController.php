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
use App\Models\Cv;
use App\Models\Experience;
use App\Models\Education;
use App\Models\Language;
use App\Models\Competence;
use App\Models\EventModel;

use App\Repositories\ExtraRepository;
use App\Repositories\ProfessionalRepository;

use Carbon\Carbon;

use Auth, DB, GeoIP;

class ProfileController extends Controller
{

  protected $extraRepository;
  protected $professionalRepository;

  public function __construct(ExtraRepository $extraRepository,
                              ProfessionalRepository $professionalRepository)
  {
    $this->middleware('auth');
    $this->extraRepository = $extraRepository;
    $this->professionalRepository = $professionalRepository;
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */

  public function show($username)
  {
    try
    {
      $id = Auth::user()->id;
      $type = User::find($username)->type;
      $favExtras = NULL;
      //$location = GeoIP::getLocation();
      if(User::find($id)->type == 0)
      {
        $extras = $this->extraRepository->getPaginate(3);
        $studentID = User::find($id)->student->id;
        $links = $extras->render();
        $name = User::find($id)->student->first_name." ".User::find($id)->student->last_name;
        $results = Student::find($studentID)->professionals()->where('type', 0)->get();

        foreach($results as $result)
        {
          $favExtras[] = Professional::find($result->id)->extra;
        }
      }
      else if(User::find($id)->type == 1){
        $name = User::find($id)->professional->company_name;
        $professionalID = User::find($id)->professional->id;
        $extras = Professional::find($professionalID)->extra;
        $links = null;
        $results = null;
      }

      if($type == 0)
      {
        $user_student = User::find($username);
        $student = $user_student->student;
        try{
          $cvID = $student->cv->id;
          $experiences = Cv::find($cvID)->experiences;
          $educations = Cv::find($cvID)->educations;
          $languages = Cv::find($cvID)->languages;
          $skills = Cv::find($cvID)->skills;
        } catch(\Exception $e){
          $experiences = null;
          $educations = null;
          $languages = null;
          $skills = null;
        }

        return view('user.student', ['user' => User::find($username), 'student' => $student, 'extras' => $extras, 'AuthId' => $id, 'name' => $name, 'links' => $links, 'favExtras' => $favExtras, 'favPro' => $results, 'experiences' => $experiences, 'educations' => $educations, 'languages' => $languages, 'skills' => $skills])->with('username', $username);
      }
      else if($type == 1)
      {

        return view('user.professional', ['user' => User::find($username), 'professional' => User::find($username)->professional, 'extras' => $extras, 'username' => $username, 'AuthId' => $id, 'name' => $name]);
      }
    } catch (\Exception $e) {
       dd($e);
       abort(404);
    }
  }


  public function showApplicationDownload()
  {
    $AuthID = Auth::user()->id;
    
    if(Auth::user()->type == 0)
    {

      $student = User::find($AuthID)->student;
      $name = $student->first_name." ".$student->last_name;

    } elseif(Auth::user()->type == 1){

      $professional = User::find($AuthID)->professional;
      $name = $professional->company_name;

    }

    return view('user.applicationDownload', ['name' => $name]);
  }
}
