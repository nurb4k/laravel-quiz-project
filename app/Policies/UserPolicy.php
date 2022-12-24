<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;


    public function view(User $user, User $model)
    {
        return $user->role->name == 'admin';
    }
    public function moder(User $user){
        return $user->role->name == 'moderator';
    }


    public function update(User $user, User $model)
    {
        return $user->role->name == 'admin';
    }

    public function ban(User $user)
    {
        return $user->role->name == 'admin';
    }

    public function unban(User $user)
    {
        return $user->role->name == 'admin';
    }




}
