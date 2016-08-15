<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\ExtraSearchRequest;
use App\Http\Requests\ExtraSubmitRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\FavoriteSearchRequest;

use App\Models\User;
use App\Models\Student;
use App\Models\Professional;
use App\Models\EventModel;

use Carbon\Carbon;

use Auth, DB, GeoIP;

class CalendarController extends Controller
{

	public function __construct()
	{
		$this->middleware('auth');
	}


    public function showCalendar($username)
    {
    	try
      {
        $id = Auth::user()->id;
        $type = User::find($username)->type;
        //$location = GeoIP::getLocation();

        $events = [];

        $events[] = \Calendar::event(
            'Event One', //event title
            false, //full day event?
            '2015-02-11T0800', //start time (you can also use Carbon instead of DateTime)
            '2015-02-12T0800', //end time (you can also use Carbon instead of DateTime)
            0 //optionally, you can specify an event ID
        );

        $events[] = \Calendar::event(
            "Valentine's Day", //event title
            true, //full day event?
            new \DateTime('2015-02-14'), //start time (you can also use Carbon instead of DateTime)
            new \DateTime('2015-02-14'), //end time (you can also use Carbon instead of DateTime)
            'stringEventId' //optionally, you can specify an event ID
        );

        $calendar = \Calendar::addEvents($events)->setOptions([ //set fullcalendar options
            'firstDay' => 1
        ]);

        if(User::find($id)->type == 0)
        {
          $studentID = User::find($id)->student->id;
          $name = User::find($id)->student->first_name." ".User::find($id)->student->last_name;
        }
        else if(User::find($id)->type == 1){
          $name = User::find($id)->professional->company_name;
          $professionalID = User::find($id)->professional->id;
        }

        if($type == 0)
        {
          $student = User::find($username)->student;

          return view('user.calendar', ['user' => User::find($username), 'student' => $student, 'AuthId' => $id, 'name' => $name, 'calendar' => $calendar])->with('username', $username);
        }
        else if($type == 1)
        {
          return view('user.calendar', ['user' => User::find($username), 'professional' => User::find($username)->professional, 'username' => $username, 'AuthId' => $id, 'name' => $name, 'calendar' => $calendar]);
        }
      } catch (\Exception $e) {
         dd($e);
         abort(404);
      }
    }
}
