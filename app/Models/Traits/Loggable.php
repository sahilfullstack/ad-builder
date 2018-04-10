<?php

namespace App\Models\Traits;

use App\Models\ActivityLog;

trait Loggable
{
    public function logs()
    {
        return $this->morphMany(ActivityLog::class, 'subject')->latest();
    }

    public function activities()
    {
        return $this->hasMany(ActivityLog::class, 'user_id')->latest();
    }
}