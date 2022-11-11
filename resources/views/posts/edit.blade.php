<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>edit post page</title>
</head>
<body>
<a href="{{ route('posts.index') }}">index page</a>
<form action="{{route('posts.update',$post->id)}}" method="post">
    @csrf
    @method('PUT')
    <div>
        <input type="text" value="{{$post->title}}" name="title">
        <select name="category_id">
            @foreach($categories as $category)
                <option
                    @if( $category->id == $post->category_id ) selected
                    @endif value="{{$category->id}}">{{$category->name}}</option>
            @endforeach
        </select>
        <br>
        <textarea name="content" id="" cols="30" rows="10">{{$post->content}}</textarea>
        <br>

        <button type="submit">OK</button>
    </div>

</form>
</body>
</html>
