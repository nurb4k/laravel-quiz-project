@extends('layouts.layout')
@section('title','Post page' )
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 ">
                @can('create',\App\Models\Quiz::class)
                    <a class="btn btn-success mb-3 mt-3"
                       href="{{ route('quizzes.create') }}">{{__('messages.createQuiz')}}</a>
                @endcan
                <?php
                $items = Array('pink_bg', 'blue_bg', 'orange_bg', 'parpel_bg', 'green_bg');
                ?>
                <div class="container-fluid">
                    <div class="col-lg-5">
                        <div style="display:flex;flex-wrap: wrap">
                            @foreach($quizzes as $quiz)
                                <div class="card_box box_shadow position-relative mb_30 white_bg"
                                     style="margin-left: 12px; width: 400px">

                                    <div class="white_box_tittle  <?php echo $items[array_rand($items)]; ?>  ">
                                        <div class="main-title2 ">
                                            <p>{{$quiz->category->name}}</p>

                                            <h5 class="mb-2 nowrap text_white">{{$quiz->name}}</h5>
                                            <img src="{{asset($quiz->img)}}" width="300px">


                                            @if( \Illuminate\Support\Facades\Auth::check() && $quiz->user->id == Auth::user()->id)
                                                <h4 style="color: white">YOUR QUIZ</h4>

                                            @else
                                                deadline:
                                                <p class="mb-2 nowrap text_white">{{$quiz->deadline}}</p>

                                            @endif

                                        </div>
                                    </div>
                                    <div class="box_body">
                                        @auth()
                                            @can('view',$quiz)
                                                <a href="{{route('quizzes.show',$quiz->id)}}"
                                                   class="btn btn-primary">{{__('messages.open')}}</a>
                                            @endcan
                                        @endauth

                                    </div>
                                </div>

                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection




