@php
/**
*  @var \App\Models\Admin\Book[] $topBook
*/
@endphp

<div class="side-block">
    <div class="side-block__title">Топ недели</div>
    <div class="side-block__content">
        @foreach($topBook as $book)
            <a class="popular d-flex ai-center" href="{{route('frontend.single.index', ['slug' => $book->genre_slug, 'slugBook' =>$book->slug ])}}">
                <div class="popular__img img-fit-cover">
                    <img src="{{$book->image}}" alt="{{$book->title}}">
                </div>
                <div class="popular__desc flex-grow-1">
                    <div class="popular__title line-clamp">{{$book->title}}
                    </div>
                    <ul class="poster__subtitle">
                        <li class="ws-nowrap">
                            @foreach($book->genres as $genre)
                                {{$genre->name}}
                                @if(!$loop->last) /@endif
                            @endforeach
                        </li>
                    </ul>
                </div>
            </a>
         @endforeach
    </div>
</div>
