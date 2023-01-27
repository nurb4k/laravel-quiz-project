<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Category;
use App\Models\Competition;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Symfony\Component\Console\Input\Input;

class QuizController extends BaseController
{

    public function index()
    {
        $allQuizzes = Quiz::all();
        $allQuestion = Question::all();
        return view('quizzes.index', ['quizzes' => $allQuizzes, 'questions' => $allQuestion]);
    }

    public function create(User $user)
    {
        $this->authorize('create', Quiz::class);
        $categories = Category::all();
        return view('quizzes.create', ['categories' => $categories]);
    }

    public function store(Request $request)
    {
        $this->service->store($request);
        return redirect()->back()->with('status', (__('messages.created')));
    }

    public function show(Quiz $quiz)
    {
        $this->authorize('view', $quiz);
        $Questions = Question::all()->where('quiz_id', $quiz->id);
        $myScore = 0;
        $usercomptdQuiz = Auth::user()->competitedQuizzies()->where('quiz_id', $quiz->id)->first();
        $usersComptdQuiz = $quiz->competitedUsers()->where('quiz_id', $quiz->id)->orderByDesc('point')->get();
        if ($usercomptdQuiz != null)
            $myScore = $usercomptdQuiz->pivot->point;
        return view('quizzes.show', ['quiz' => $quiz, 'questions' => $Questions, 'myScore' => $myScore, 'comptdUsers' => $usersComptdQuiz]);
    }

    public function compQuiz(Request $request, Quiz $quiz)
    {
        $this->authorize('competite', $quiz);
        $result = $this->service->competitionOnQuiz($quiz,$request);
        return redirect()->back()->with('status', $result);
    }

    public function destroy(Quiz $quiz)
    {
        $this->authorize('delete', $quiz);
        $this->service->destroy($quiz);
        redirect()->route('quizzes.index');
    }

    public function deCompQuiz(Quiz $quiz)
    {
        if (Auth::check()) {
            $comptQuiz = Auth::user()->competitedQuizzies()->where('quiz_id', $quiz->id)->first();
            if ($comptQuiz != null) {
                Auth::user()->competitedQuizzies()->detach($quiz->id);
            }
        }

        return redirect()->back()->with('status', 'Result ' . (__('messages.deleted')));
    }
}
