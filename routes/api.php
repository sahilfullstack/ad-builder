<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::delete('/personal-access-tokens/{personal_access_token}', ['as' => 'personal-access-tokens.revoke', 'uses' => 'AccessController@revokePersonalAccessToken']);
Route::post('/personal-access-tokens', ['as' => 'personal-access-token.create', 'uses' => 'AccessController@createPersonalAccessToken']);

Route::post('/upload', ['as' => 'upload', 'uses' => 'UploadController@upload']);

/**
 * Units
 */
Route::post('/units', ['as' => 'units.store', 'uses' => 'UnitController@store']);
Route::post('/units/{unit}/copy', ['as' => 'units.store', 'uses' => 'UnitController@storeCopy']);
Route::put('/units/{unit}', ['as' => 'units.update', 'uses' => 'UnitController@update']);
Route::delete('/units/{unit}', ['as' => 'units.update', 'uses' => 'UnitController@delete']);
Route::put('/units/{unit}/publish', ['as' => 'units.update', 'uses' => 'UnitController@publish']);

Route::put('/units/{unit}/approve', ['as' => 'units.approve', 'uses' => 'UnitController@approve']);
Route::put('/users/{user}/approve', ['as' => 'users.approve', 'uses' => 'UserController@approve']);
// Route::put('/users/{user}/subscriptions/{subscription}', ['as' => 'users.subscription.update', 'uses' => 'SubscriptionController@update']);
Route::put('/users/{user}/subscriptions', ['as' => 'users.subscription.create', 'uses' => 'SubscriptionController@create']);
Route::post('/users/create', ['as' => 'users.create', 'uses' => 'UserController@create']);

Route::post('/templates', ['as' => 'templates.store', 'uses' => 'TemplateController@store']);
Route::put('/users/password', ['as' => 'users.password.update', 'uses' => 'UserController@updatePassword']);
Route::delete('/users/{user}', ['as' => 'users.delete', 'uses' => 'UserController@delete']);

Route::get('/user', function (Request $request) {
    return $request->user();
});
Route::put('/users/{user}/profile', ['as' => 'users.profile.update', 'uses' => 'UserController@updateProfile']);

Route::get('/units', ['as' => 'api.unit.list', 'uses' => 'UnitController@list'])->middleware('valid_api_headers');
Route::get('/units/{unit}',  ['as' => 'api.unit.list', 'uses' => 'UnitController@show'])->middleware('valid_api_headers');

Route::post('/views', ['as' => 'api.view.store', 'uses' => 'ViewController@store'])->middleware('valid_api_headers');
Route::post('/reports/pin', ['as' => 'reports.pin', 'uses' => 'ReportController@pin']);
Route::delete('/reports/pin/{pinnedReport}', ['as' => 'reports.unpin', 'uses' => 'ReportController@unpin']);
