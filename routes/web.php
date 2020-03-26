<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
  return view('common_pages/home');
});
Route::get('/privacy', function () {
  return view('common_pages/privacy');
});
Route::get('/terms', function () {
  return view('common_pages/terms');
});
// update notification read_at using ajax
Route::post('notification/mark_as_read', 'Commons\NotificationController@markAsRead');

Route::namespace('Owners')->as('ownser.')->group(function () {
    Auth::routes(['verify' => true]);
});


Route::group(['prefix' => 'owner'], function () {
    Route::get('login', 'Owners\Auth\LoginController@index')->name('owner.login');
    Route::post('login', 'Owners\Auth\LoginController@login')->name('owner.login');
    Route::get('register', 'Owners\Auth\RegisterController@index')->name('owner.register');
    Route::post('register', 'Owners\Auth\RegisterController@register')->name('owner.register');

    // Route::group(['middleware' => ['partnerVerified:partner', 'auth:owner']], function () {
    Route::group(['middleware' => ['auth:owner']], function () {
         // Registration
        Route::get('/personal_info', 'Owners\Registration\PersonalInfoController@create')->name('owner.personalInfo.crete');
        Route::post('/personal_info', 'Owners\Registration\PersonalInfoController@store')->name('owner.personalInfo.store');
        Route::get('/gym_info', 'Owners\Registration\GymInfoController@create')->name('owner.gymInfo.crete');
        Route::post('/gym_info', 'Owners\Registration\GymInfoController@store')->name('owner.gymInfo.store');
        Route::get('/opening_hour_setting', 'Owners\Registration\GymOpeningHoursController@create')->name('owner.opening_hour_setting.crete');
        Route::post('/opening_hour_setting', 'Owners\Registration\GymOpeningHoursController@store')->name('owner.opening_hour_setting.store');
        // dashboard
        Route::get('/dashboard', 'Owners\DashboardController@index')->name('owner.dashboard.index');


    });
});






Route::namespace('Users')->as('user.')->group(function () {
    Auth::routes(['verify' => true]);
    
});

Route::group(['prefix' => 'user'], function () {
    // register
    Route::get('register', 'Users\Auth\RegisterController@index')->name('user.register');
    Route::post('register', 'Users\Auth\RegisterController@register')->name('user.register');

    // login
    Route::get('login', 'Users\Auth\LoginController@index')->name('user.login');
    Route::post('login', 'Users\Auth\LoginController@login')->name('user.login');

    // Route::group(['middleware' => ['verified:user', 'auth:user']], function () {
    Route::group(['middleware' => ['auth:user']], function () {
        // Registration
        Route::get('/personal_info', 'Users\Registration\PersonalInfoController@create')->name('user.personalInfo.crete');
        Route::post('/personal_info', 'Users\Registration\PersonalInfoController@store')->name('user.personalInfo.store');
        // dashboard
        Route::get('/dashboard', 'Users\DashboardController@index')->name('user.dashboard.index');

        // logout
        Route::post('logout', 'Companies\Auth\LoginController@logout')->name('user.logout');
    });
});

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
