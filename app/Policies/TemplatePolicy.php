<?php

namespace App\Policies;

use App\User;
use App\Template;
use Illuminate\Auth\Access\HandlesAuthorization;

class TemplatePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the template.
     *
     * @param  \App\User  $user
     * @param  \App\Template  $template
     * @return mixed
     */
    public function view(User $user, Template $template)
    {
        return $user->can('template.manage');
    }

    /**
     * Determine whether the user can create templates.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->can('template.manage');
    }

    /**
     * Determine whether the user can update the template.
     *
     * @param  \App\User  $user
     * @param  \App\Template  $template
     * @return mixed
     */
    public function update(User $user, Template $template)
    {
        return $user->can('template.manage');
    }

    /**
     * Determine whether the user can delete the template.
     *
     * @param  \App\User  $user
     * @param  \App\Template  $template
     * @return mixed
     */
    public function delete(User $user, Template $template)
    {
        return $user->can('template.manage');
    }
}
