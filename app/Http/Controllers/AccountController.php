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

use App\Repositories\ExtraRepository;
use App\Repositories\ProfessionalRepository;

use Carbon\Carbon;
use Auth, DB, GeoIP;

class AccountController extends Controller
{
	public function registerUpdate(Request $request){

	}
	public function cvUpdate(Request $request){

	}
	public function profileUpdate(Request $request){

	}

}