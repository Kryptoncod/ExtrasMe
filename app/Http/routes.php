<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', ['as' => 'index', "uses" => "IndexController@index"]);
Route::get('login', ['as' => 'login_form', "uses" => "AuthController@showLoginForm"]);
Route::post('login', ['as' => 'authenticate', "uses" => "AuthController@login"]);
Route::get('logout', ['as' => 'logout', "uses" => "AuthController@logout"]);

//Route::get('home', ['as' => 'home', "uses" => "ProfileController@show"]);

//Route::get('extra/{id}', ['as' => 'extra', "uses" => "ProfileController@extra"]);
//Route::get('extra/{id}/apply', ['as' => 'extra_apply', "uses" => "ProfileController@extra_apply"]);
//Route::post('extra', ['as' => 'extra_submit', "uses" => "ProfileController@extraSubmit"]);
//Route::get('extras', ['as' => 'extra_list', "uses" => "ProfileController@showExtraList"]);
//Route::post('search', ['as' => 'extra_search', "uses" => "ProfileController@extraSearch"]);

Route::group(['prefix' => 'home'], function($app) {
   $app->get('/', ['as' => 'home', "uses" => "ProfileController@show"]);

   $app->get('extra/{id}/apply',  ['as' => 'extra_apply',   "uses" => "ProfileController@extra_apply"]);
   $app->get('extra/{id}',  ['as' => 'extra',   "uses" => "ProfileController@extra"]);
   $app->post('extra', ['as' => 'extra_submit', "uses" => "ProfileController@extraSubmit"]);
   $app->post('search', ['as' => 'extra_search', "uses" => "ProfileController@extraSearch"]);

});

Route::group(['prefix' => 'signup'], function($app) {
   $app->get('/', ["uses" => "IndexController@redirect"]);

   $app->get('professional',  ['as' => 'signup_professional',   "uses" => "SignupController@showProfessional"]);
   $app->post('professional', ['as' => 'register_professional', "uses" => "SignupController@registerProfessional"]);

   $app->get('student',  ['as' => 'signup_student',   "uses" => "SignupController@showStudent"]);
   $app->post('student', ['as' => 'register_student', "uses" => "SignupController@registerStudent"]);

});

Route::get('about', ['as' => 'about', "uses" => "DocumentsController@about"]);
