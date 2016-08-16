<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\Student;
use App\Models\Professional;
use App\Models\EventModel;
use App\Models\Extra;

use Carbon\Carbon;

use Auth, DB;

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

      if(User::find($id)->type == 0)
      {
        $studentID = User::find($id)->student->id;
        $name = User::find($id)->student->first_name." ".User::find($id)->student->last_name;

        $calendar = $this->getCalendarProfessional($studentID);

        return view('user.calendar', ['user' => User::find($username), 'student' => User::find($id)->student, 'AuthId' => $id, 'name' => $name, 'calendar' => $calendar])->with('username', $username);
      }
      else if(User::find($id)->type == 1){

        $name = User::find($id)->professional->company_name;
        $professionalID = User::find($id)->professional->id;

        $calendar = $this->getCalendarProfessional($professionalID);

        return view('user.calendar', ['user' => User::find($username), 'professional' => User::find($username)->professional, 'username' => $username, 'AuthId' => $id, 'name' => $name, 'calendar' => $calendar]);
      }
    } catch (\Exception $e) {
       dd($e);
       abort(404);
    }
  }

  public function getCalendarStudent($studentID)
  {
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

    $calendar = \Calendar::addEvents($events) //add an array with addEvents
        ->setOptions([ //set fullcalendar options
            'firstDay' => 1
        ]);

    return $calendar;
  }

  public function getCalendarProfessional($professionalID)
  {
    $events = [];

    $extras = Professional::find($professionalID)->extra;

    foreach ($extras as $extra) {


      $start = new Carbon($extra->date.' '.$extra->date_time);
      $end = $start;
      $end->addHours($extra->duration);

      $events[] = \Calendar::event(
          $extra->type, //event title
          false, //full day event?
          $start,
          $end
      );
    }

    $calendar = \Calendar::addEvents($events) //add an array with addEvents
        ->setOptions([ //set fullcalendar options
            'firstDay' => 1
        ]);

    return $calendar;
  }
}
