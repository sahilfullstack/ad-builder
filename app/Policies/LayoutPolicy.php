<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class LayoutPolicy
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
     * Determine whether the user can create the layout.
     *
     * @param  \App\User  $user
     * @param  \App\Template  $layout
     * @return mixed
     */
    public function create(User $user, Unit $layout)
    {
        return $user->can('layout.manage');        
    }    
}
