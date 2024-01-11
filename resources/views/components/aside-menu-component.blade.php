<div class="side-block js-this-in-mobile-menu">
    <div class="side-block__title">Жанры</div>
    <ul class="side-block__content nav">
        @foreach($genres as $genre)
            <li><a href="{{route('frontend.page.index', $genre->slug)}}">{{$genre->name}}</a></li>
        @endforeach
    </ul>
</div>
