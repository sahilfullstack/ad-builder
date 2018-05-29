<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
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
     * Determine whether the user can create user.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->can('user.manage');
    }    

    /**
     * Determine whether the user can list users.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function list(User $user)
    {
        return $user->can('user.manage');
    }

    /**
     * Determine whether the user can approve user.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function approve(User $user)
    {
        return $user->can('user.manage');
    }    

    /**
     * Determine whether the user can update profile.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function update(User $user, User $userToUpdate)
    {
        return ($user->id === $userToUpdate->id || $user->canOverride($userToUpdate));
    }
}
