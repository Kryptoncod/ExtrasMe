<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\ExtraSearchRequest;
use App\Http\Requests\ExtraSubmitRequest;
use App\Http\Controllers\Controller;

use App\User;

use Carbon\Carbon;
use ExtrasMeApi, Auth;

class ProfileController extends Controller
{

    public function __construct()
    {
     $this->middleware('auth');
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
        $extras = NULL;

        if($type == 0)
        {

          $first_name = User::find($id)->student->first_name;
          $last_name = User::find($id)->student->last_name;
          $name = $first_name . " " . $last_name;

          return view('user.student', ['user' => Auth::user(), 'student' => User::find($id)->student, 'extras' => $extras])->with('name', $name);
        }
        else if($type == 1)
        {

          $name = User::find($id)->professional->company_name;

          return view('user.professional', ['user' => Auth::user(), 'professional' => User::find($id)->professional, 'extras' => $extras])->with('name', $name);
        }
      } catch (\Exception $e) {
         dd($e);
         abort(404);
      }

      /*try {
         $user = ExtrasMeApi::getUser($id);
         $type = $user->getTypeModel();

         if ($user->isStudent())
         {
            $extras = ExtrasMeApi::getExtras();

            return view('user.student', ['user' => $user, 'student' => $type, 'extras' => $extras]);
         }
         else if ($user->isProfessional())
         {
            $extras = Auth::user()->getUserModel()->getTypeModel()->getExtras();

            if (Auth::user()->user->id == $user->id) {
               abort(401);
            }

            return view('user.professional', ['user' => $user, 'professional' => $type, 'extras' => $extras]);
         }

      } catch (\Exception $e) {
         dd($e);
         abort(404);
      }*/
    }

    public function extraSubmit(ExtraSubmitRequest $request)
    {
      $userID = Auth::user()->id;
      $type = config('international.last_minute_types')[$request->input('type')];
      $datetime = Carbon::createFromFormat('m/d/Y H:i', $request->input('date').' '.$request->input('time'));
      $last_minute = $request->input('broadcast') == 'last_minute';

      $extra = ExtrasMeApi::newExtra([
         'extra_type' => $type,
         'datetime' => $datetime->format('Y-m-d H:i'),
         'duration' => $request->input('duration'),
         'salary' => $request->input('salary'),
         'requirements' => $request->input('requirements'),
         'benefits' => $request->input('benefits'),
         'informations' => $request->input('informations'),
         'last_minute' => $last_minute,
         'user_id' => $userID,
      ]);

      $extra->save();

      return redirect()->route('profile', $userID);
    }

    public function extraSearch(ExtraSearchRequest $request)
    {



      dd($request);
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
         ExtrasMeApi::completeExtra($id, Auth::user()->id);
      }
      catch (Exception $e)
      {
         abort(404);
      }
    }

}
