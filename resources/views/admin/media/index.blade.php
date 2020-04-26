@extends ('layouts.admin')


@section('content')
<h1>Media</h1>

<p class="bg-danger">{{session('deleted_photo')}}</p>

@if($photos)

<table class="table table-hover">
    <thead>
    <tr>
        <th>Id</th>
        <th>Photo</th>
        <th>Created</th>
        <th>Updated</th>
    </tr>
    </thead>
    <tbody>

    @foreach($photos as $photo)

    <tr>
        <td>{{$photo->id}}</td>

        <td><img height="50" src="{{$photo->file != null ? $photo->file: 'No photo'}}" alt=""></td>
        <td>{{$photo->created_at != null ? $photo->created_at->diffForHumans(): "No date"}}</td>
        <td>{{$photo->updated_at != null ? $photo->updated_at->diffForHumans(): "No date"}}</td>
        <td>
            {!! Form::open(['method'=>'DELETE', 'action'=>['AdminMediasController@destroy', $photo->id]]) !!}

            <div class="form-group">
                {!! Form::submit('Delete Photo', ['class'=>'btn btn-danger']) !!}
            </div>

            {!! Form::close() !!}
        </td>
    </tr>

    @endforeach
    @endif
    </tbody>
</table>
@stop

