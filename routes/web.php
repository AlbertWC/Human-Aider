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
    if(Auth::guard('web')->check())
    {
        return redirect('posts');
    }
    else
    {
        return view('auth.login');
    }

});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::put('/home', 'HomeController@solvedcase');

Route::resource('posts', 'PostController');
Route::post('posts/{post}', 'PostController@addcomment');

Route::get('sawvictim', 'SawController@sawvictim');
Route::post('sawvictim', 'SawController@storeresult');

Route::delete('posts/{post}', 'PostController@deletecomment');
Route::get('/analytics', 'GraphController@index');


