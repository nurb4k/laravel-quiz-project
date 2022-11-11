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



    <form action="{{ route('quizzes.store') }}" method="post">
        @csrf
        <input type="button" class="btn btn-success" value="create new question" style="margin-bottom: 15px;"
               onclick="addRow()">
        <div id="content">


        </div>

        <div>
            <button class="btn btn-success my-3f" style="margin-top: 15px;" type="submit">Publish</button>
        </div>

    </form>

    <script>
        function addRow() {
            const div = document.createElement('div');
            div.className = 'row';
            div.innerHTML = `
            <label class="titleInput" >Question</label>
                <input type="text" class="form-control " name="text_question[]"
                       placeholder="Enter question">
                <hr>
                <div class="d-flex">
                    <input type="text" class="w-25 form-control" placeholder="answer" name="text_answer[]">
<!--                    <input type="checkbox" checked style="width: 50px;accent-color: green"   name="isTrue">-->
                    <input type="text"  class="w-25 form-control" name="text_answer[]"
                           placeholder="answer">
<!--                    <input type="checkbox" style="width: 50px;accent-color: green" name="isTrue">-->
                    <input type="text" class="w-25 form-control "  name="text_answer[]"
                           placeholder="answer">
<!--                    <input type="checkbox" style="width: 50px;accent-color: green" name="isTrue">-->
                    <input type="text" class="w-25 form-control " name="text_answer[]"
                           placeholder="answer">
<!--                    <input type="checkbox" style="width: 50px;accent-color: green" name="isTrue">-->
                </div>
            `;
            document.getElementById('content').appendChild(div);
        }

        function removeRow(input) {
            document.getElementById('content').removeChild(input.parentNode);
        }
    </script>


@endsection
