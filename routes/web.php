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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
 
Route::get('/task', 'TaskController@index');

Route::get('/task/create', 'TaskController@create');
Route::post('/task/create', 'TaskController@store');

Route::get('/partner', 'PartnerController@index');
Route::get('/partner/{id}', 'PartnerController@show');