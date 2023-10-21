<div class="form-check mb-3">
    <input name="{{$name}}" type="checkbox" class="form-check-input"
           id="{{$id}}" value="1" @if( old($name, $value)) checked @endif>
    <label class="form-check-label" for="{{$id}}">{{$label}}</label>
</div>
