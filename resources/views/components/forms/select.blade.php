<div class="form-group">
    <label>{{$label}}</label>
    <select {{ $multiple? 'multiple':false }} class="form-control" name="{{$name}}{{ $multiple? '[]':false }}">
        @if($multiple)
            @foreach($dataArray as $item)
                <option value="{{$item->id}}"
                @if (old($name, $values)) {{ (in_array($item->id, old($name, $values)) ? "selected":"") }} @endif>
                    {{$item->name}}
                </option>
            @endforeach

        @else
            <option value="0">Не выбрано</option>
            @foreach($dataArray as $item)
                <option value="{{$item->id}}"
                @if (old($name , $values)) {{ ($item->id == old($name, $values) ? "selected":"") }} @endif>
                    {{$item->name}}
                </option>
            @endforeach



        @endif
    </select>
</div>

@error($name)
<div class="alert alert-danger">{{ $message }}</div>
@enderror
