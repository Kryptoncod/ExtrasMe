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
use App\Models\Cv;
use App\Models\Experience;
use App\Models\Education;
use App\Models\Language;
use App\Models\Competence;
use App\Models\EventModel;

use App\Repositories\ExtraRepository;
use App\Repositories\ProfessionalRepository;
use App\Repositories\UserRepository;

use Carbon\Carbon;

use Auth, DB, GeoIP;

class AdminController extends Controller
{

  protected $extraRepository;
  protected $professionalRepository;
  protected $userRepository;

  public function __construct(ExtraRepository $extraRepository,
                              ProfessionalRepository $professionalRepository,
                              UserRepository $userRepository)
  {
    $this->middleware('auth');
    $this->extraRepository = $extraRepository;
    $this->professionalRepository = $professionalRepository;
    $this->userRepository = $userRepository;
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */

  public function index()
  {
    $users = $this->userRepository->getPaginate(6);
    $links = $users->render();

    return view('admin.index', compact('users', 'links'));
  }
}
