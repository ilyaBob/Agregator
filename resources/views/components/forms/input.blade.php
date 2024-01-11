@if($multiple)
    @foreach(old($name, ['']) as $value)
        <div class="form-group {{$formClass}}">
            @if($label)
                <label for="{{$id}}">{{$label}}</label>
            @endif
            <input
                type="{{$type}}"
                name="{{$name}}@if($multiple)[]@endif"
                class="form-control {{$class}} {{($errors->has($name)? 'is-invalid': false)}}"
                @if($id)
                    id="{{$id}}"
                @endif

                @if($placeholder)
                    placeholder="{{$placeholder}}"
                @endif
                value="{{$value}}"
                {{$disabled}} >
        </div>
        @error($name)
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    @endforeach
@else

    <div class="form-group {{$formClass}}">
        @if($label)
            <label for="{{$id}}">{{$label}}</label>
        @endif
        <input
            type="{{$type}}"
            name="{{$name}}@if($multiple)[]@endif"
            class="form-control {{$class}} {{($errors->has($name)? 'is-invalid': false)}}"
            @if($id)
                id="{{$id}}"
            @endif

            @if($placeholder)
                placeholder="{{$placeholder}}"
            @endif
            value="{{ old($name, $value) }}"
            {{$disabled}} >
    </div>
    @error($name)
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror

@endif
