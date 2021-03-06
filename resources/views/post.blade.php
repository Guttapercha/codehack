@extends ('layouts.blog-post')


@section('content')
<div style="margin: 5%;">


<h1>Post</h1>

<p class="bg-danger">{{session('comment_message')}}</p>

<!-- Blog Post -->

<!-- Title -->
<h1>{{$post->title}}</h1>

<!-- Author -->
<p class="lead">
    by <a href="#">{{$post->user->name}}</a>
</p>

<hr>

<!-- Date/Time -->
<p><span class="glyphicon glyphicon-time"></span> Posted {{$post->created_at->diffForHumans()}}</p>

<hr>

<!-- Preview Image -->
<img class="img-responsive" src="{{$post->photo? $post->photo->file:'http://placehold.it/700x200'}}" alt="">

<hr>

<!-- Post Content -->
<p>
    {!!$post->body!!}
</p>
<hr>

<!-- Blog Comments -->

@if(Auth::check())

<!-- Comments Form -->
<div class="well">
    <h4>Leave a Comment:</h4>

    {!! Form::open(['method'=>'POST', 'action'=>'PostCommentController@store']) !!}

    <input type="hidden" name="post_id" value="{{$post->id}}">

    <div class="form-group">
        {!! Form::label('body', 'Body:') !!}
        {!! Form::textarea('body', null, ['class'=>'form-control', 'rows'=>3]) !!}
    </div>

    <div class="form-group">
        {!! Form::submit('Submit Comment', ['class'=>'btn btn-primary']) !!}
    </div>

    {!! Form::close() !!}

</div>
@endif
<hr>

<!-- Posted Comments -->
@if(count($post->comments)>0)
@foreach($post->comments as $comment)
<!-- Comment -->
<div class="media">
    <a class="pull-left" href="#">
        <img height="64" class="media-object"
             src="{{$comment->photo != null? $comment->photo: 'http://placehold.it/64x64'}}" alt="">
    </a>
    <div class="media-body">
        <h4 class="media-heading">{{$comment->author}}
            <small>{{$comment->created_at->diffForHumans()}}</small>
        </h4>
        <p>{{$comment->body}}</p>

        <div class="comment-reply-container">

            <button class="toggle-reply btn btn-primary pull-left">Reply</button>
<!--            <div style="height: 10px;"></div>-->
            <div class="comment-reply col-sm-6" style="display:none;">

                {!! Form::open(['method'=>'POST', 'action'=>'CommentRepliesController@createReply']) !!}
                <input type="hidden" name="comment_id" value="{{$comment->id}}">

                <div class="form-group">
                    {!! Form::label('body', 'Body:') !!}
                    {!! Form::textarea('body', null, ['class'=>'form-control', 'rows'=>1]) !!}
                </div>

                <div class="form-group">
                    {!! Form::submit('Submit', ['class'=>'btn btn-danger']) !!}
                </div>

                {!! Form::close() !!}
            </div>

        </div>

        @if(count($comment->replies) > 0)

        @foreach($comment->replies as $reply)

        @if($reply->is_active ==1)


        <!-- Start Nested Comment -->
        <div class="media" style="margin-top: 30px;">
            <a class="pull-left" href="#">
                <img height="64" class="media-object"
                     src="{{$reply->photo != null? $reply->photo: 'http://placehold.it/64x64'}}" alt="">

            </a>
            <div class="media-body">
                <h4 class="media-heading">{{$reply->author}}
                    <small>{{$reply->created_at->diffForHumans()}}</small>
                </h4>
                <p>{{$reply->body}}</p>
            </div>


            <!-- End Nested Comment -->
        </div>

        @endif
        @endforeach
        @endif
    </div>
</div>
@endforeach
@endif
</div>
@section('scripts')
<script>
    $(".comment-reply-container .toggle-reply").click(function () {

        $(this).next().slideToggle("slow");

    });
</script>


@stop

