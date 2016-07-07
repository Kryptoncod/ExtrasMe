<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\User;
use App\Student;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Auth::user()->id;
        $first_name = User::find($id)->student->first_name;
        $last_name = User::find($id)->student->last_name;
        $name = $first_name . " " . $last_name;
        return view('home')->with('name', $name);
    }
}
