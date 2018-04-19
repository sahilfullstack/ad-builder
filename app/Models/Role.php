<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Traits\ContainsSoftDeletableUniques;
use App\Models\Traits\Loggable;
use App\Models\Interfaces\LoggableSubject;
use App\User;

class Role extends Model implements LoggableSubject
{
    use SoftDeletes, ContainsSoftDeletableUniques, Loggable;

    const SOFT_DELETION_TOKEN = 'deleted_at_millis';
    
    protected $fillable = [
        'name', 'slug', 'priority'
    ];

    protected $equals = [
        'admin', 'editor'
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
    protected $casts = [
        'priority' => 'integer'
    ];

    public function scopeNotDeleted($query) 
    {
        return $query->whereNull('deleted_at')->where(self::SOFT_DELETION_TOKEN, 0);
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'role_permission')
            ->withTimestamps()->wherePivot(self::SOFT_DELETION_TOKEN, 0);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public static function findBySlug(String $slug)
    {
        return static::notDeleted()->where('slug', $slug)->first();
    }

    public function canOverride(Role $role)
    {
        // Admin/Editors can override everyone on same or lower priority;
        if($this->among($this->equals())) return $this->priority >= $role->priority;

        // For everyone else, only the higher priority can override the lower.
        return $this->priority > $role->priority;
    }

    public function among(Array $roles)
    {
        return in_array($this->slug, $roles);
    }

    public function equals()
    {
        return $this->equals;
    }    

    public function getLoggableSubject()
    {
        return [
            'id'    => $this->id,
            'title' => $this->name,
            'link'  => route('roles.view', $this->id)
        ];  
    }
}
