@extends ('layouts.admin')


@section('content')
<h1>Posts</h1>

<p class="bg-danger">{{session('deleted_post')}}</p>

<table class="table table-hover">
    <thead>
    <tr>
        <th>Id</th>
        <th>Photo</th>
        <th>Title</th>
        <th>User</th>
        <th>Category</th>
<!--        <th>Body</th>-->
        <th>Post Link</th>
        <th>Comments</th>
        <th>Created</th>
        <th>Updated</th>
    </tr>
    </thead>
    <tbody>

    @if($posts)

    @foreach($posts as $post)

    <tr>
        <td>{{$post->id}}</td>
        <td><img height = "50" src="{{$post->photo? $post->photo->file:'http://placehold.it/400x400'}}" alt=""></td>
        <td><a href="{{route('posts.edit', $post->id)}}">{{$post->title}}</a></td>
        <td>{{$post->user->name}}</td>
        <td>{{$post->category != null ? $post->category->name: 'No category'}}</td>
<!--        <td>{{str_limit($post->body, 10)}}</td>-->
        <td><a href="{{route('home.post', $post->slug)}}">View Post</a></td>
        <td><a href="{{route('comments.show', $post->id)}}">View Comments</a></td>
        <td>{{$post->created_at->diffForHumans()}}</td>
        <td>{{$post->updated_at->diffForHumans()}}</td>
    </tr>

    @endforeach
    @endif
    </tbody>
</table>

<div class = "row">
    <div class="col-sm-6 col-sm-offset-5">
        {{$posts->render()}}
    </div>
</div>
@stop
