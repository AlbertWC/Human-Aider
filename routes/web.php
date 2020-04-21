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

Route::prefix('admin')->group(function()
{
    Route::get('/', 'AdminController@index')->name('admin.dashboard');
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');

});

Route::get('/home', 'HomeController@index')->name('home');
Route::put('/home', 'HomeController@solvedcase');

Route::resource('posts', 'PostController');
Route::get('/search', 'PostController@search');
Route::post('posts/{post}', 'PostController@addcomment');

Route::get('sawvictim', 'SawController@sawvictim');
Route::post('sawvictim', 'SawController@storeresult');

Route::delete('posts/{post}', 'PostController@deletecomment');
Route::get('/analytics', 'GraphController@index');


