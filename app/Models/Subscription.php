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
        'days',
        'allow_videos',
        'allow_hover',
        'allow_popout',
        'redeemed_quantity'
    ];
    
    protected $dates = ['expiring_at'];

    protected $casts = [
        'allow_videos' => 'boolean',
        'allow_hover' => 'boolean',
        'allow_popout' => 'boolean',
    ];

    public function layout()
    {
        return $this->belongsTo(Layout::class);
    } 
}
