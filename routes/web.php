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
 
Route::get('/task', 'Companies\TaskController@index');

Route::get('/task/create', 'Companies\TaskController@create');
Route::post('/task/create', 'Companies\TaskController@store');

Route::get('/partner', 'Companies\PartnerController@index');
Route::get('/partner/{id}', 'Companies\PartnerController@show');