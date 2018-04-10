<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Traits\ContainsSoftDeletableUniques;
use App\Models\Traits\Loggable;
use App\Models\Interfaces\LoggableSubject;

class Permission extends Model implements LoggableSubject
{
    use SoftDeletes, ContainsSoftDeletableUniques, Loggable;

    const SOFT_DELETION_TOKEN = 'deleted_at_millis';
    
    protected $fillable = [
        'name', 'slug'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];

    public function scopeNotDeleted($query) 
    {
        return $query->whereNull('deleted_at')->where(self::SOFT_DELETION_TOKEN, 0);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_permission')
            ->withTimestamps()
            ->wherePivot(self::SOFT_DELETION_TOKEN, 0)->wherePivot('deleted_at', null);
    }    

    public function getLoggableSubject()
    {
        return [
            'id'    => $this->id,
            'title' => $this->name,
            'link'  => route('permissions.view', $this->id)
        ];  
    }
}
