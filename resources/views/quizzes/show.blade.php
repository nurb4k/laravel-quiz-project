@extends('layouts.layout')
@section('title','Participated users' )
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
                    @can('competite',$quiz)
                        <div class="border">
                            <?php

                            $date1 = strtotime($quiz->deadline);
                            $date2 = strtotime(\Carbon\Carbon::now());
                            $dayDiff = round(abs($date2 - $date1) / (60 * 60 * 24), 0);

                            ?>
                            <div class="container-sm" style="padding: 15px">
                                <p>info:</p>
                                <h4>{{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $quiz->deadline)->format('d-M')}}</h4>
                                <p>{{$quiz->deadline}}</p>

                                <h4>{{$dayDiff}} күн калды</h4>
                            </div>
                            @if($myScore != null)
                                <div class="alert alert-warning" role="alert">
                                    <h5>You have already passed this Quiz, your previous score "{{$myScore}}"</h5>
                                </div>
                                <form action="{{route('compt.quiz.delete',$quiz->id)}}" method="post">
                                    @csrf
                                    <button type="submit" class="btn-danger small">{{__('messages.reset')}}</button>
                                </form>
                            @endif

                            <h3 class="text-center">{{$quiz->name}}</h3>
                            {{--                        <img src="{{asset($quiz->img)}}" width="300px">--}}
                            <img src="{{asset($quiz->img)}}" style="margin-left: 150px;" width="500" height="300">
                            <div class="question bg-white p-3 border-bottom">
                                <div class="d-flex flex-row justify-content-between align-items-center mcq">
                                    <h4 class="text-center">  {{$quiz->name}}</h4>
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
                                @endcan
                                @cannot('competite',$quiz)
                                    <h1 style="color: red">Deadline is expired</h1>
                                @endcannot
                                <h3>Competition table of this quiz</h3>
                                <div style="width: 300px;height: 300px">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th scope="col">№</th>
                                            <th scope="col">Avatar</th>
                                            <th scope="col">Name</th>

                                            <th scope="col">Point</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if($comptdUsers!=null)
                                            @for($i=0;$i<count($comptdUsers);$i++)
                                                <tr @if(\Illuminate\Support\Facades\Auth::user()->id == $comptdUsers[$i]->pivot->user_id)style="background-color: rgba(0,128,0,0.29);" @endif>
                                                    <th scope="row">{{$i+1}}</th>
                                                    <td scope="row">
                                                        @if($comptdUsers[$i]->img == 'noimg')
                                                            <img
                                                                src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460__480.png"
                                                                width="34px" alt="#">
                                                        @else
                                                            <img src="{{asset($comptdUsers[$i]->img)}}" width="50px" alt="#">
                                                        @endif


                                                    </td>
                                                    <td scope="row">{{$comptdUsers[$i]->pivot->user_name}}</td>
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
