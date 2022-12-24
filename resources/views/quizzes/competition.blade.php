@extends('layouts.layout')
@section('title','Participated users' )
@section('content')
    <div style="width: 600px;height: 600px">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">№</th>
                <th scope="col">Name</th>

                <th scope="col">Point</th>
                <th scope="col">delete</th>

            </tr>
            </thead>
            <tbody>


            @if($comptdUsers!=null)
                @for($i=0;$i<count($comptdUsers);$i++)
                    <tr @if(\Illuminate\Support\Facades\Auth::user()->id == $comptdUsers[$i]->pivot->user_id)style="background-color: rgba(0,128,0,0.29);" @endif>
                        <th scope="row">{{$i+1}}</th>
                        <td scope="row">{{$comptdUsers[$i]->pivot->user_name}}</td>
                        <td scope="row">{{$comptdUsers[$i]->pivot->point}}</td>
                        <td scope="row">


                            <form action="{{route('mdr.quizzes.reset.score')}}" method="post">
                                @csrf
                                <input type="hidden" value="{{$comptdUsers[$i]->id}}" name="user_id">
                                <input type="hidden" value="{{$quiz->id}}" name="quiz_id">
                                <button type="submit" class="btn btn-danger">{{__('messages.reset')}}</button>
                            </form>

                        </td>

                    </tr>
                @endfor

            @endif


            </tbody>
        </table>
    </div>

@endsection
