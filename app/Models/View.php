<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class View extends Model
{
    /**
     * The attributes that can be filled by the developer.
     *
     * @var array
     */
    protected $fillable = [
        'unit_id', 'kiosk_id', 'viewed_at', 'duration', 'category_id', 'landing_from'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [];
}
