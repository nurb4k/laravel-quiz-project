@extends('layouts.layout')

@section('title','Admin panel')

@section('content')

    <table class="table">
        <thead>
        <tr>

            <th scope="col">Name</th>
            <th scope="col">Image</th>
            <th scope="col">Email</th>

            <th scope="col">is active</th>
            <th scope="col">Account created time</th>
            <th scope="col">Account last updated time</th>

        </tr>
        </thead>
        <tbody>
        <tr>
            <td>
                {{$user->name}}
            </td>
            <td>

                @if($user->img == 'noimg')
                    <img
                        src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460__480.png"
                        width="80px" height="80px" alt="#">
                @else
                    <img src="{{asset($user->img)}}" alt="" width="100px" height="100px">
                @endif

            </td>
            <td>{{$user->email}}</td>
            <td>
                {{$user->is_active}}
            </td>
            <td>
                {{$user->created_at}}
            </td>
            <td>
                {{$user->updated_at}}
            </td>

        </tr>

        </tbody>
    </table><br><br>
    @if(!$count)
        <h3>User not ever compitied</h3>
    @endif
    @isset($awards,$count)
        @for($i=0;$i<count($awards);$i++)

            <div class="single_progressbar">
                <h6 class="f_s_14 f_w_400">{{$awards[$i]->name}}</h6>

                <p>{{  $awards[$i]->pivot->point .'/'. $count[$i] }} </p>

                <div class="progress w-25">
                    <div class="progress-bar"  role="progressbar" style="width: {{($awards[$i]->pivot->point/$count[$i])*100}}%;"
                         aria-valuenow="{{($awards[$i]->pivot->point/$count[$i])*100}}" aria-valuemin="0"
                         aria-valuemax="100"><p>{{($awards[$i]->pivot->point/$count[$i]  )*100}}</p></div>
                </div>
                <form action="{{route('adm.quizzes.reset.score')}}" method="post">
                    @csrf
                    <input type="hidden" name="user_id" value="{{$user->id}}">
                    <input type="hidden" name="quiz_id" value="{{$awards[$i]->id}}">
                    <button class="btn-sm btn-outline-danger">{{__('messages.reset')}}</button>
                </form>

            </div>
        @endfor
    @endisset
@endsection
