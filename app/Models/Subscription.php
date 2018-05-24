<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $table = 'subscriptions';
    
    protected $fillable = [
        'id',
        'user_id',
        'layout_id',
        'expiring_at',
        'allowed_quantity',
        'allow_videos',
        'redeemed_quantity'
    ];
    
    protected $dates = ['expiring_at'];

    public function layout()
    {
        return $this->belongsTo(Layout::class);
    } 
}
