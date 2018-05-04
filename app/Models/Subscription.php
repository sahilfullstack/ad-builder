<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $table = 'subscriptions';
    
    protected $fillable = [
        'id',
        'user_id',
        'allowed_layout',
        'expiring_at'
    ];
}
