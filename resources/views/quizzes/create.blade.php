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



    <form action="{{ route('quizzes.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="text" class="form-control " name="name_quiz"
               placeholder="Name quiz">
        <br>

        <select name="category_id" class="form-select form-select-sm">
            <option selected>Open this select menu</option>
            categories
            @if($categories!=null)
                @foreach($categories as $cate)
                    <option value="{{$cate->id}}">{{ $cate->{'name_'.app()->getLocale()} }}</option>
                @endforeach
            @endif
        </select>
        <br>
        <div id="content">

        </div>
        <input type="button" class="btn btn-success" value="add new question" style="margin-bottom: 15px;"
               onclick="addRow()">

        <div>
            <button class="btn btn-success my-3f" style="margin-top: 15px;" type="submit">Publish</button>
        </div>

    </form>

    <script>
        function addRow() {
            const div = document.createElement('div');
            div.className = 'row';
            div.innerHTML = `
           <hr>
                <input type="text" class="form-control " name="text_question[]"
                       placeholder="Enter question">
                <input type="file" class="form-control @error('img') is-invalid @enderror " name="img" >
                <input type="datetime-local"  name="deadline" class="form-control @error('deadline') is-invalid @enderror "
                    placeholder="dd-mm-yyyy"
                   >
                <hr>
                    <div class="d-flex">
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text bg-success" id="basic-addon1">A</span>
                          </div>
                          <input type="text"  class="w-25 form-control @error('text_answer') is-invalid @enderror" placeholder="answer"   name="text_answer[]" aria-describedby="basic-addon1">

                        </div>

                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text bg-warning" id="basic-addon1">B</span>
                          </div>
                          <input type="text" class="w-25 form-control @error('text_answer') is-invalid @enderror"  placeholder="answer"   name="text_answer[]" aria-describedby="basic-addon1">
                        </div>
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text bg-danger" id="basic-addon1">C</span>
                          </div>
                          <input type="text" class="w-25 form-control @error('text_answer') is-invalid @enderror " placeholder="answer"   name="text_answer[]" aria-describedby="basic-addon1">
                        </div>
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text bg-primary" id="basic-addon1">D</span>
                          </div>
                          <input type="text" class="w-25 form-control @error('text_answer') is-invalid @enderror " placeholder="answer"   name="text_answer[]" aria-describedby="basic-addon1">
                        </div>
                    <br><br>
                </div>
                    <p>Correct answer</p>
                    <select id="ddlViewBy" class="w-25 form-control" name="isTrue[]">
                        <option name="isTrue[A]" selected value="1">A</option>
                        <option name="isTrue[B]"   value="2">B</option>
                        <option  name="isTrue[C]" value="3">C</option>
                        <option  name="isTrue[D]" value="4">D</option>
                    </select>
            `;
            document.getElementById('content').appendChild(div);
        }

        function removeRow(input) {
            document.getElementById('content').removeChild(input.parentNode);
        }
    </script>
    <style>


    </style>

@endsection
