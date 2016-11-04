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
use App\Models\Dashboard;

use App\Repositories\ExtraRepository;
use App\Repositories\ProfessionalRepository;

use Carbon\Carbon;

use Auth, DB, Session;

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
      try{
        $message = 'RAS';
        if(session()->has('message')){
          $message = session('message');
        }
        $id = Auth::user()->id;
        $type = User::find($username)->type;
        $favExtras = NULL;
        $linksFav = NULL;
        $canDownloadCard = 0;
        $i = 0;
        $studentApply = 0;
        $extrasSecondGroup = [];
        
        if(User::find($id)->type == 0)
        {
          $studentID = User::find($id)->student->id;

          if(Student::find($studentID)->group == 1)
          {
            $extras = Extra::orderBy('date_start', 'ASC')->where('finish', 0)->where('find', 0)->where('date_start', '>', Carbon::now())->simplePaginate(3);
            $links = $extras->render();

            $results = Student::find($studentID)->professionals()->where('type', 0)->get();

            foreach($results as $result)
            {
              $favExtras[$i] = Extra::where('professional_id', $result->id)->where('finish', 0)->where('find', 0)->get();
              $i++;
            }
          }
          else if(Student::find($studentID)->group == 2)
          {
            $extras = Extra::orderBy('date_start', 'ASC')->where('finish', 0)->where('find', 0)->where('open', 1)->where('date_start', '>', Carbon::now())->simplePaginate(3);
            
            $links = $extras->render();

            $results = Student::find($studentID)->professionals()->where('type', 0)->get();

            foreach($results as $result)
            {
              $favExtras[$i] = Extra::where('professional_id', $result->id)->where('finish', 0)->where('find', 0)->where('open', 1)->get();
              $i++;
            }
          }
          else
          {
            $extras = null;
            $links = null;
          }

          $name = User::find($id)->student->first_name." ".User::find($id)->student->last_name;
        }
        else if(User::find($id)->type == 1){

          $name = User::find($id)->professional->company_name;
          $professionalID = User::find($id)->professional->id;
          $extraToRate = Professional::find($professionalID)->extra()->where('date_start', '<', Carbon::now())->where('finish', 0)->orderBy('date_start', 'DESC')->get();

          foreach ($extraToRate as $extra) {
            $startTime = new Carbon($extra->date_start.' '.$extra->date_start_time);
            $endTime = $startTime->addHours($extra->duration)->toDateTimeString();

            if($endTime < Carbon::now('UTC'))
            {

              $find = DB::table('extras_students')->where('extra_id', $extra->id)
                ->where('doing', 1)->get();

              if(!empty($find))
              {
                  foreach($find as $f)
                  {
                    $studentToRate[] = Student::find($f->student_id);
                  }
                  
                  return view('user.rating', ['user' => User::find($username), 'professional' => User::find($username)->professional, 'username' => $username,
                  'AuthId' => $id, 'name' => $name, 'studentToRate' => $studentToRate, 'extra' => $extra]);
              }
            }
          }

          $extras = Professional::find($professionalID)->extra()->where('date_start', '>=', Carbon::now())->where('finish', 0)->orderBy('date_start', 'ASC')->simplePaginate(3);
          $links = $extras->render();
          $results = null;

          $extrasToDo = Professional::find($professionalID)->extra;

          foreach ($extrasToDo as $extra) {
            
            $studentIfAccepted = DB::table('extras_students')->where('extra_id', $extra->id)
                                  ->where('doing', 1)->value('student_id');

            if(User::find($username)->type == 0 && count($studentIfAccepted) != null)
            {
              
              if(User::find($username)->student->id == $studentIfAccepted)
              {
                $canDownloadCard = 1;
              }
            }

            $studentDemandApply = DB::table('extras_students')->where('extra_id', $extra->id)
                                  ->where('doing', 0)->value('student_id');

            if(User::find($username)->type == 0 && count($studentDemandApply) != 0)
            {
              
              if(User::find($username)->student->id == $studentDemandApply)
              {
                $studentApply = 1;
              }
            }
          }
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

          return view('user.student', ['user' => User::find($username), 'student' => $student, 'extras' => $extras, 'AuthId' => $id, 'name' => $name, 'links' => $links, 'favExtras' => $favExtras, 'linksFav' => $linksFav, 'favPro' => $results, 'experiences' => $experiences, 'educations' => $educations, 'languages' => $languages, 'skills' => $skills, 'canDownloadCard' => $canDownloadCard, 'studentApply' => $studentApply])->with('username', $username);
        }
        else if($type == 1)
        {

          return view('user.professional', ['user' => User::find($username), 'professional' => User::find($username)->professional, 'extras' => $extras, 'links' => $links, 'username' => $username, 'AuthId' => $id, 'name' => $name, 'message' => $message]);
        }
      }
      catch(\Exception $e)
      {
        return view('errors.404');
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
