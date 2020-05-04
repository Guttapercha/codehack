@extends ('layouts.admin')


@section('content')
<h1>Media</h1>

<p class="bg-danger">{{session('deleted_photo')}}</p>

@if($photos)

<form action="delete/media" method="post" class="form-inline">
    {{ csrf_field() }}
    {{ method_field('DELETE') }}
    <div class="form-group">
        <select name="checkBoxArray" class="form-control" id="">
            <option value="">Delete</option>
        </select>
    </div>
    <div class="form-group">
        <input type="submit" name="delete_all" class="btn-primary">
    </div>

    <table class="table table-hover">
        <thead>
        <tr>
            <th><input type="checkbox" id="options"></th>
            <th>Id</th>
            <th>Photo</th>
            <th>Created</th>
            <th>Updated</th>
        </tr>
        </thead>
        <tbody>

        @foreach($photos as $photo)

        <tr>
            <td><input class="checkBoxes" type="checkbox" name="checkBoxArray[]" value="{{$photo->id}}"></td>
            <td>{{$photo->id}}</td>
            <td><img height="50" src="{{$photo->file != null ? $photo->file: 'No photo'}}" alt=""></td>
            <td>{{$photo->created_at != null ? $photo->created_at->diffForHumans(): "No date"}}</td>
            <td>{{$photo->updated_at != null ? $photo->updated_at->diffForHumans(): "No date"}}</td>
            <td><input type="hidden" name="photo" value="{{$photo->id}}">
            </td>
        </tr>

        @endforeach

        </tbody>
    </table>
</form>
@endif


@stop

@section('scripts')

<!-- jQuery -->
<script src="{{asset('js/libs.js')}}"></script>
<script>
    $(document).ready(function () {
        $('#options').click(function () {

            if (this.checked) {
                $('.checkBoxes').each(function () {
                    this.checked = true;
                });
            } else {
                $('.checkBoxes').each(function () {
                    this.checked = false;
                });
            }
            console.log('hello');
        });
    });
</script>

@stop
