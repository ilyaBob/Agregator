<div class="form-group">
    <label for="{{$id}}">{{$label}}</label>
    <textarea id="{{$id}}" name="{{$name}}">{{ old($name, $value) }} </textarea>
</div>
@error($name)
<div class="alert alert-danger">{{ $message }}</div>
@enderror


@section('another-scripts-for-page')
    <script src="{{asset('plugins/summernote/summernote-bs4.min.js')}}"></script>

    <script>
        $('#description').summernote()
    </script>
@endsection
