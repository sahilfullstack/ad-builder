<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PersonalAccessToken extends Model
{
    protected $table = 'oauth_access_tokens';
    
    protected $fillable = [
    	'id',
        'user_id',
        'client_id',
        'name',
        'scopes'
    ];
}
