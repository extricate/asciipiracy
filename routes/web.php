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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/users', 'UserController@index')->name('users');
Route::get('/users/{user}', 'UserController@show');

Route::get('/ships', 'ShipsController@index')->name('ships');
Route::get('/ships/{ship}', 'ShipsController@show');
Route::get('/ships/{ship}/upgrade', 'ShipsUpgradeController@show')->middleware('auth');

Route::get('/people', 'PeopleController@index')->name('people');
Route::get('/people/{person}', 'PeopleController@show');


