<?php

namespace App\Http\Controllers\Adm;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('view', Auth::user());
        $users = null;
        $roles = Role::all();
        if ($request->search) {
            $users = User::where('name', 'LIKE', '%' . $request->search . '%')
                ->orWhere('email', 'LIKE', '%' . $request->search . '%')
                ->with('role')->get();
        } else {
            $users = User::with('role')->get();
        }
        return view('adm.users', ['users' => $users], ['roles' => $roles]);
    }

    public function ban(User $user)
    {
        $this->authorize('ban', Auth::user());
        $user->update([
            'is_active' => false,
        ]);
        return back();
    }

    public function unban(User $user)
    {
        $this->authorize('unban', Auth::user());
        $user->update([
            'is_active' => true,
        ]);

        return back();
    }

    public function edit(Request $request, User $user)
    {

        $this->authorize('update', Auth::user());
        $validated = $request->validate([
            'role_id' => 'required|numeric'
        ]);
        $user->update($validated);
        return back();
    }

    public function quizzes()
    {

        $quizzesExp = Quiz::query()->where('deadline', '<=', Carbon::now()->addHours(6))->get();
        $quizzesOk = Quiz::query()->where('deadline', '>=', Carbon::now()->addHours(6))->get();

        return view('mdr.quizzes', ['quizzes' => $quizzesExp, 'quizzesOk' => $quizzesOk]);
    }

    public function details(Quiz $quiz)
    {

        $currentQuiz = Quiz::all()->where('id', $quiz->id);
        $usersComptdQuiz = $quiz->competitedUsers()->where('quiz_id', $quiz->id)->orderByDesc('point')->get();

        return view('quizzes.competition', ['comptdUsers' => $usersComptdQuiz, 'quiz' => $quiz]);
    }

    public function userDetail(User $user)
    {
        $usercomptdQuiz = $user->competitedQuizzies()->get();

        $count = array();
        if ($usercomptdQuiz != null) {
            for ($i = 0; $i < count($usercomptdQuiz); $i++) {
                $count[$i] = Question::all()->where('quiz_id', $usercomptdQuiz[$i]->id)->count();
            }
        }
        return view('adm.userDetails', ['user' => $user, 'awards' => $usercomptdQuiz, 'count' => $count]);
    }

    public function reset(Request $request)
    {

        $validated = $request->validate([
            'user_id' => 'required|numeric|exists:users,id',
            'quiz_id' => 'required|numeric|exists:quizzes,id',
        ]);
        $user = User::all()->where('id', $validated['user_id'])->first();
        $comptQuiz = $user->competitedQuizzies()->where('quiz_id', $validated['quiz_id'])->first();

        if ($comptQuiz != null) {
            $user->competitedQuizzies()->detach($validated['quiz_id']);
        }


        return redirect()->back()->with('status', __('messages.deleted'));

    }

    public function update(Request $req, Quiz $quiz)
    {
        $this->authorize('update',$quiz);
        $validated = $req->validate([
            'deadline' => 'required'
        ]);
        $deadline = $req->input('deadline');
        $deadline = str_replace('T', ' ', $deadline);
        $quiz->update([
            'deadline' => $deadline
        ]);

        return redirect()->back()->with('status', __('messages.updated'));
    }

    public function quiz(Quiz $quiz)
    {
        $Questions = Question::all()->where('quiz_id', $quiz->id);
        return view('mdr.quiz', ['quiz' => $quiz, 'questions' => $Questions]);
    }

    public function delete(Quiz $quiz)
    {

        $this->authorize('delete',$quiz);
        $quiz->competitedUsers()->detach();

        $Questions = Question::all()->where('quiz_id', $quiz->id);
        foreach ($Questions as $question) {
            $Answers = Answer::all()->where('question_id', $question->id);
            foreach ($Answers as $answer) {
                $answer->delete();
            }
            $question->delete();
        }
        $quiz->delete();

        return  redirect('/mdr/quizzes')->with('status', __('messages.deleted'));;
    }
}
