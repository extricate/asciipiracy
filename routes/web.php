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

Route::redirect('/', 'home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::put('/current-user/stats/increase/{stat}', 'UserController@allocateStats')->name('allocate_stats');

Route::get('/users', 'UserController@index')->name('users');
Route::get('/users/{user}', 'UserController@show');
Route::get('/users/{user}/ships/active', 'UserController@active')->name('active_ship');

// ships
Route::get('/ships', 'ShipsController@index')->name('ships');
Route::get('/ships/{ship}', 'ShipsController@show');
Route::get('/ships/{ship}/upgrade', 'ShipsUpgradeController@show');
Route::put('/ships/{ship}/update', 'ShipsController@update');
Route::get('/ships/create/new', 'ShipsController@create')->name('ship_create');
Route::get('/ships/create/beginner', 'ShipsController@createBeginner')->name('ship_create_beginner');
Route::put('/ship/set-active/{ship}', 'ShipsController@setActiveShip')->name('set_active_ship');
Route::put('/ship/repair/{ship}', 'ShipsController@repairShip')->name('ship_repair');
Route::delete('/ships/{ship}', 'ShipsController@destroy')->name('ship_destroy');

// settlements
Route::get('/settlement', 'SettlementController@index')->name('visit_town');

Route::get('/settlement/general-store', 'SettlementController@general')->name('general_store');
Route::get('/settlement/carpenter', 'SettlementController@carpenter')->name('carpenter');
Route::get('/settlement/shipwright', 'SettlementController@shipwright')->name('shipwright');
Route::get('/settlement/tavern', 'SettlementController@tavern')->name('tavern');
// people
Route::get('/people', 'PeopleController@index')->name('people');
Route::get('/people/{person}', 'PeopleController@show');

// exploration
Route::get('/explore', 'ExplorationController@index')->name('explore');
Route::get('/explore/now', 'ExplorationController@goExplore')->name('explore_now');

// combat
Route::get('/combat', 'CombatController@index')->name('view_combat');
Route::get('/combat/start', 'CombatController@startCombat')->name('start_combat');
Route::get('/combat/attack', 'CombatController@attack')->name('combat_attack');
Route::get('/combat/escape', 'CombatController@escape')->name('combat_escape');
Route::get('/combat/end', 'CombatController@endCombat')->name('combat_end');

