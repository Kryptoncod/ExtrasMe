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
use App\Models\Invoice;

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
		try
		{
			if(Auth::user()->type == 0)
			{
				$AuthID = Auth::user()->id;
				$student = User::find($AuthID)->student;
				$name = $student->first_name." ".$student->last_name;
				$sumeTime = [];
				$timeLeft = 15;

				$extras = Student::find($student->id)->extras()->where('finish', 1)->get();

				foreach ($extras as $extra) {
					
					$startDate = Carbon::parse($extra->date.' '.$extra->date_time);

					if(Carbon::parse('this sunday')->diffInDays($startDate) <= 7)
					{
						$sumeTime[] = $extra->duration;
					}
				}

				if(array_sum($sumeTime) >= 10)
				{
					$timeLeft = $timeLeft - array_sum($sumeTime);
				}

				return view('user.dashboardStudent', ['name' => $name, 'dashboard' => Student::find($student->id)->dashboard, 'timeLeft' => $timeLeft]);

			} elseif (Auth::user()->type == 1)
			{
				$AuthID = Auth::user()->id;
				$professional = User::find($AuthID)->professional;
				$name = $professional->company_name;
				$numberhours = 0;

				$numberOfExtras = Professional::find($professional->id)->extra()->where('finish', 1)->get();

				$daysLeft = Professional::find($professional->id)->invoices()->where('paid', 1)->orderBy('updated_at', 'DESC')->get();

				foreach($numberOfExtras as $extra) {

					$numberhours = $numberhours + $extra->duration;
				}

				$economise = $numberhours * 10 - $numberOfExtras->count() * 8;

				return view('user.dashboardProfessional', ['name' => $name, 'professional' => $professional, 'numberOfExtras' => $numberOfExtras, 'daysLeft' => $daysLeft, 'economise' => $economise]);
			}

		}
		catch (\Exception $e)
		{
			dd($e);
		}
	}

	public function rate($studentID, $extraID, $grade, $hours)
	{
		try
		{
			$dashboard = Dashboard::find($studentID);
			$extra = Extra::find($extraID);
			$level = 0;
			$NumberOfRating = 1;

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
					'number_extras' => 1,
					]);

			} else {

				DB::table('number_extras_establishement')->where('student_id', $studentID)
				->where('professional_id', $professionalID)
				->update([
					'number_extras' => $number + 1,
					]);
			}

			DB::table('extras_students')->where('extra_id', $extraID)->where('student_id', $studentID)
			->update(['rate' => $grade]);

			$studentExtras =  DB::table('extras_students')->where('student_id', $studentID)->where('doing', 1)->get();

			foreach ($studentExtras as $studentExtra) {

				$extraOfStudentID = DB::table('extras_students')->where('id', $studentExtra->id)->where('doing', 1)->value('extra_id');

				$extraOfStudent = Extra::find($extraOfStudentID);

	          	if($extraOfStudent->finish == 1)
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
				'total_earned' => $total_earned + ($extra->salary * $hours),
				'total_hours' => $total_hours + $hours,
				'numbers_extras' => $number_extras + 1,
			);

			DB::table('dashboards')
	        ->where('id', $dashboard->id)
	        ->update($dashboardInput);
		}
		catch(\Exception $e)
		{
			dd($e);
		}
	}
}
