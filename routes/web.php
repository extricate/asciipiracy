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
Route::get('/user/{user}/ships/active', 'UserController@active')->name('active_ship');

Route::get('/ships', 'ShipsController@index')->name('ships');
Route::get('/ships/{ship}', 'ShipsController@show');
Route::get('/ships/{ship}/upgrade', 'ShipsUpgradeController@show')->middleware('auth');
Route::put('/ships/{ship}/update', 'ShipsController@update');
Route::get('/ships/create/new', 'ShipsController@create')->name('ship_create')->middleware('auth');
Route::get('/ships/create/beginner', 'ShipsController@createBeginner')->name('ship_create_beginner')->middleware('auth');
Route::put('/ship/set-active/{ship}', 'ShipsController@setActiveShip')->name('set_active_ship');
Route::delete('/ships/{ship}', 'ShipsController@destroy')->name('ship_destroy');

Route::get('/people', 'PeopleController@index')->name('people');
Route::get('/people/{person}', 'PeopleController@show');

Route::get('/explore', 'ExplorationController@index')->name('explore');
Route::get('/explore/now', 'ExplorationController@goExplore')->name('explore_now');

Route::get('/combat', 'CombatController@index')->name('view_combat');
Route::get('/combat/start', 'CombatController@startCombat')->name('start_combat');

