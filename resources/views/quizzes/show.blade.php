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
                @auth()
                    <div class="border">
                        @if($myScore != null)
                            <div class="alert alert-warning" role="alert">
                                <h5>You have already passed this Quiz, your previous score "{{$myScore}}"</h5>
                            </div>
                            <form action="{{route('compt.quiz.delete',$quiz->id)}}" method="post">
                                @csrf

                                <button type="submit" class="btn-danger">Reset my score</button>
                            </form>
                        @endif
                        <h3 class="text-center">{{$quiz->quiz_score}}</h3>
                        <div class="question bg-white p-3 border-bottom">
                            <div class="d-flex flex-row justify-content-between align-items-center mcq">
                                <h4 class="text-center">  {{$quiz->quiz_score}}'s quiz</h4>
                                (3 questions)
                            </div>
                        </div>

                        <div>

                            <form action="{{route('compt.quiz',$quiz->id)}}" method="POST">
                                @csrf
                                @foreach($questions as $question)
                                    <div class="question bg-white p-3 border-bottom">
                                        <div class="d-flex flex-row align-items-center question-title">
                                            <h3 class="text-danger">Q.</h3>
                                            <h5 class="mt-1 ml-2"> {{$question->text_question}}</h5>
                                        </div>
                                        @foreach($question->answers as $answer)
                                            <div class="ans ml-2 ">
                                                <input type="hidden" name="questionId[{{$question->id}}]"
                                                       value="{{$question->id}}">
                                                <label class="radio"> <input type="checkbox"
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
                            </form>
                            <hr>
                            <h3>Competition table of "{{$quiz->quiz_score}}" is quiz</h3>
                            <div style="width: 300px;height: 300px">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">№</th>
                                        <th scope="col">Name</th>

                                        <th scope="col">Point</th>
                                    </tr>
                                    </thead>
                                    <tbody>


                                    @if($comptdUsers!=null)
                                        @for($i=0;$i<count($comptdUsers);$i++)
                                            <tr @if(\Illuminate\Support\Facades\Auth::user()->id == $comptdUsers[$i]->pivot->user_id)style="background-color: rgba(0,128,0,0.29);" @endif>
                                                <th scope="row">{{$i+1}}</th>
                                                <td scope="row" >{{$comptdUsers[$i]->pivot->user_name}}</td>
                                                <td scope="row">{{$comptdUsers[$i]->pivot->point}}</td>
                                            </tr>
                                        @endfor

                                    @endif




                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endauth
            </div>
        </div>
    </div>

@endsection
