<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\CvUpdateRequest;
use App\Http\Requests\CardAvsRequest;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ProfileController;

use App\Models\User;
use App\Models\Student;
use App\Models\Professional;
use App\Models\Cv;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Dashboard;
use App\Models\Extra;

use App\Repositories\DashboardRepository;
use App\Repositories\ExtraRepository;

use Carbon\Carbon;

use Auth, DB, Validator;

class DashboardController extends Controller
{
	protected $dashboardRepository;
	protected $extraRepository;

  public function __construct(DashboardRepository $dashboardRepository,
															ExtraRepository $extraRepository)
  {
    $this->middleware('auth');
    $this->dashboardRepository = $dashboardRepository;
		$this->extraRepository = $extraRepository;
  }

	public function show()
	{
		$AuthID = Auth::user()->id;
		$student = User::find($AuthID)->student;
		$name = $student->first_name." ".$student->last_name;

		return view('user.dashboard', ['name' => $name, 'dashboard' => Student::find($student->id)->dashboard]);
	}

	public function rate($username, $studentID, $extraID, Request $request)
	{
		$dashboard = Dashboard::find($studentID);
		$extra = Extra::find($extraID);
		$level = 0;
		$NumberOfRating = 0;

		$professionalID = $extra->professional->id;

		$testNumber = DB::table('number_extras_establishement')->where('professional_id', $professionalID)
			->where('student_id', $studentID)->get();

		$number =  DB::table('number_extras_establishement')->where('professional_id', $professionalID)
			->where('student_id', $studentID)->value('number_extras');

		if($testNumber == NULL)
		{
			DB::table('number_extras_establishement')->insert([
				'student_id' => $studentID,
				'professional_id' => $professionalID,
				'number_extras' => 1
				]);

		} else {

			DB::table('number_extras_establishement')->where('student_id', $studentID)
			->where('professional_id', $professionalID)
			->update([
				'number_extras' => $number + 1,
				]);
		}

		DB::table('extras_students')->where('extra_id', $extraID)->where('student_id', $studentID)
		->update(['rate' => $request->input('rate')]);

		$studentExtras =  DB::table('extras_students')->where('student_id', $studentID)->where('done', 1)->get();

		foreach ($studentExtras as $studentExtra) {

			$extraOfStudentID = DB::table('extras_students')->where('id', $studentExtra->id)->where('done', 1)->value('extra_id');

			$extraOfStudent = Extra::find($extraOfStudentID);

			$startTime = new Carbon($extraOfStudent->date.' '.$extraOfStudent->date_time);
          	$endTime = $startTime->addHours($extraOfStudent->duration)->toDateTimeString();

          	if($endTime < Carbon::now('UTC'))
          	{
          		$level = $level + DB::table('extras_students')->where('id', $studentExtra->id)->value('rate');
          		$NumberOfRating++;
          	}
		}

		$level = $level / $NumberOfRating;

		$numbers_establishement = DB::table('number_extras_establishement')->where('student_id', $studentID)
		->get();

		$number_extras = DB::table('dashboards')->where('student_id', $studentID)->value('numbers_extras');
		$total_earned = DB::table('dashboards')->where('student_id', $studentID)->value('total_earned');
		$total_hours = DB::table('dashboards')->where('student_id', $studentID)->value('total_hours');
				
		$dashboardInput = array(
			'level' => $level,
			'numbers_establishement' => count($numbers_establishement),
			'total_earned' => $total_earned + ($extra->salary * $extra->duration),
			'total_hours' => $total_hours + $extra->duration,
			'numbers_extras' => $number_extras + 1,
		);

		DB::table('dashboards')
        ->where('id', $dashboard->id)
        ->update($dashboardInput);

		DB::table('extras')->where('id', $extraID)->update(['finish' => 1]);

		return redirect()->route('home', Auth::user()->id);
	}
}
