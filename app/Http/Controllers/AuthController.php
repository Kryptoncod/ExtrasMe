<?php

namespace ExtrasMe\Http\Controllers;

use Illuminate\Http\Request;

use ExtrasMe\Http\Requests;
use ExtrasMe\Http\Controllers\Controller;

use ExtrasMeApi;
use Session, Auth;

class AuthController extends Controller
{

    public function _construct()
    {
      $this->middleware('guest', ['except' => 'logout']);
    }

    /**
     * Authenticate the user
     *
     * @return \Illuminate\Http\Response
     */
    public function authenticate(Request $req)
    {
      $a = Auth::attempt(['email' => $req->input('email'), 'password' => $req->input('password')]);
      if (!$a)
      {
         //return 'error';
      }
      return redirect()->route('index');
    }

    /**
     * Log out the user from ExtrasMe
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
      Auth::logout();
      return redirect()->route('index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
