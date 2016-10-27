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
Route::get('language/{local}', ['as' => 'language', "uses" => "IndexController@language"]);
Route::get('login', ['as' => 'login_form', "uses" => "AuthController@showLoginForm"]);
Route::post('login', ['as' => 'authenticate', "uses" => "AuthController@login"]);
Route::get('logout', ['as' => 'logout', "uses" => "AuthController@logout"]);
Route::post('password/email', ['as' => 'email', "uses" => "PasswordController@sendResetLinkEmail"]);
Route::post('password/reset', ['as' => 'reset', "uses" => "PasswordController@reset"]);
Route::get('password/reset/{token?}', ['as' => 'password_reset', "uses" => "PasswordController@showResetForm"]);
Route::get('account/confirm/{confirmation_code}', ['as' => 'confirmation_account', "uses" => "AuthController@confirmAccount"]);

Route::get('about', ['as' => 'about', "uses" => "DocumentsController@about"]);
Route::get('/missionStatement', ['as' => 'missionStatement', "uses" => "IndexController@missionStatement"]);
Route::get('/contactUs', ['as' => 'contactUs', "uses" => "IndexController@contactUs"]);
Route::get('/ourTeam', ['as' => 'ourTeam', "uses" => "IndexController@ourTeam"]);
Route::get('/amabassador', ['as' => 'ambassador', "uses" => "IndexController@ambassador"]);
Route::get('/legal', ['as' => 'legal', "uses" => "IndexController@legal"]);
Route::get('/charter', ['as' => 'charter', "uses" => "IndexController@charter"]);
Route::get('/charter/verification', ['as' => 'verification_conditions', "uses" => "SignupController@verificationConditions"]);

Route::get('404', function(){
   return view('errors.404');
});

Route::get('/signUp/student', ['as' => 'signUp_student', "uses" => "SignupController@showStudent"]);
Route::get('/signUp/student/confirm', ['as' => 'confirm_email_view', "uses" => "IndexController@confirmEmailView"]);
Route::post('/signUp/student', ['as' => 'register_student', "uses" => "SignupController@registerStudent"]);
Route::post('/register', ['as' => 'register_candidate', "uses" => "SignupController@registerCandidate"]);


Route::group(['prefix' => '{username}'], function($app) {
   $app->get('/', ['as' => 'home', "uses" => "ProfileController@show"]);
   $app->get('password/reset/{token?}', ['as' => 'password_reset', "uses" => "PasswordController@showResetForm"]);
   $app->get('account', ['as' => 'account', "uses" => "AccountController@show"]);
   Route::group(['prefix' => 'mycredits'], function($app) {
      $app->get('/', ['as' => 'credits', "uses" => "CreditsController@show"]);
      $app->get('/options/{data0}/{data1}', ['as' => 'options', "uses" => "CreditsController@options"]);
      $app->get('/options/payment/cash/{data0}/{data1}', ['as' => 'optionsPaymentCash', "uses" => "CreditsController@paymentOptionsCash"]);
      $app->get('/options/payment/transfer/{data0}/{data1}', ['as' => 'optionsPaymentTransfer', "uses" => "CreditsController@paymentOptionsTransfer"]);
      $app->get('/confirm', ['as' => 'confirm', "uses" => "CreditsController@confirmation"]);
   });
   Route::group(['prefix' => 'extra'], function($app) {
      $app->get('/rate/{id}', ['as' => 'extra_rate', "uses" => "ExtraController@rateOneExtra"]);
      $app->get('{id}/apply', ['as' => 'extra_apply', 'uses' => 'ExtraController@apply']);
      $app->get('{id}/cancel', ['as' => 'extra_cancel_application', 'uses' => 'ExtraController@cancelApplication']);
      $app->get('list/{type_extra}/{date}',  ['as' => 'extra_list',   "uses" => "ExtraController@showList"]);
      $app->post('search', ['as' => 'extra_search', "uses" => "ExtraController@search"]);
      $app->post('submit', ['as' => 'extra_submit', "uses" => "ExtraController@submit"]);
      $app->get ('myextras', ['as' => 'my_extras', "uses" => "ExtraController@myExtras"]);
      
      $app->get ('deleteextra/{id}', ['as' => 'delete_extra', "uses" => "ExtraController@deleteExtra"]);
      $app->get ('{id}/modify', ['as' => 'modify_extra', "uses" => "ExtraController@showModifyExtra"]);
      $app->post ('{id}/modify', ['as' => 'modify_extra_post', "uses" => "ExtraController@modifyExtra"]);
      $app->get('{extraID}/accept/{studentID}', function($username, $extraID, $studentID){
      return App\Http\Controllers\ExtraController::acceptExtra($extraID, $studentID);
   });
      $app->get('{ExtraID}/decline/{studentID}', ['as' => 'decline_application', "uses" => "ExtraController@declineExtra"]);
      Route::group(['prefix' => 'favorite'], function($app) {
         $app->get ('/', ['as' => 'my_favorite_extras', "uses" => "ExtraController@showFavorite"]);
         $app->get ('search', ['as' => 'my_favorite_extras_search', "uses" => "ExtraController@showFavoriteSearch"]);
         $app->get ('{id}', ['as' => 'add_favorite', "uses" => "ExtraController@favoriteAdd"]);
         $app->get ('{id}/delete', ['as' => 'delete_favorite', "uses" => "ExtraController@favoriteDelete"]);
      });
      $app->get('{id}', ['as' => 'show_extra', 'uses' => 'ExtraController@show']);
   });

   $app->get('dashboard', ['as' => 'dashboard', "uses" => "DashboardController@show"]);

   $app->get('calendar', ['as' => 'calendar', "uses" => "CalendarController@showCalendar"]);
   $app->get('experience', ['as' => 'experience', "uses" => "ExperienceController@show"]);

   $app->get('applicationDownload', ['as' => 'applicationDownload', "uses" => "ProfileController@showApplicationDownload"]);

   $app->post('rate/{extraID}', ['as' => 'rate', "uses" => "ExtraController@rateStudents"]);

   $app->post('registerPost', ['as' => 'register_update', "uses" => "AccountController@registerUpdate"]);
   $app->get('modifFiles', ['as' => 'modif_files', "uses" => "AccountController@filesReset"]);
   $app->post('cvPost', ['as' => 'cv_update', "uses" => "AccountController@cvUpdate"]);
   $app->post('profilePost', ['as' => 'profile_update', "uses" => "AccountController@profileUpdate"]);
   $app->post('descriptionPost', ['as' => 'description_update', "uses" => "AccountController@descriptionUpdate"]);
});
//Requêtes AJAX
Route::get('ajax/getCardContent', ['as' => 'getCard','uses' => 'AjaxController@loadCard']);
Route::get('ajax/getListContent', ['as' => 'getList','uses' => 'AjaxController@loadList']);
Route::get('ajax/getStudentContent', ['as' => 'getStudent','uses' => 'AjaxController@loadStudent']);
Route::get('ajax/getProContent', ['as' => 'getPro','uses' => 'AjaxController@loadProfessional']);
