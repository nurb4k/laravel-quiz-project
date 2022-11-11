@extends('layouts.layout')
@section('title','Post page' )
@section('content')
    @for($i=0;$i<count($comps);$i++)
        <div style="display:flex;">
            <h1>{{$i+1}}</h1>
            <h2>{{$comps[$i]->name}}</h2>
        </div>
        <h2>{{$comps[$i]->point}}/3</h2>
    @endfor
@endsection
