<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use ExtrasMe\Http\Requests;
use App\Http\Controllers\Controller;

use ExtrasMeApi, DB, App;

class IndexController extends Controller
{

    public function __construct()
    {
      //$this->middleware('auth');
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
}
