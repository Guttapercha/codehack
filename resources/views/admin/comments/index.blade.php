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
        <td><a href="{{$comment->post == null ? route('comments.index') : route('home.post', $comment->post->slug) }}">View Post</a></td>
        <td><a href="{{$comment->replies == null ? route('comments.index') : route('replies.show', $comment->id)}}">View Replies</a></td>
        <td>
            @if($comment->is_active == 1)

            {!! Form::open(['method'=>'PATCH', 'action'=>['PostCommentController@update', $comment->id]]) !!}

            <input type="hidden" name="is_active" value="0">

            <div class="form-group">
                {!! Form::submit('Unapprove', ['class'=>'btn btn-success']) !!}
            </div>

            {!! Form::close() !!}

            @else
            {!! Form::open(['method'=>'PATCH', 'action'=>['PostCommentController@update', $comment->id]]) !!}

            <input type="hidden" name="is_active" value="1">

            <div class="form-group">
                {!! Form::submit('Approve', ['class'=>'btn btn-info']) !!}
            </div>

            {!! Form::close() !!}

            @endif
        </td>

        <td>
            {!! Form::open(['method'=>'DELETE', 'action'=>['PostCommentController@destroy', $comment->id]]) !!}

            <input type="hidden" name="is_active" value="1">

            <div class="form-group">
                {!! Form::submit('Delete', ['class'=>'btn btn-danger']) !!}
            </div>

            {!! Form::close() !!}
        </td>
    </tr>

    @endforeach
    </tbody>
</table>

@else
<h1 class="text-center">No comments</h1>
@endif
@stop
