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

class QuizController extends Controller
{

    public function index()
    {
        $allQuizzes = Quiz::all();
        $allQuestion = Question::all();
        return view('quizzes.index', ['quizzes' => $allQuizzes, 'questions' => $allQuestion]);
    }


    public function create(User $user)
    {
//        $this->authorize('create');
        $categories = Category::all();
        return view('quizzes.create', ['categories' => $categories]);
    }


    public function store(Request $request)
    {

        $text_questions = $request->input('text_question');
        $text_answers = $request->input('text_answer');
        $name_quiz = $request->input('name_quiz');
        $category_id = $request->input('category_id');
        $trueIds = $request->input('isTrue');
        $deadline = $request->input('deadline');
        $deadline = str_replace('T', ' ', $deadline);

        $validated = $request->validate([
            'text_question' => 'required|max:255',
            'text_answer' => 'required|max:255',
            'name_quiz' => 'required|max:255',
            'deadline' => 'required',
            'category_id' => 'required|exists:categories,id',
            'img' => 'mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,max_width=2000,max_height=2000'
        ]);

        $fileName = time() . $request->file('img')->getClientOriginalName();
        $image_path = $request->file('img')->storeAs('quizzes', $fileName, 'public');
        $validated['img'] = '/storage/' . $image_path;

        if ($text_questions != null && $text_answers != null && $trueIds != null) {
            $count = 4;
            for ($i = 1; $i < count($trueIds); $i++) {
                if (count($trueIds) == 1) {
                    return $trueIds;
                } else {
                    $trueIds[$i] = $trueIds[$i] + $count;
                }
                $count += 4;
            }

            $quiz = Quiz::create([
                'user_id' => Auth::user()->id,
                'name' => $validated['name_quiz'],
                'category_id' => $validated['category_id'],
                'img' => $validated['img'],
                'deadline' => $deadline
            ]);

            $sum = 0;
            for ($i = 0; $i < count($text_questions); $i++) {
                $que = Question::create([
                    'text_question' => $text_questions[$i],
                    'quiz_id' => $quiz->id,
                ]);

                for ($j = $sum; $j < $sum + 4; $j++) {

                    if ($trueIds[$i] - 1 == $j) {
                        Answer::create([
                            'text_answer' => $text_answers[$j],
                            'question_id' => $que->id,
                            'isTrue' => true,
                        ]);
                    } else {
                        Answer::create([
                            'text_answer' => $text_answers[$j],
                            'question_id' => $que->id,
                            'isTrue' => false,
                        ]);
                    }
                }
                $sum += 4;
            }
        }
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
        $this->authorize('competite',$quiz);
        $Questions = Question::all()->where('quiz_id', $quiz->id);
        $answerIds = $request->input('answerId');
        $score = 0;

        foreach ($Questions as $question) {
            $answers = $question->answers;
            foreach ($answers as $answer) {
                if ($answer->isTrue) {
                    foreach ($answerIds as $id) {
                        if ($id == $answer->id) {
                            $score++;
                        }
                    }
                }
            }

        }
        $comptQuiz = Auth::user()->competitedQuizzies()->where('quiz_id', $quiz->id)->first();
        if ($comptQuiz != null) {
            Auth::user()->competitedQuizzies()->updateExistingPivot($quiz->id, ['point' => $score]);
        } else {
            Auth::user()->competitedQuizzies()->attach($quiz->id, ['user_name' => Auth::user()->name, 'point' => $score]);
        }

        $res = (__('messages.score'));
        $result = $res . $score . '/' . count($Questions) . "!";
        return redirect()->back()->with('status', $result);
    }

    public function deleteQuiz(Quiz $quiz)
    {

        $this->authorize('delete', $quiz);
        $Questions = Question::all()->where('quiz_id', $quiz->id);
        foreach ($Questions as $question) {
            $Answers = Answer::all()->where('question_id', $question->id);
            foreach ($Answers as $answer) {
                $answer->delete();
            }
            $question->delete();
        }
        $quiz->delete();

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

        return redirect()->back()->with('status', 'Result '.(__('messages.deleted')));
    }

}
