<div class="form-group">
    <label for="{{$id}}">{{$label}}</label>
    <div class="input-group">
        <div class="custom-file">
            <input name="{{$name}}" type="file" class="custom-file-input" id="{{$id}}">
            <label class="custom-file-label" for="{{$id}}">Выберите файл</label>
        </div>
        <div class="input-group-append">
            <span class="input-group-text">Загрузить</span>
        </div>
    </div>
</div>
@error($name)
<div class="alert alert-danger">{{ $message }}</div>
@enderror

@section('another-scripts-for-page')
    <script src="{{asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>

    <script>
        $(function () {
            bsCustomFileInput.init();
        });
    </script>
@endsection
