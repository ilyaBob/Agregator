<div class="side-block js-this-in-mobile-menu">
    <div class="side-block__title">Жанры</div>
    <ul class="side-block__content nav">

        @foreach($data as $genres)
            @foreach($genres as $genre)
                @if ($loop->first)
                    <li class="submenu">
                        <a href="{{route('frontend.page.index', $genre['slug'])}}">{{$genre['name']}}</a>
                        @if ($loop->count > 1)
                            <div class="nav__btn"><span class="fal fa-plus"></span></div>
                        @endif

                @endif

                @if( isset($genre['parent_id']) )
                    @if ($loop->iteration == 2)

                        <ul class="nav__hidden">
                            @endif

                            <li>
                                <a href="{{route('frontend.page.index', $genre['slug'])}}">{{$genre['name']}}</a>
                            </li>

                            @if ($loop->last)
                        </ul>
                    @endif
                @endif

                @if ($loop->last)
                    </li>
               @endif

            @endforeach

        @endforeach
    </ul>
</div>
