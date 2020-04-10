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
        Route::get('/{gym_id}/opening_hour_setting', 'Owners\Registration\GymOpeningHoursController@create')->name('owner.opening_hour_setting.crete');
        Route::post('/opening_hour_setting', 'Owners\Registration\GymOpeningHoursController@store')->name('owner.opening_hour_setting.store');

        // dashboard
        Route::get('/dashboard', 'Owners\DashboardController@index')->name('owner.dashboard.index');

        // GYM 詳細ページ
        Route::get('/gym/{gym_id}', 'Owners\GymController@show')->name('owner.gym.show');

        // Gym 予約
        Route::get('reservation/{gym_id}/create', 'Owners\ReservationController@create')->name('owner.reservation.create');
        Route::post('reservation/{gym_reservation_id}/store', 'Owners\ReservationController@store')->name('owner.reservation.store');
        // Route::get('/reservation/create', function(){
        //   return 'test';
        // })->name('owner.reservation.create');


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
        // reservation
        Route::get('/reservation/index', 'Users\ReservationController@index')->name('user.reservation.index');
        Route::post('/reservation/create', 'Users\ReservationController@create')->name('user.reservation.create');
        Route::post('/reservation/{gym_reservation_id}/store', 'Users\ReservationController@store')->name('user.reservation.store');

        // logout
        Route::post('logout', 'Companies\Auth\LoginController@logout')->name('user.logout');
    });
});

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
