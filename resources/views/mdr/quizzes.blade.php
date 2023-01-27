@extends('layouts.layout')

@section('title','Moderator panel')

@section('content')

    <div class="container">
        <h6>{{__('messages.createQuiz')}}:</h6>
        <a class="btn btn-success mb-3 mt-3"
           href="{{ route('quizzes.create') }}">{{__('messages.createQuiz')}}</a>
    </div>
    <h2 class="text-warning">{{__('messages.deadlineExp')}}</h2>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Creator</th>
            <th scope="col">Image</th>
            <th scope="col">Category</th>
            <th scope="col">Deadline</th>
            <th scope="col">Deadline update</th>
            <th scope="col">See</th>

        </tr>
        </thead>
        <tbody>

        @for($i=0;$i<count($quizzes);$i++)
            <tr>
                <th scope="row">{{$i+1}}</th>

                <td>{{$quizzes[$i]->name}}</td>
                <td>{{$quizzes[$i]->user->name}}</td>
                <td><img src="{{asset($quizzes[$i]->img)}}" width="150px" alt=""></td>
                <td>
                    {{$quizzes[$i]->category->name}}
                </td>
                <td style="color: red">
                    {{__('messages.deadlineExp')}}
                </td>
                <td>
                    <form action="{{route('mdr.quiz.update',$quizzes[$i])}}" method="post">
                        @csrf
                        <input type="datetime-local" name="deadline" value="{{$quizzes[$i]->deadline}}"
                               class="form-control @error('deadline') is-invalid @enderror "
                               placeholder="dd-mm-yyyy">
                        <button type="submit" class="btn btn-primary">{{__('messages.update')}}</button>
                    </form>
                </td>
                <td>
                    <a href="{{route('mdr.quizzes.details',$quizzes[$i]->id)}}" class="btn btn-success">{{__('messages.whoPart')}}</a>
                </td>

            </tr>
        @endfor
        </tbody>
    </table>
    <hr>
    <h2 class="headline">{{__('messages.deadlineOK')}}</h2>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Creator</th>
            <th scope="col">Image</th>
            <th scope="col">Category</th>

            <th scope="col">Deadline update</th>
            <th scope="col">See</th>
            <th scope="col">Edit</th>

        </tr>
        </thead>
        <tbody>

        @for($i=0;$i<count($quizzesOk);$i++)
            <tr>
                <th scope="row">{{ $i+1}}</th>
                <td>{{$quizzesOk[$i]->name}}</td>
                <td>{{$quizzesOk[$i]->user->name}}</td>
                <td><img src="{{asset($quizzesOk[$i]->img)}}" width="150px" alt=""></td>
                <td>
                    {{$quizzesOk[$i]->category->name}}
                </td>

                <td>
                    <form action="{{route('mdr.quiz.update',$quizzesOk[$i])}}" method="post">
                        @csrf
                        <input type="datetime-local" name="deadline"
                               class="form-control @error('deadline') is-invalid @enderror "
                               placeholder="dd-mm-yyyy" value="{{$quizzesOk[$i]->deadline}}">
                        <button type="submit" class="btn btn-primary">{{__('messages.update')}}</button>
                    </form>
                </td>
                <td>
                    <a href="{{route('mdr.quizzes.details',$quizzesOk[$i]->id)}}" class="btn btn-success">{{__('messages.whoPart')}}</a>
                </td>
                <td><a href="{{route('mdr.quiz.index',$quizzesOk[$i]->id)}}" class="btn-sm btn-primary"> {{__('messages.edit')}} </a></td>

            </tr>
        @endfor
        </tbody>
    </table>
@endsection
