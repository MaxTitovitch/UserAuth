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

// Route::get('/', function () {
//     return view('welcome');
// })->name("welcome");

Route::get('/', 'WelcomeController@index')->name('welcome');
Route::post('/', 'WelcomeController@append')->name('welcomepost');

// Auth::routes();
Auth::routes(['verify' => true]);

Route::get('/blocked', 'HomeController@blocked')->name('blockpage');
Route::get('/home', 'HomeController@index')->name('home')->middleware(['verified', "blocked"]);
Route::post('/home', 'HomeController@block')->name('block')->middleware(['verified']);