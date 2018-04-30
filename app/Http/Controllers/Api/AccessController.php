<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Laravel\Passport\Token as PersonalAccessToken;

use App\Http\Requests\PersonalAccessToken\{CreatePersonalAccessTokenRequest, RevokePersonalAccessTokenRequest};

class AccessController extends Controller
{
    public function createPersonalAccessToken(CreatePersonalAccessTokenRequest $request)
    {
    	return app('Laravel\Passport\Http\Controllers\PersonalAccessTokenController')->store($request);
    }

    public function revokePersonalAccessToken(RevokePersonalAccessTokenRequest $request, PersonalAccessToken $personalAccessToken)
    {
    	return app('Laravel\Passport\Http\Controllers\PersonalAccessTokenController')->destroy($request, $personalAccessToken->id);
    }
}