<?php

namespace App\Policies;

use App\User;
use App\Models\Unit;
use Illuminate\Auth\Access\HandlesAuthorization;

class UnitPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine whether the user can list unit.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function list(User $user)
    {
        return $user->can('unit.approve');
    }


    /**
     * Determine whether the user can publish the unit.
     *
     * @param  \App\User  $user
     * @param  \App\Template  $unit
     * @return mixed
     */
    public function publish(User $user, Unit $unit)
    {
        return($user->id === $unit->user_id);
    }    

    /**
     * Determine whether the user can update the unit.
     *
     * @param  \App\User  $user
     * @param  \App\Template  $unit
     * @return mixed
     */
    public function update(User $user, Unit $unit)
    {
        return($user->id === $unit->user_id);
    }

    /**
     * Determine whether the user can approve unit.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function approve(User $user)
    {
        return $user->can('unit.approve');
    }
}
