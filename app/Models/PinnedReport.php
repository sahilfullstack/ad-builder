<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\ContainsSoftDeletableUniques;
use Illuminate\Database\Eloquent\SoftDeletes;

class PinnedReport extends Model
{
    use ContainsSoftDeletableUniques, SoftDeletes;
    
    const SOFT_DELETION_TOKEN = 'deleted_at_millis';
    
    protected $table = 'pinned_reports';

    protected $fillable = [
        'id',
        'user_id',
        'report',
        'filter'
    ];
    
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'filter' => 'array',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
}
