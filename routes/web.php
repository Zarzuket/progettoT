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


// ROTTE PUBBLICHE
Route::get('/', function () {
    return view('welcome');
});
Route::get('/','PageController@index');
Route::get('/blog','PostController@index');
Route::get('/blog{slug}','PostController@show')->name('posts.show');


// ROTTE AUTENTICAZIONE
Auth::routes();

// ROTTE AREA ADMIN
Route::middleware('auth')->namespace('Admin')->name('admin.')->prefix('admin')->group(
    function(){

        Route::get('/', 'HomeController@index')->name('home');
        Route::resource('posts','PostController');
    }
);
