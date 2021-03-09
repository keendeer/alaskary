<?php

namespace App\Policies;

use App\Models\User;
use App\Models\branch;
use Illuminate\Auth\Access\HandlesAuthorization;

class BranchPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermission('branch', 'index');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\branch  $branch
     * @return mixed
     */
    public function view(User $user, branch $branch)
    {
        return $user->hasPermission('branch', 'show');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermission('branch', 'create');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\branch  $branch
     * @return mixed
     */
    public function update(User $user, branch $branch)
    {
        return $user->hasPermission('branch', 'edit');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\branch  $branch
     * @return mixed
     */
    public function delete(User $user, branch $branch)
    {
        return $user->hasPermission('branch', 'destroy');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\branch  $branch
     * @return mixed
     */
    public function restore(User $user, branch $branch)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\branch  $branch
     * @return mixed
     */
    public function forceDelete(User $user, branch $branch)
    {
        //
    }
}
