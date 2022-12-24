@extends('layouts.layout')

@section('title','Moderator panel')

@section('content')

    @csrf
    <label>Quiz name:</label>
    <h3   class="form-group"   >{{$quiz->name}}</h3>
    <br>
    <label>Current image</label>
    <img style="margin: 15px;" src="{{asset($quiz->img)}}" width="150px" alt=""><br>

    @foreach($questions as $question)
        <div class="question bg-white p-3 border-bottom">
            <div class="d-flex flex-row align-items-center question-title">
                <h3 class="text-danger">Q.</h3>
                <h5 class="input-group w-50"
                     >{{$question->text_question}}</h5>
            </div>
            @foreach($question->answers as $answer)

                <div class="ans ml-2">
                    <input type="hidden" name="questionId[{{$question->id}}]"
                           value="{{$question->id}}">
                    <label class="radio"> <input type="checkbox" @if($answer->isTrue == true) checked @endif
                        style="accent-color: green;width: 25px"
                                                 name="answerId[{{$answer->id}}]"
                                                 value="{{$answer->id}}"> <span
                        >{{$answer->text_answer}}</span>
                    </label>
                </div>
            @endforeach
        </div>
    @endforeach
    <form action="{{route('mdr.quiz.delete',$quiz->id)}}" method="post">
        @csrf
        <button type="submit" class="btn btn-danger">DELETE</button>
    </form>
@endsection
