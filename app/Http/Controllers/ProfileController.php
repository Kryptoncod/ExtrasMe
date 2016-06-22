<?php

namespace ExtrasMe\Http\Controllers;

use Illuminate\Http\Request;

use ExtrasMe\Http\Requests;
use ExtrasMe\Http\Requests\ExtraSearchRequest;
use ExtrasMe\Http\Requests\ExtraSubmitRequest;
use ExtrasMe\Http\Controllers\Controller;

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
    public function show($id)
    {
      try {
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
      }
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
