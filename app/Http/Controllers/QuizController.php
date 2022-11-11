<?php

namespace App\Http\Controllers;

use App\Models\Answer;
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

        return view('quizzes.create');
//        Quiz::create([
//            'quiz_score' => 10,
//             'user_id' => Auth::user()->id,
//        ]);

    }


    public function store(Request $request)
    {
//        $questionIds = $request->input('questionId');
//        $answerIds = $request->input('answerId');
        $text_questions = $request->input('text_question');
        $text_answers = $request->input('text_answer');
        for ($i = 0; $i < count($request->input('text_question')); $i++) {
            echo $text_questions[$i];
            echo "\n";
        }
        echo "\n";
        for ($i = 0; $i < count($request->input('text_answer')); $i++) {
            echo $text_answers[$i];
            echo "\n";
        }

//        dd($text_questions);
//        $quiz = Quiz::create([
//            'quiz_score' => Auth::user()->name,
//            'user_id' => Auth::user()->id,
//        ]);
//        $sum = 1;
//        $runs = 4;
//        for ($x = 1; $x <= 3; $x++) {
//            $que = Question::create([
//                'text_question' => $request->input('text_question' . $x),
//                'quiz_id' => $quiz->id,
//            ]);
//            for ($a = $sum; $a <= $runs; $a++) {
//                Answer::create([
//                    'text_answer' => $request->input('text_answer' . $a),
//                    'isTrue' => $request->input('isTrue' . $a) === 'on',
//                    'question_id' => $que->id,
//                ]);
//            }
//            $sum = $sum + 4;
//            $runs = $runs + 4;
//        }
//
//        return view('quizzes.create');
    }

    public function showAnswers(Quiz $quiz)
    {
        if (Auth::user()->id === $quiz->user_id) {
            return back()->with('message', 'You cant pass your quiz!');
        }
        $showAnswers = true;
        $Questions = Question::all()->where('quiz_id', $quiz->id);
        return view('quizzes.show', ['quiz' => $quiz, 'questions' => $Questions, 'showAnswers' => $showAnswers]);
    }

    public function show(Quiz $quiz)
    {
        $this->authorize('view', $quiz);
        $Questions = Question::all()->where('quiz_id', $quiz->id);
        $showAnswers = false;
        return view('quizzes.show', ['quiz' => $quiz, 'questions' => $Questions, 'showAnswers' => $showAnswers]);

    }

    public function checkAnswers(Request $request, Quiz $quiz)
    {

        $Questions = Question::all()->where('quiz_id', $quiz->id);
        $answerIds = $request->input('answerId');
        $score = 0;
        if (count($Questions) == 3 && count($answerIds) == 3) {
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
        }
        Competition::create([
            'user_id' => Auth::user()->id,
            'quiz_id' => $quiz->id,
            'name' => Auth::user()->name,
            'point' => $score,
        ]);

        $result = "Your result " . $score . "/3!";
        return redirect()->back()->withErrors($result);
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


}
