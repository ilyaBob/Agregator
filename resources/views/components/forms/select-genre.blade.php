<div class="form-group">
    <label>{{$label}}</label>
    <select  class="form-control" name="{{$name}}">
            @foreach($dataArray as $item)
                <option value="{{$item->slug}}"
                @if (old($name , $values)) {{ ($item->slug == old($name, $values) ? "selected":"") }} @endif>
                    {{$item->name}}
                </option>
            @endforeach
    </select>
</div>

@error($name)
<div class="alert alert-danger">{{ $message }}</div>
@enderror
