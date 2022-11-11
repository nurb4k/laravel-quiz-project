<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class UserPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        //
    }

    public function ban(User $user)
    {
//       return ($user->role->name == "admin" && $user->id != Auth::user()->id);
        return ($user->role->name == "admin");
    }
    public function unban(User $user)
    {
        return ($user->role->name == "admin");
    }

    public function view(User $user, User $model)
    {
        //
    }




    public function edit(User $user)
    {
        return ($user->role == "admin");
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\User $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, User $model)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\User $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, User $model)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\User $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, User $model)
    {
        //
    }
}
