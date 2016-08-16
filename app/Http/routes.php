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

Route::group(['prefix' => '{username}'], function($app) {
   $app->get('/', ['as' => 'home', "uses" => "ProfileController@show"]);
   $app->get('account', ['as' => 'account', "uses" => "AccountController@show"]);
   $app->get('extra/{id}/apply',  ['as' => 'extra_apply',   "uses" => "ProfileController@extra_apply"]);
   $app->get('extra/{id}',  ['as' => 'extra',   "uses" => "ProfileController@extra"]);
   $app->get('extras',  ['as' => 'extra_list',   "uses" => "ProfileController@showExtraList"]);
   $app->get ('myextras', ['as' => 'my_extras', "uses" => "ProfileController@myExtras"]);
   $app->get ('myFavoriteExtras', ['as' => 'my_favorite_extras', "uses" => "ProfileController@myFavoriteExtras"]);
   $app->get ('myFavoriteExtrasSearch', ['as' => 'my_favorite_extras_search', "uses" => "ProfileController@myFavoriteExtrasSearch"]);
   $app->get ('myFavoriteExtras/{id}', function($username, $id){
      return App\Http\Controllers\ProfileController::myFavoriteExtrasAdd($id);
   });
   $app->get ('myFavoriteExtras/{id}/delete', function($username, $id){
      return App\Http\Controllers\ProfileController::myFavoriteExtrasDelete($id);
   });
   $app->get('calendar', ['as' => 'calendar', "uses" => "CalendarController@showCalendar"]);
   $app->get('experiences', ['as' => 'experiences', "uses" => "ProfileController@showExperiences"]);
   $app->get('applicationDownload', ['as' => 'applicationDownload', "uses" => "ProfileController@showApplicationDownload"]);
   $app->post('extra', ['as' => 'extra_submit', "uses" => "ProfileController@extraSubmit"]);
   $app->post('search', ['as' => 'extra_search', "uses" => "ProfileController@extraSearch"]);
   $app->post('registerPost', ['as' => 'register_update', "uses" => "AccountController@registerUpdate"]);
   $app->get('modifFiles', ['as' => 'modif_files', "uses" => "AccountController@filesReset"]);
   $app->post('cvPost', ['as' => 'cv_update', "uses" => "AccountController@cvUpdate"]);
   $app->post('profilePost', ['as' => 'profile_update', "uses" => "AccountController@profileUpdate"]);
   $app->post('descriptionPost', ['as' => 'description_update', "uses" => "AccountController@descriptionUpdate"]);
});

Route::group(['prefix' => 'signup'], function($app) {
   $app->get('/', ["uses" => "IndexController@redirect"]);

   $app->get('professional',  ['as' => 'signup_professional',   "uses" => "SignupController@showProfessional"]);
   $app->post('professional', ['as' => 'register_professional', "uses" => "SignupController@registerProfessional"]);

   $app->get('student',  ['as' => 'signup_student',   "uses" => "SignupController@showStudent"]);
   $app->post('student', ['as' => 'register_student', "uses" => "SignupController@registerStudent"]);

});

Route::get('about', ['as' => 'about', "uses" => "DocumentsController@about"]);

Route::get('ajax/getCardContent', [
   'as' => 'getCard',
   'uses' => 'AjaxController@loadCard'
]);