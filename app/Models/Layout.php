<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\Loggable;
use App\Models\Traits\ContainsSoftDeletableUniques;
use Illuminate\Database\Eloquent\SoftDeletes;

class Layout extends Model
{
    use Loggable, ContainsSoftDeletableUniques, SoftDeletes;

    const SOFT_DELETION_TOKEN = 'deleted_at_millis';

    /**
     * The attributes that can be filled by the developer.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'slug', 'width', 'height', 'user_id'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

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

    public function templates()
    {
        return $this->hasMany(Template::class);
    }

    public function children()
    {
        return $this->hasMany(Layout::class, 'parent_id')->orderBy('id');
    }
}
