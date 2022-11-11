<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>edit comment page</title>
</head>
<body>
<a href="{{ route('posts.index') }}">index page</a>
{{--<h1>asdasdsad</h1>--}}
<form action="{{route('comments.update',$comment->id)}}" method="post">
    @csrf
    @method('PUT')
    <div>
        <br>
        <textarea name="content" id="" cols="30" rows="10">{{$comment->content}}</textarea>
        <br>
        <button type="submit">Save</button>
    </div>

</form>
</body>
</html>
