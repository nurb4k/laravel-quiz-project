@extends('layouts.layout')

@section('title','Admin panel')

@section('content')
    <h1>users</h1>
    <form action="{{route('adm.users.search')}}" method="GET">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">@</span>
            </div>
            <input name="search" type="text" class="form-control" placeholder="Search" aria-label="Username"
                   aria-describedby="basic-addon1">
            <button type="submit" class="btn btn-success">SEARCH</button>
        </div>
    </form>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Role</th>
            <th scope="col">is active</th>

        </tr>
        </thead>
        <tbody>
        @for($i=0;$i<count($users);$i++)
            <tr>
                <th scope="row">{{$i+1}}</th>
                <td>{{$users[$i]->name}}</td>
                <td>{{$users[$i]->email}}</td>
                <td>
                    <form action="{{route('adm.users.edit',$users[$i]->id)}}">
                        <select name="role_id">
                            @foreach($roles as $role)
                                <option
                                    @if( $users[$i]->role->id == $role->id ) selected
                                    @endif value="{{$role->id}}">{{$role->name}}</option>
                            @endforeach
                        </select>
                        <button class="btn btn-success">SAVE</button>
                    </form>
                </td>
                <td>

                        @if($users[$i]->id != \Illuminate\Support\Facades\Auth::user()->id)
                            <form action="
                            @if($users[$i]->is_active)
                                {{route('adm.users.ban',$users[$i]->id)}}
                            @else
                                {{route('adm.users.unban',$users[$i]->id)}}
                            @endif
                            " method="post">
                                @csrf
                                @method('PUT')
                                <button class="btn btn-danger" type="submit">

                                    @if($users[$i]->is_active )
                                        BAN
                                    @else
                                        UNBAN
                                    @endif
                                </button>
                            </form>
                        @endif

                </td>

            </tr>
        @endfor
        </tbody>
    </table>
@endsection

