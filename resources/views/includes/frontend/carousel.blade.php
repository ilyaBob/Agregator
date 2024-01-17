@php
/**
 * @var \App\Models\Admin\Book[] $topBook
 */
@endphp
<div class="carou">
    <div class="carou__content" id="owl-carou">
        @foreach($topBook as $book )
            <a class="top d-flex fd-column has-overlay" href="{{route('frontend.single.index', ['slug' => $book->genre_slug, 'slugBook' =>$book->slug ])}}">
                <div class="top__img img-fit-cover img-responsive img-responsive--portrait img-mask">
                    <img src="{{$book->image}}" src="images/no-img.png" alt="{{$book->title}}">
                    <div class="has-overlay__mask btn-icon anim">
                        <span class="fal fa-headphones"></span>
                    </div>
                    <div class="top__desc">
                        <div class="top__title ">{{$book->title}} </div>
                    </div>
                </div>
            </a>
        @endforeach
    </div>

    <div class="carou__desc d-flex fd-column jc-center">
        <div class="carou__title">Топ аудиокниг</div>
        <div class="carou__caption">Популярные новинки по версии аудиослушателей</div>
    </div>
</div>
