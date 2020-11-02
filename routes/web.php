<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::group(['middleware' => 'auth'], function() {
    Route::get('/home', 'App\Http\Controllers\TaskController@index')->name('tasks.index');

    Route::post('/home', 'App\Http\Controllers\TaskController@create')->name('tasks.create');

    Route::get('/tasks/{task_id}/edit', 'App\Http\Controllers\TaskController@showEditForm')->name('tasks.edit');
    Route::get('/tasks/{task_id}/destroy', 'App\Http\Controllers\TaskController@destroy')->name('destroy');
    Route::post('/tasks/{task_id}/edit', 'App\Http\Controllers\TaskController@edit');

});

Auth::routes();
