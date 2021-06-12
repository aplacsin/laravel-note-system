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

Auth::routes();

Route::get('/', 'App\Http\Controllers\HomeController@index')->name('home');

Route::get('/notes', 'App\Http\Controllers\NoteController@index')->name('notes.index');
Route::get('/notes/create', 'App\Http\Controllers\NoteController@create')->name('notes.create');


Route::get('/tasks', 'App\Http\Controllers\TaskController@index')->name('tasks.index');
Route::get('/tasks/completed', 'App\Http\Controllers\TaskController@completed')->name('tasks.completed');
Route::get('/tasks/create', 'App\Http\Controllers\TaskController@create')->name('tasks.create');
Route::post('/tasks/store', 'App\Http\Controllers\TaskController@store')->name('tasks.store');
Route::delete('/tasks/{id}/destroy', 'App\Http\Controllers\TaskController@destroy')->name('tasks.destroy');
Route::get('/tasks/{id}/completed', 'App\Http\Controllers\TaskController@getCompleted')->name('tasks.getCompleted');
Route::delete('/tasks/completed/{id}/destroy', 'App\Http\Controllers\TaskController@destroyCompleted')->name('tasks.destroyCompleted');