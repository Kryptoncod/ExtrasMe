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
<<<<<<< HEAD
   $app->get('extra/{id}/apply',  function($username, $id){
      return App\Http\Controllers\ExtraController::extra_apply($id);
   });
   $app->get('extra/{id}',  ['as' => 'extra',   "uses" => "ExtraController@extra"]);
   $app->get('extras',  ['as' => 'extra_list',   "uses" => "ExtraController@showExtraList"]);
   $app->get ('myextras', ['as' => 'my_extras', "uses" => "ExtraController@myExtras"]);
   $app->get ('myFavoriteExtras', ['as' => 'my_favorite_extras', "uses" => "ExtraController@myFavoriteExtras"]);
   $app->get ('myFavoriteExtrasSearch', ['as' => 'my_favorite_extras_search', "uses" => "ExtraController@myFavoriteExtrasSearch"]);
   $app->get ('myFavoriteExtras/{id}', function($username, $id){
      return App\Http\Controllers\ExtraController::myFavoriteExtrasAdd($id);
   });
   $app->get ('myFavoriteExtras/{id}/delete', function($username, $id){
      return App\Http\Controllers\ExtraController::myFavoriteExtrasDelete($id);
=======

   Route::group(['prefix' => 'extra'], function($app) {
      $app->get('{id}/apply', ['as' => 'extra_apply', 'uses' => 'ExtraController@apply']);
      $app->get('list/{type_extra}',  ['as' => 'extra_list',   "uses" => "ExtraController@showList"]);
      $app->post('search', ['as' => 'extra_search', "uses" => "ExtraController@search"]);
      $app->post('submit', ['as' => 'extra_submit', "uses" => "ExtraController@submit"]);
      $app->get ('myextras', ['as' => 'my_extras', "uses" => "ExtraController@myExtras"]);
      Route::group(['prefix' => 'favorite'], function($app) {
         $app->get ('/', ['as' => 'my_favorite_extras', "uses" => "ExtraController@showFavorite"]);
         $app->get ('search', ['as' => 'my_favorite_extras_search', "uses" => "ExtraController@showFavoriteSearch"]);
         $app->get ('{id}', function($username, $id){
            return App\Http\Controllers\ExtraController::favoriteAdd($id);
         });
         $app->get ('{id}/delete', function($username, $id){
            return App\Http\Controllers\ExtraController::favoriteDelete($id);
         });
      });
>>>>>>> 0e301c667ffe94e0e44726fbd700cf3054241a49
   });

   $app->get('dashboard', ['as' => 'dashboard', "uses" => "DashboardController@show"]);

   $app->get('calendar', ['as' => 'calendar', "uses" => "CalendarController@showCalendar"]);
   $app->get('experiences', ['as' => 'experiences', "uses" => "ProfileController@showExperiences"]);
<<<<<<< HEAD
   $app->get('applicationDownload', ['as' => 'applicationDownload', "uses" => "ProfileController@showApplicationDownload"]);
   $app->get('dashboard', ['as' => 'dashboard', "uses" => "ProfileController@showDashboard"]);
   $app->post('extra', ['as' => 'extra_submit', "uses" => "ExtraController@extraSubmit"]);
   $app->post('search', ['as' => 'extra_search', "uses" => "ExtraController@extraSearch"]);
=======
   $app->get('applicationDownload', ['as' => 'applicationDownload', "uses" => "ProfileController@showApplicationDownload"]); 
>>>>>>> 0e301c667ffe94e0e44726fbd700cf3054241a49
   $app->post('registerPost', ['as' => 'register_update', "uses" => "AccountController@registerUpdate"]);
   $app->get('modifFiles', ['as' => 'modif_files', "uses" => "AccountController@filesReset"]);
   $app->post('cvPost', ['as' => 'cv_update', "uses" => "AccountController@cvUpdate"]);
   $app->post('profilePost', ['as' => 'profile_update', "uses" => "AccountController@profileUpdate"]);
   $app->post('descriptionPost', ['as' => 'description_update', "uses" => "AccountController@descriptionUpdate"]);
   $app->get('{ExtraID}/accept/{studentID}', function($extraID, $studentID){
      return App\Http\Controllers\ExtraController::acceptExtra($extraID, $studentID);
   });
});

Route::group(['prefix' => 'signup'], function($app) {
   $app->get('/', ["uses" => "IndexController@redirect"]);

   $app->get('professional',  ['as' => 'signup_professional',   "uses" => "SignupController@showProfessional"]);
   $app->post('professional', ['as' => 'register_professional', "uses" => "SignupController@registerProfessional"]);

   $app->get('student',  ['as' => 'signup_student',   "uses" => "SignupController@showStudent"]);
   $app->post('student', ['as' => 'register_student', "uses" => "SignupController@registerStudent"]);

});

Route::get('about', ['as' => 'about', "uses" => "DocumentsController@about"]);

//Requêtes AJAX
Route::get('ajax/getCardContent', ['as' => 'getCard','uses' => 'AjaxController@loadCard']);
