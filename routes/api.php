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
Route::put('/units/{unit}', ['as' => 'units.update', 'uses' => 'UnitController@update']);
Route::put('/units/{unit}/publish', ['as' => 'units.update', 'uses' => 'UnitController@publish']);

Route::put('/units/{unit}/approve', ['as' => 'units.approve', 'uses' => 'UnitController@approve']);
Route::put('/users/{user}/approve', ['as' => 'users.approve', 'uses' => 'UserController@approve']);

Route::post('/templates', ['as' => 'templates.store', 'uses' => 'TemplateController@store']);

Route::get('/user', function (Request $request) {
    return $request->user();
});

use App\Models\Unit;

Route::get('/units', function(){

    $units = Unit::notDeleted()->with(['template', 'template.components'])
    		->where('type', 'ad')
    		->get()->toJson();

    return response($units, 200);

})->middleware('auth:api');

Route::get('/units/{unit}', function(Unit $unit){

    $units = Unit::notDeleted()->with(['template', 'template.components'])
    		->where([
    			'type'=> 'ad',
    			'id' => $unit->id
    			])
    		->first()->toJson();

    return response($units, 200);

})->middleware('auth:api');