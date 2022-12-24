@extends('layouts.layout')

@section('title','Moderator panel')

@section('content')

    <div class="container w-50 align-center justify-content-center"
         style="padding: 15px;display:flex; border: 1px solid black">
        <form action="{{route('mdr.categories.create')}}" method="post">
            <h3 class="text-center">Create new category</h3>
            @csrf
            <div class="form-group">
                <label for="exampleInputEmail1">Name category</label>
                <input type="text" class="form-control" name="name" id="exampleInputEmail1" aria-describedby="emailHelp"
                       placeholder="name">

            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Name on english</label>
                <input type="text" class="form-control" name="name_en" placeholder="name on english">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Name on kazakh</label>
                <input type="text" class="form-control" name="name_kz" placeholder="name on kazakh">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Code</label>
                <input type="text" class="form-control" name="code" placeholder="code">
            </div>
            <button type="submit" class="btn btn-primary">{{__('messages.create')}}</button>
        </form>
    </div>


    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Name enlish</th>
            <th scope="col">Name Kazakh</th>
            <th scope="col">Code</th>
            <th scope="col">update</th>
            <th scope="col">delete</th>
        </tr>
        </thead>
        <tbody>

        @for($i=0;$i<count($categories);$i++)

            <tr>
                <th scope="row">{{$i+1}}</th>
                <form action="{{route('mdr.categories.update',$categories[$i])}}" method="post">
                    @csrf
                    <td><input type="text" name="name" value=" {{$categories[$i]->name}}">
                    </td>
                    <td>
                        <input type="text" name="name_en" value=" {{$categories[$i]->name_en}}">
                    </td>
                    <td><input type="text" name="name_kz" value=" {{$categories[$i]->name_kz}}"></td>
                    <td><input type="text" name="code" value=" {{$categories[$i]->code}}"></td>
                    <td>
                        <button type="submit" class="btn btn-outline-primary">{{__('messages.update')}}</button>
                    </td>
                </form>
                <td>
                    <form action="{{route('mdr.category.delete')}}" method="post">
                        @csrf
                        <input type="hidden" name="cat_id" value="{{$categories[$i]->id}}">
                        <button type="submit" class="btn btn-danger">{{__('messages.delete')}}</button>
                    </form>
                </td>
            </tr>

        @endfor
        </tbody>
    </table>
@endsection
