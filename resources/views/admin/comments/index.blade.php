@extends ('layouts.admin')


@section('content')


@if(count($comments)>0)
<h1>Comments</h1>
<table class="table table-hover">
    <thead>
    <tr>
        <th>Id</th>
        <th>Author</th>
        <th>Body</th>
        <th>Email</th>
    </tr>
    </thead>
    <tbody>
    @foreach($comments as $comment)

    <tr>
        <td>{{$comment->id}}</td>

        <td>{{$comment->author}}</td>
        <td>{{$comment->body}}</td>
        <td>{{$comment->email}}</td>
        <td><a href="{{route('home.post', $comment->post->id)}}">View Post</a></td>

    </tr>

    @endforeach
    </tbody>
</table>

@else
<h1 class="text-center">No comments</h1>
@endif
@stop
