<?php

namespace App\Policies;

use App\Models\Quiz;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Auth\Access\HandlesAuthorization;

class QuizPolicy
{
    use HandlesAuthorization;

    public function competite(User $user, Quiz $quiz)
    {
        $nowTime = Carbon::now()->addHours(6);
        $quizDeadline = $quiz->deadline;
        return $nowTime->lte($quizDeadline);

    }
    public function view(User $user,Quiz $quiz){
       return $quiz->user_id != $user->id;
    }

    public function create(User $user)
    {
        return $user->role->name == 'moderator';
//            dd($user->role->name == 'moderator');
    }

    public function update(User $user, Quiz $quiz)
    {
        return $user->role->name == 'moderator';
    }


    public function delete(User $user, Quiz $quiz)
    {
        return ($user->role = "moderator");
    }


}
