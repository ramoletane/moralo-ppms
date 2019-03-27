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
Route::get('/organisation', 'OrganisationController@frontend')->name('organisation');
Route::get('/organisation/organisational-units', 'OrganisationalUnitController@frontend')->name('organisational-units');
Route::get('/organisation/employees', 'EmployeeController@frontend')->name('employees');
Route::get('/industries', 'IndustryController@frontend')->name('industries');
Route::get('/industries/sectors', 'SectorController@frontend')->name('sectors');
Route::get('/impacts', 'ImpactController@frontend')->name('impacts');
Route::get('/outcomes', 'OutcomeController@frontend')->name('outcomes');
Route::get('/outcomes/{impactId}', 'OutcomeController@frontend')->name('outcomes');
Route::get('/outputs', 'OutputController@frontend')->name('outputs');
Route::get('/outputs/{outcomeId}', 'OutputController@frontend')->name('outputs');
