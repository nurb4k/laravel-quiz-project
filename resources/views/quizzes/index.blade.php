@extends('layouts.layout')
@section('title','Post page' )
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 ">
                {{--                @can('create',\Illuminate\Support\Facades\Auth::user())--}}
                <a class="btn btn-success mb-3 mt-3" href="{{ route('quizzes.create') }}">Create
                    new quiz</a>
                {{--                @endcan--}}
                <?php
                $items = Array('pink_bg', 'blue_bg', 'orange_bg', 'parpel_bg', 'green_bg');
                ?>
                <div class="container-fluid">
                    <div class="col-lg-5">
                        @foreach($quizzes as $quiz)
                            <div class="card_box box_shadow position-relative mb_30 white_bg">

                                <div class="white_box_tittle  <?php echo $items[array_rand($items)]; ?>  ">
                                    <div class="main-title2 ">
                                        @guest
                                            <h5 class="mb-2 nowrap text_white">{{$quiz->name}}</h5>
                                            <img src="{{asset($quiz->img)}}" width="300px" >
                                        @else
                                            @if($quiz->user->id == Auth::user()->id)
                                                <h4 style="color: white">YOUR QUIZ</h4>
                                            @else
                                                <h5 class="mb-2 nowrap text_white">{{$quiz->name}}</h5><br>
                                                deadline:
                                                <p class="mb-2 nowrap text_white">{{$quiz->deadline}}</p>

                                            @endif
                                        @endguest
                                    </div>
                                </div>
                                <div class="box_body">
                                    @guest
                                        {{--                                        <a href="{{route('quizzes.show',$quiz->id)}}" class="btn btn-primary">OPEN</a>--}}
                                    @else
                                        @if(Auth::user()->role->name == "admin")
                                            <form method="post" action="{{route('quizzes.delete',$quiz->id)}}">
                                                @csrf
                                                {{--                                                @method('DELETE')--}}
                                                <button type="submit" class="btn btn-danger">DELETE</button>
                                            </form>

                                        @endif
                                        @if($quiz->user->id == Auth::user()->id)

                                        @else
                                            <a href="{{route('quizzes.show',$quiz->id)}}"
                                               class="btn btn-primary">OPEN</a>
                                        @endif
                                    @endguest

                                </div>
                            </div>

                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection




