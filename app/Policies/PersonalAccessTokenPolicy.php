<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

use Laravel\Passport\Token as PersonalAccessToken;
use App\User;

class PersonalAccessTokenPolicy
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
     * Determine whether a user can create.
     *
     * @param  User   $user
     * @return boolean
     */
    public function create(User $user)
    {
        return $user->can('personal-access-token.manage');
    }

    /**
     * Determine whether a user can revoke.
     *
     * @param  User   $user
     * @param  PersonalAccessToken $personalAccessToken
     * @return boolean
     */
    public function revoke(User $user, PersonalAccessToken $personalAccessToken)
    {
        if(! $user->can('personal-access-token.manage')) return false;

        return (in_array($personalAccessToken->id, $user->tokens()->pluck('id')->toArray()) || $user->canOverride($personalAccessToken->user));
    }
}
