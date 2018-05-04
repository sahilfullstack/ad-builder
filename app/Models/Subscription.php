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
        'expiring_at'
    ];
    
    public function layout()
    {
        return $this->belongsTo(Layout::class);
    } 
}
