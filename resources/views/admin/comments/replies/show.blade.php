@extends ('layouts.admin')


@section('content')


@if(count($replies)>0)
<h1>Replies</h1>
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

    @foreach($replies as $reply)
    <tr>
        <td>{{$reply->id}}</td>

        <td>{{$reply->author}}</td>
        <td>{{$reply->body}}</td>
        <td>{{$reply->email}}</td>
        <td><a href="{{$reply->comment == null || $reply->comment->post == null ? route('comments.index') : route('home.post', $reply->comment->post->slug)}}">View Post</a></td>
        <td>
            @if($reply->is_active == 1)

            {!! Form::open(['method'=>'PATCH', 'action'=>['CommentRepliesController@update', $reply->id]]) !!}

            <input type="hidden" name="is_active" value="0">

            <div class="form-group">
                {!! Form::submit('Unapprove', ['class'=>'btn btn-success']) !!}
            </div>

            {!! Form::close() !!}

            @else
            {!! Form::open(['method'=>'PATCH', 'action'=>['CommentRepliesController@update', $reply->id]]) !!}

            <input type="hidden" name="is_active" value="1">

            <div class="form-group">
                {!! Form::submit('Approve', ['class'=>'btn btn-info']) !!}
            </div>

            {!! Form::close() !!}

            @endif
        </td>

        <td>
            {!! Form::open(['method'=>'DELETE', 'action'=>['CommentRepliesController@destroy', $reply->id]]) !!}

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
<h1 class="text-center">No replies</h1>
@endif
@stop
