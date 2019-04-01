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

Route::get('/', 'TaskController@index')->name('home');

Route::post('task/create', array('uses'=>'TaskController@create'));
Route::post('task/complete/{task_id}/', array('uses'=>'TaskController@complete'));
Route::post('task/delete/{task_id}/', array('uses'=>'TaskController@delete'));


Auth::routes();