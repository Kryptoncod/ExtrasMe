<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\ExtraSearchRequest;
use App\Http\Requests\ExtraSubmitRequest;
use App\Http\Controllers\Controller;

use App\User;
use App\Extra;
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
    public function show()
    {
      try
      {
        $id = Auth::user()->id;
        $type = User::find($id)->type;
        $extras = DB::table('extras')->get();;

        if($type == 0)
        {

          $first_name = User::find($id)->student->first_name;
          $last_name = User::find($id)->student->last_name;
          $name = $first_name . " " . $last_name;

          return view('user.student', ['user' => Auth::user(), 'student' => User::find($id)->student, 'extras' => $extras, 'username' => $id])->with('name', $name);
        }
        else if($type == 1)
        {
          $professionalID = User::find($id)->professional->id;
          $extras = Professional::find($professionalID)->extra;

          $name = User::find($id)->professional->company_name;

          return view('user.professional', ['user' => Auth::user(), 'professional' => User::find($id)->professional, 'extras' => $extras, 'username' => $id])->with('name', $name);
        }
      } catch (\Exception $e) {
         dd($e);
         abort(404);
      }
    }

    public function extraSubmit(ExtraSubmitRequest $request)
    {
      $id = Auth::user()->id;
      $professionalID = User::find($id)->professional->id;
      $type = config('international.last_minute_types')[$request->input('type')];
      $date = Carbon::createFromFormat('m/d/Y', $request->input('date'));
      $time = Carbon::createFromFormat('H:i', $request->input('time'));
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

      return redirect()->route('home');
    }

    public function extraSearch(Request $request)
    {
      return redirect()->route('extra_list');
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
        for($i=0; $i < count($extras); $i++){
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

      return view('user.myExtrasList', ['user' => Auth::user(), 'professional' => User::find($id)->professional, 'extras' => $extras, 'username' => $id]);
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

        return redirect()->route('home');
      }
      catch (Exception $e)
      {
         //abort(404);
      }
    }

}
