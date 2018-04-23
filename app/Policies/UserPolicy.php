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
     * Determine whether the user can approve unit.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function approve(User $user)
    {
        return $user->can('user.manage');
    }
}
