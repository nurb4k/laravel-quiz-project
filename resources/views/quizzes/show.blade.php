@extends('layouts.layout')
@section('title','create post' )
@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="container mt-5">
        <div class="d-flex justify-content-center row">
            <div class="col-md-10 col-lg-10">
                <div class="border">
                    <h3 class="text-center">How well do you know {{$quiz->quiz_score}}</h3>
                    <div class="question bg-white p-3 border-bottom">
                        <div class="d-flex flex-row justify-content-between align-items-center mcq">
                            <h4 class="text-center">  {{$quiz->quiz_score}}'s quiz</h4>
                            (3 questions)
                        </div>
                    </div>
                    <form action="{{route('quizzes.checkAnswers',$quiz->id)}}" method="POST">
                        @csrf
                        @foreach($questions as $question)
                            <div class="question bg-white p-3 border-bottom">
                                <div class="d-flex flex-row align-items-center question-title">
                                    <h3 class="text-danger">Q.</h3>
                                    <h5 class="mt-1 ml-2"> {{$question->text_question}}</h5>
                                </div>
                                @foreach($question->answers as $answer)
                                    <div class="ans ml-2 ">
                                        <input type="hidden" name="questionId[{{$question->id}}]" value="{{$question->id}}">
                                        <label
                                            @if($showAnswers === true && $answer->isTrue === true) style="color:green;font-weight: bold;"
                                            @endif class="radio"> <input type="checkbox"
                                                                         style="accent-color: green;width: 25px"
                                                                         name="answerId[{{$answer->id}}]"
                                                                         value="{{$answer->id}}"> <span
                                            >{{$answer->text_answer}}</span>
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                        <button class="btn btn-primary">Submit</button>
{{--                        <div class="d-flex flex-row justify-content-between align-items-center p-3 bg-white">--}}

{{--                            <a href="{{route('quizzes.answers',$quiz)}}"--}}
{{--                               class="btn btn-primary border-success align-items-center btn-success" type="submit">Show--}}
{{--                                correct answers<i--}}
{{--                                    class="fa fa-angle-right ml-2"></i></a>--}}

{{--                        </div>--}}
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
