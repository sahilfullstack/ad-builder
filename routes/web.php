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

Route::get('/dashboard', 'DashboardController@dashboard')->name('dashboard');

Route::get('/templates', 'TemplateController@list')->name('templates.list');
Route::get('/templates/create', 'TemplateController@create')->name('templates.create');
Route::get('/templates/{template}', 'TemplateController@show')->name('templates.show');

Route::get('/units', 'UnitController@list')->name('units.list');
Route::get('/units/create', 'UnitController@create')->name('units.create');
Route::get('/units/{unit}/edit', 'UnitController@edit')->name('units.edit');
Route::get('/units/{unit}/render', 'UnitController@render')->name('units.render');
Route::get('/units/{unit}/edit/page', 'UnitController@editLandingPage')->name('units.edit-landing-page');
Route::get('/units/approval', 'UnitController@listUnitsForApproval')->name('units.approval.list');
Route::get('/users', 'UserController@list')->name('users.list');
Route::get('/units/{unit}', 'UnitController@show')->name('units.show');

Route::get('/practice/templates/1', 'PracticeController@template1');
Route::get('/practice/templates/embed', 'PracticeController@embed');