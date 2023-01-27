<?php

namespace App\Services\Quiz;

use App\Models\Answer;
use App\Models\Question;
use App\Models\Quiz;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Auth\Access\Response;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


class Service
{
    public function store($request)
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
    }

    public function destroy($quiz)
    {
        $Questions = Question::all()->where('quiz_id', $quiz->id);
        foreach ($Questions as $question) {
            $Answers = Answer::all()->where('question_id', $question->id);
            foreach ($Answers as $answer) {
                $answer->delete();
            }
            $question->delete();
        }
        $quiz->delete();
    }

    public function competitionOnQuiz($quiz, $request)
    {
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
        return $result;
    }


}
