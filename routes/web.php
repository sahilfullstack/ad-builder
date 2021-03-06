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

use Doctrine\DBAL\Driver\PDOMySql\Driver;

Route::get('/', function () {	
	return redirect('/dashboard');
});

Auth::routes();

Route::get('/post-registration', function () {
    return view('auth.post-registration');
})->name('post-registration');

Route::get('/dashboard', 'DashboardController@dashboard')->name('dashboard')->middleware('auth');

Route::get('/templates', 'TemplateController@list')->name('templates.list');
Route::get('/templates/create', 'TemplateController@create')->name('templates.create');
Route::get('/templates/{template}/render', 'TemplateController@render')->name('templates.render');
Route::get('/users/create', 'UserController@create')->name('users.create');
Route::get('/templates/{template}', 'TemplateController@show')->name('templates.show');

Route::get('/units', 'UnitController@list')->name('units.list')->middleware('auth');
Route::get('/units/create', 'UnitController@create')->name('units.create')->middleware('auth');

Route::get('/units/{unit}/edit', 'UnitController@edit')->name('units.edit')->middleware('auth');
Route::get('/units/{unit}/render', 'UnitController@render')->name('units.render');
Route::get('/units/{unit}/edit/page', 'UnitController@editLandingPage')->name('units.edit-landing-page')->middleware('auth');
Route::get('/units/approval', 'UnitController@listUnitsForApproval')->name('units.approval.list')->middleware('auth');
Route::get('/users', 'UserController@list')->name('users.list')->middleware('auth');
Route::get('/users/change_password', 'UserController@changePassword')->name('users.change_password')->middleware('auth');
Route::get('/users/help', 'UserController@help')->name('users.help')->middleware('auth');
Route::get('/users/{user}', 'UserController@show')->name('users.show')->middleware('auth');
Route::post('/units/{unit}/components/{component}/responses', 'UnitController@recordResponse')->name('units.respond');

Route::get('/units/{unit}', 'UnitController@show')->name('units.show')->middleware('auth');

Route::get('/statistics/{type}', 'StatisticsController@show')->name('stats.show')->middleware('auth');

Route::get('practice/units', ['uses' => 'Api\UnitController@list']);
Route::get('practice/slides', ['uses' => 'PracticeController@slides']);

Route::get('/practice/templates/embed', 'PracticeController@embed');
Route::get('/practice/templates/1', 'PracticeController@template1');
Route::get('/practice/templates/{template}', 'PracticeController@renderTemplate');

Route::get('me/access-tokens', [
	'uses'       => 'DashboardController@accessToken',
	'as'         => 'users.access-tokens',
	'middleware' => 'can:create,Laravel\Passport\Token'
]);

Route::get('me/subscriptions', [
	'uses' => 'UserController@getSubscriptions',
	'as'   => 'users.subscriptions'
]);

Route::get('me/profile', [
	'uses' => 'UserController@getProfile',
	'as'   => 'users.profile'
]);

Route::get('/users/{user}/subscriptions', 'UserController@manageSubscription')->name('users.manage.subscriptions')->middleware('auth');
