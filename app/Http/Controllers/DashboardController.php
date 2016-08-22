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

		if($dashboard->numbers_establishement == 0)
		{
				
				$dashboardInput = array(
					'level' => $request->input('rate'),
					'numbers_establishement' => 1,
					'total_earned' => $extra->salary * $extra->duration,
					'total_hours' => $extra->duration,
					'numbers_extras' => 1,
				);

				DB::table('dashboards')
		        ->where('id', $dashboard->id)
		        ->update($dashboardInput);

		} elseif($dashboard->numbers_establishement > 0)
		{
			$level = ($dashboard->level + $request->input('rate'))/2;
			$dashboardInput = array(
					'level' => $level,
					'numbers_establishement' => $dashboard->numbers_establishement + 1,
					'total_earned' => $extra->salary * $extra->duration,
					'total_hours' => $extra->duration,
					'numbers_extras' => 1,
				);

		}

		Db::table('extras')->where('id', $extraID)->update(['finish' => 1]);

		return redirect()->route('home', Auth::user()->id);
	}
}
