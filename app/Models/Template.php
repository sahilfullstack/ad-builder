<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\Loggable;
use App\Models\Traits\ContainsSoftDeletableUniques;
use Illuminate\Database\Eloquent\SoftDeletes;

class Template extends Model
{
    use Loggable, ContainsSoftDeletableUniques, SoftDeletes;

    const SOFT_DELETION_TOKEN = 'deleted_at_millis';

    /**
     * The attributes that can be filled by the developer.
     *
     * @var array
     */
    protected $fillable = [
        'type', 'name', 'slug', 'user_id', 'layout_id', 'renderer'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    protected $types = [
        'ad' => 'Ad',
        'page' => 'Landing Page'
    ];


    /**
     * Limit the search to only not deleted elements.
     *
     * @param $query
     * @return void
     */
    public function scopeNotDeleted($query)
    {
        return $query->whereNull('deleted_at')->where(self::SOFT_DELETION_TOKEN, 0);
    }

    public function scopeAd($query)
    {
        return $query->notDeleted()->whereType('ad');
    }

    public function scopePage($query)
    {
        return $query->notDeleted()->whereType('page');
    }

    public function getTypeHumanAttribute()
    {
        return $this->types[$this->type];
    }

    public function components()
    {
        return $this->hasMany(Component::class)->orderBy('order');
    }

    public function units()
    {
        return $this->hasMany(Unit::class);
    }

    public function layout()
    {
        return $this->belongsTo(Layout::class);
    }
}
