@extends('layouts.app')

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
    <form action="{{ route('posts.store') }}" method="post">
        @csrf


        <div class="form-group">
            <label class="titleInput" for="inputTitle">Enter title</label>
            <input type="text" class="form-control @error('title')is-invalid @enderror " id="inputTitle" name="title" placeholder="Enter title">

            @error('title')
            <div class="alert alert-danger xm">{{$message}}</div>
            @enderror

        </div>

        <div class="form-group">
            <label class="titleInput" for="CategoryInput">Enter category</label>
            <select class="form-control @error('category_id')is-invalid @enderror" name="category_id"
                    id="exampleFormControlSelect1">
                @foreach($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach

            </select>
            @error('category_id')
            <div class="alert alert-danger xm">{{$message}}</div>
            @enderror
        </div>
        <div class="form-group">
            <label class="contentInput" for="contentInput">Enter content</label>
            <textarea type="text" class="form-control @error('content')is-invalid @enderror" id="contentInput" name="content" cols="25" rows="10"
                      placeholder="Enter title"> </textarea>
            @error('content')
            <div class="alert alert-danger xm">{{$message}}</div>
            @enderror
        </div>
        <div>
            <button class="btn btn-outline-success my-3f" type="submit">Publish</button>
        </div>

    </form>

@endsection
