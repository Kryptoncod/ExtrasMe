<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DB, App;

class IndexController extends Controller
{

    public function __construct()
    {
      $this->middleware('guest');
    }

    /**
     * Display the landing page of the project
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('index');
    }

    /**
     * Redirect to index
     *
     * @return \Illuminate\Http\Response
     */
    public function redirect()
    {
        return redirect()->route('index');
    }

    public function language($local)
    {
        session()->set('locale', $local);

        return redirect()->back();
    }

    public function missionStatement()
    {
        return view('documents.missionStatement');
    }

    public function contactUs()
    {
        return view('documents.contact');
    }

    public function ourTeam()
    {
        return view('documents.ourTeam');
    }

    public function ambassador()
    {
        return view('documents.ambassador');
    }

    public function legal()
    {
        return view('documents.legal');
    }

    public function charter()
    {
        return view('documents.charter');
    }

    public function confirmEmailView()
    {
      return view('signup.confirmEmail');
    }
}
