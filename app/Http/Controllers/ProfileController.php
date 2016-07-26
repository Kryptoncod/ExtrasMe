<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\ExtraSearchRequest;
use App\Http\Requests\ExtraSubmitRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\FavoriteSearchRequest;

use App\User;
use App\Extra;
use App\Student;
use App\Professional;

use App\Repositories\ExtraRepository;

use Carbon\Carbon;
use Auth, DB;

class ProfileController extends Controller
{

  protected $extraRepository;

  public function __construct(ExtraRepository $extraRepository)
  {
    $this->middleware('auth');
    $this->extraRepository = $extraRepository;
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

      if(User::find($id)->type == 0)
      {
        $extras = $this->extraRepository->getPaginate(3);
        $links = $extras->render();
        $name = User::find($id)->student->first_name." ".User::find($id)->student->last_name;
      }
      else if(User::find($id)->type == 1){
        $name = User::find($id)->professional->company_name;
        $professionalID = User::find($id)->professional->id;
        $extras = Professional::find($professionalID)->extra;
        $links = null;
      }

      if($type == 0)
      {
        return view('user.student', ['user' => User::find($username), 'student' => User::find($username)->student, 'extras' => $extras, 'AuthId' => $id, 'name' => $name, 'links' => $links])->with('username', $username);
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

  public function extraSubmit(Request $request)
  {
    try{
      $id = Auth::user()->id;
      $professionalID = User::find($id)->professional->id;
      $type = config('international.last_minute_types')[$request->input('type')];
      $date_time = $request->input('date');
      list($dateBis, $timeBis) = explode(" ", $date_time);
      //dd($date_time);
      $date = Carbon::createFromFormat('m/d/Y', $dateBis);
      $time = Carbon::createFromFormat('H:i', $timeBis);
      $last_minute = $request->input('broadcast') == 'last_minute';

      $extraInput = array(
          'broadcast' => $last_minute,
          'type' => $type,
          'date' => $date->format('Y-m-d'),
          'date_time' => $time->format('H:i'),
          'duration' => $request->input('duration'),
          'salary' => $request->input('salary'),
          'requirements' => $request->input('requirements'),
          'benefits' => $request->input('benefits'),
          'informations' => $request->input('informations'),
          'professional_id' => $professionalID,
      );

      $extra = $this->extraRepository->store($extraInput);

      return redirect()->route('home', Auth::user()->id);

    } catch(\Exception $e){
      dd($e);
    }
  }

  public function extraSearch(Request $request)
  {
    $id = Auth::user()->id;
    return redirect()->route('extra_list', $id);
  }

  public function showExtraList()
  {

    $id = Auth::user()->id;
    $type = User::find($id)->type;

    if($type == 0)
    {
      $first_name = User::find($id)->student->first_name;
      $last_name = User::find($id)->student->last_name;
      $name = $first_name . " " . $last_name;

      $extras = DB::table('extras')->get();
      //On récupère le nom des professionnels qui proposent des extras
      $professionals = array();
      for($i=0; $i < count($extras); $i++)
      {
        array_push($professionals, DB::table('professionals')->where('id', $extras[$i]->professional_id )->value('company_name'));
      }
      return view('user.extra', ['extras' => $extras, 'user' => Auth::user(), 'professional' => $professionals, 'username' => $id])->with('name', $name);
    }
  }

  public function myExtras()
  {
    $id = Auth::user()->id;
    $professionalID = User::find($id)->professional->id;
    $extras = Professional::find($professionalID)->extra;
    $name = User::find($id)->professional->company_name;

    return view('user.myExtrasList', ['user' => Auth::user(), 'professional' => User::find($id)->professional, 'extras' => $extras, 'username' => $id, 'name' => $name]);
  }

  public function extra($id)
  {
    try
    {
       $extra = ExtrasMeApi::getExtra($id);
    }
    catch (Exception $e)
    {
       abort(404);
    }


    return view('user.extra', ['extra' => $extra]);
  }

  public function extra_apply($id)
  {
    try
    {

      DB::table('extras_students')->insert(array(
        'extra_id' => $id,
        'student_id' => Auth::user()->student->id,
        ));

      return redirect()->route('home', Auth::user()->id);
    }
    catch (Exception $e)
    {
      dd($e);
      abort(404);
    }
  }

  public function myFavoriteExtras()
  {
    $id = Auth::user()->id;
    $results = null;

    if(User::find($id)->type == 0)
    {
      $name = User::find($id)->student->first_name." ".User::find($id)->student->last_name;
      $studentID = User::find($id)->student->id;
      $results = Student::find($studentID)->professionals()->where('type', 0)->get();

      return view('user.favExtrasList', ['name' => $name, 'results' => $results]);
    }
    else if(User::find($id)->type == 1)
    {
      $name = User::find($id)->professional->company_name;
      $professionalID = User::find($id)->professional->id;
      $results = Professional::find($professionalID)->students()->where('type', 1)->get();

      return view('user.favExtrasList', ['name' => $name, 'results' => $results]);
    }

    return view('user.favExtrasList', ['name' => $name, 'results' => $results]);
  }

  public function myFavoriteExtrasSearch(Request $favoriteSearchRequest)
  {
    $favoriteName = $favoriteSearchRequest->input('searchFav');

    $id = Auth::user()->id;

    if(User::find($id)->type == 0)
    {
      $name = User::find($id)->student->first_name." ".User::find($id)->student->last_name;
      $results = DB::table('professionals')->where('company_name', $favoriteName)->get();
    }
    else if(User::find($id)->type == 1)
    {
      $name = User::find($id)->professional->company_name;
      list($first_name, $last_name) = explode(" ", $favoriteName);
      $results = DB::table('students')->where('last_name', $last_name)->where('first_name', $first_name)->get();
    }

    return view('user.favExtrasSearch', ['name' => $name, 'results' => $results]);
  }

  public static function myFavoriteExtrasAdd($id)
  {
    $AuthID = Auth::user()->id;

    if(User::find($AuthID)->type == 0)
    {
      $studentID = User::find($AuthID)->student->id;
      $results = Student::find($studentID)->professionals()->where('type', 0)->get();

      if(sizeof($results) < 5)
      {
        DB::table('favoris')->insert(array(
        'professional_id' => $id,
        'student_id' => Auth::user()->student->id,
        'type' => 0,
        ));
      }
    }
    else if(User::find($AuthID)->type == 1)
    {
      $professionalID = User::find($AuthID)->professional->id;
      $results = Professional::find($professionalID)->students()->where('type', 1)->get();

      if(sizeof($results) < 5)
      {
        DB::table('favoris')->insert(array(
        'professional_id' => Auth::user()->professional->id,
        'student_id' => $id,
        'type' => 1,
        ));
      }
    }

    return redirect()->route('my_favorite_extras', Auth::user()->id);
  }
}
