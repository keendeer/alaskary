<?php

namespace App\Policies;

use App\Models\User;
use App\Models\item;
use Illuminate\Auth\Access\HandlesAuthorization;

class ItemPolicy
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
        return $user->hasPermission('item', 'index');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\item  $item
     * @return mixed
     */
    public function view(User $user, item $item)
    {
        return $user->hasPermission('item', 'show');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermission('item', 'create');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\item  $item
     * @return mixed
     */
    public function update(User $user, item $item)
    {
        return $user->hasPermission('item', 'edit');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\item  $item
     * @return mixed
     */
    public function delete(User $user, item $item)
    {
        return $user->hasPermission('item', 'destroy');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\item  $item
     * @return mixed
     */
    public function restore(User $user, item $item)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\item  $item
     * @return mixed
     */
    public function forceDelete(User $user, item $item)
    {
        //
    }
}
