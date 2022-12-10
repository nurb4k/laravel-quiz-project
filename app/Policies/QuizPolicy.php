<?php

namespace App\Policies;

use App\Models\Quiz;
use App\Models\User;
use Carbon\Carbon;
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
    }

    public function update(User $user, Quiz $quiz)
    {

    }

    public function competite(User $user, Quiz $quiz)
    {
        $nowTime = Carbon::now()->addHours(6);
        $quizDeadline = $quiz->deadline;
        return $nowTime->lte($quizDeadline);

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
