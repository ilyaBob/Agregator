@php
    use \App\Enums\MassageEnum;
@endphp


@if(session($key))
    <div class="alert @if($key == MassageEnum::TYPE_ERROR) alert-danger @elseif($key == MassageEnum::TYPE_SUCCESS) alert-success @else alert-primary @endif ">
        {{ session($key) }}
    </div>
@endif
