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
    return redirect(app()->getLocale());
});

Route::delete('image/{id}/destroy', 'App\Http\Controllers\ImageController@destroy')->name('image.destroy');
Route::delete('file/{id}/destroy', 'App\Http\Controllers\FileController@destroy')->name('file.destroy');

Route::group(['prefix' => '{locale}', 'where' => ['locale' => '[a-zA-Z]{2}'], 'middleware' => 'setlocale'], function() {

    /* Home Page */
    Route::get('/', 'App\Http\Controllers\HomeController@index')->name('home');

    // Login Routes...
    Route::get('/login', 'App\Http\Controllers\Auth\LoginController@showLoginForm')->name('login');
    Route::post('/login', 'App\Http\Controllers\Auth\LoginController@login')->name('login.action');
    Route::post('/logout', 'App\Http\Controllers\Auth\LoginController@logout')->name('logout');

    // Registration Routes...
    Route::get('/register', 'App\Http\Controllers\Auth\RegisterController@showRegistrationForm')->name('register');
    Route::post('/register', 'App\Http\Controllers\Auth\RegisterController@register')->name('register.action');

    // Password Reset Routes...
    Route::get('/password/reset', 'App\Http\Controllers\Auth\ForgotPasswordController@showLinkRequestForm');
    Route::post('/password/email', 'App\Http\Controllers\Auth\ForgotPasswordController@sendResetLinkEmail');
    Route::get('/password/reset/{token}', 'App\Http\Controllers\Auth\ResetPasswordController@showResetForm');
    Route::post('/password/reset', 'App\Http\Controllers\Auth\ResetPasswordController@reset');

    Route::group(['middleware' => 'auth'], function() {
        /* Route Notes */
        Route::get('/notes', 'App\Http\Controllers\NoteController@index')->name('notes.index');
        Route::get('/notes/{id}/show', 'App\Http\Controllers\NoteController@show')->name('notes.show');
        Route::get('/notes/create', 'App\Http\Controllers\NoteController@create')->name('notes.create');
        Route::post('/notes/store', 'App\Http\Controllers\NoteController@store')->name('notes.store');
        Route::get('/notes/{id}/edit', 'App\Http\Controllers\NoteController@edit')->name('notes.edit');
        Route::put('/notes/{id}/update', 'App\Http\Controllers\NoteController@update')->name('notes.update');
        Route::delete('/notes/{id}/destroy', 'App\Http\Controllers\NoteController@destroy')->name('notes.destroy');

        /* Route Tasks */
        Route::get('/tasks', 'App\Http\Controllers\TaskController@index')->name('tasks.index');
        Route::get('/tasks/completed', 'App\Http\Controllers\TaskController@completed')->name('tasks.completed');
        Route::get('/tasks/create', 'App\Http\Controllers\TaskController@create')->name('tasks.create');
        Route::post('/tasks/store', 'App\Http\Controllers\TaskController@store')->name('tasks.store');
        Route::get('/tasks/{id}/completed', 'App\Http\Controllers\TaskController@getCompleted')->name('tasks.getCompleted');
        Route::delete('/tasks/completed/{id}/destroy', 'App\Http\Controllers\TaskController@destroyCompleted')->name('tasks.destroyCompleted');
        Route::delete('/tasks/{id}/destroy', 'App\Http\Controllers\TaskController@destroy')->name('tasks.destroy');
    });
});
