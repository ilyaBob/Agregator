<?php

use App\Models\Admin\Book;
use App\Models\Admin\Genre;
use App\Models\Admin\Reader;
use App\Enums\SettingEnum;

/**
 * @var Book $book
 * @var Genre $genre
 */

?>

@extends('layouts.frontend')

@section('container')

    <main class="col-main flex-grow-1 d-flex fd-column grid-2" id="grid">

        <section class="sect">
            <div class="sect__header d-flex">
                <h2 class="sect__title flex-grow-1">{{ $genre->name ?? 'Новые аудиокниги'}}</h2>


                <div class="sect__btns grid-select d-flex">
                    <div class="grid-select__btn" title="Выводить списком" data-grid="grid-1"><span
                            class="fal fa-th-list"></span></div>
                    <div class="grid-select__btn is-active" title="Большие постеры" data-grid="grid-2"><span
                            class="fal fa-th-large"></span></div>
                </div>
                <div class="sect__btn-filter" data-text="Фильтр">подобрать с фильтром</div>
            </div>
            <div class="sect__content" id="dle-content">

                @foreach($books as $book)
                    <a class="poster grid-item d-flex fd-column has-overlay" href="{{route('frontend.single.index', [$book->genre_slug, $book->slug])}}">
                        <div class="poster__img img-responsive img-responsive--portrait img-fit-cover">
                            <img src="{{ url('storage/'. $book->image) }}" alt="{{$book->title}}">
                            <div class="poster__label">{{$book->time}}</div>
                            <div class="has-overlay__mask btn-icon anim"><span class="fal fa-headphones"></span></div>

                        </div>
                        <div class="poster__desc">
                            <h3 class="poster__title">{{$book->title}}</h3>
                            <ul class="poster__subtitle ws-nowrap"> </ul>
                            <div class="poster__text line-clamp">
                                {{$book->description}}
                            </div>
                        </div>
                    </a>
                @endforeach

                {{$books->links('includes.frontend.paginate')}}

            </div>
        </section>


        @include('includes.frontend.top-filter')
    </main>

@endsection
