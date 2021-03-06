<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use App\Models\{Role, Subscription};
use App\Models\Unit;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Traits\ContainsSoftDeletableUniques;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens, SoftDeletes, ContainsSoftDeletableUniques;

    const SOFT_DELETION_TOKEN = 'deleted_at_millis';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role_id', 'approved_at', 'rejected_at', 'active', 'company', 'username', 'phone', 'temp_password', 'address', 'city', 'state', 'pin'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function hasRole($roles)
    {
        if(is_string($roles)) $roles = [$roles];

        return in_array($this->role->slug, $roles);
    }

    public function hasPermission($permission)
    {
        return $this->role->permissions->contains('slug', $permission);
    }

    public function canOverride(User $user)
    {
        return $this->role->canOverride($user->role);
    }

    public function units($type = null)
    {
        $query = $this->hasMany(Unit::class)->notDeleted()->latest();

        if(is_null($type)) return $query;

        return $query->where('type', $type);
    } 

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }
}
