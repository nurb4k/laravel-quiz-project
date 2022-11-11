<?php

namespace App\Policies;

use App\Models\Quiz;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class QuizPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        //
    }


    public function view(User $user, Quiz $quiz)
    {
        return ($user->id != $quiz->user_id) || ($user->role = !"user");
    }

    public function create(User $user)
    {
        return ($user->role == "moderator");
    }

    public function update(User $user, Quiz $quiz)
    {
        //
    }

    public function delete(User $user, Quiz $quiz)
    {
        return ($user->id == $quiz->user_id) || ($user->role = !"user");
    }

    public function restore(User $user, Quiz $quiz)
    {
        //
    }

    public function forceDelete(User $user, Quiz $quiz)
    {
        //
    }
}
