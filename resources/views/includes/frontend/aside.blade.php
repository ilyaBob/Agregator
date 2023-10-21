<aside class="col-side">

    <div class="side-block js-this-in-mobile-menu">
        <div class="side-block__title">Жанры</div>
        <ul class="side-block__content nav">

            @foreach($genres as $genre)
                <li><a href="{{route('frontend.page.index', $genre->slug)}}">{{$genre->name}}</a></li>
            @endforeach

{{--            <li class="submenu">--}}
{{--                <a href="/anime">Аниме</a>--}}
{{--                <div class="nav__btn"><span class="fal fa-plus"></span></div>--}}
{{--                <ul class="nav__hidden">--}}
{{--                    <li><a href="/ranobe">�&nbsp;анобэ</a></li>--}}
{{--                    <li><a href="/manga">Манга</a></li>--}}
{{--                </ul>--}}
{{--            </li>--}}
{{--            <li class="submenu">--}}
{{--                <a href="/fantastika">Фантастика</a>--}}
{{--                <div class="nav__btn"><span class="fal fa-plus"></span></div>--}}
{{--                <ul class="nav__hidden">--}}
{{--                    <li><a href="/boyevaya-fantastika">Боевая фантастика</a></li>--}}
{{--                    <li><a href="/geroicheskaya-fantastika">Героическая фантастика</a></li>--}}
{{--                    <li><a href="/detektivnaya-fantastika">Детективная фантастика</a></li>--}}
{{--                    <li><a href="/detskaya-fantastika">Детская фантастика</a></li>--}}
{{--                    <li><a href="/zarubezhnaya-fantastika">Зарубежная фантастика</a></li>--}}
{{--                    <li><a href="/istoricheskaya-fantastika">Историческая фантастика</a></li>--}}
{{--                    <li><a href="/kosmicheskaya-fantastika">Космическая фантастика</a></li>--}}
{{--                    <li><a href="/nauchnaya-fantastika">Научная фантастика</a></li>--}}
{{--                    <li><a href="/sotsialnaya-fantastika">Социальная фантастика</a></li>--}}
{{--                    <li><a href="/lyubovno-fantasticheskiye-romany">Фантастические романы</a></li>--}}
{{--                    <li><a href="/yumoristicheskaya-fantastika">Юмористическая-фантастика</a></li>--}}
{{--                </ul>--}}
{{--            </li>--}}
{{--            <li class="submenu">--}}
{{--                <a href="/fentezi">Фэнтези</a>--}}
{{--                <div class="nav__btn"><span class="fal fa-plus"></span></div>--}}
{{--                <ul class="nav__hidden">--}}
{{--                    <li><a href="/boyevoye-fentezi">Боевое фэнтези</a></li>--}}
{{--                    <li><a href="/gorodskoye-fentezi">Городское фэнтези</a></li>--}}
{{--                    <li><a href="/geroicheskoye-fentezi">Героическое фэнтези</a></li>--}}
{{--                    <li><a href="/detektivnoye-fentezi">Детективное фэнтези</a></li>--}}
{{--                    <li><a href="/zarubezhnoye-fentezi">Зарубежное фэнтези</a></li>--}}
{{--                    <li><a href="/istoricheskoye-fentezi">Историческое фэнтези</a></li>--}}
{{--                    <li><a href="/lyubovnoye-fentezi">Любовное фэнтези</a></li>--}}
{{--                    <li><a href="/eroticheskoye-fentezi">Эротическое фэнтези</a></li>--}}
{{--                    <li><a href="/yumoristicheskoye-fentezi">Юмористическое фэнтези</a></li>--}}
{{--                </ul>--}}
{{--            </li>--}}
{{--            <li class="submenu">--}}
{{--                <a href="/settingi">Сеттинги</a>--}}
{{--                <div class="nav__btn"><span class="fal fa-plus"></span></div>--}}
{{--                <ul class="nav__hidden">--}}
{{--                    <li><a href="/vselennaya-metro">Вселенная Метро</a></li>--}}
{{--                    <li><a href="/etnogenez">Этногенез</a></li>--}}
{{--                    <li><a href="/stiks">S-T-I-K-S</a></li>--}}
{{--                    <li><a href="/stalker">S.T.A.L.K.E.R.</a></li>--}}
{{--                    <li><a href="/warhammer-40000">Warhammer 40000</a></li>--}}
{{--                </ul>--}}
{{--            </li>--}}

{{--            <li><a href="/kiberpank">Киберпанк</a></li>--}}
{{--            <li><a href="/korotkiye-rasskazy">Короткие рассказы</a></li>--}}
{{--            <li><a href="/litrpg">Лит�&nbsp;ПГ</a></li>--}}
{{--            <li><a href="/popadantsy">Попаданцы</a></li>--}}
{{--            <li><a href="/postapokalipsis">Постапокалипсис</a></li>--}}
{{--            <li><a href="/stimpank">Стимпанк</a></li>--}}
{{--            <li><a href="/uzhasy-mistika">Ужасы/Мистика</a></li>--}}

        </ul>
    </div>
    <div class="side-block">
        <div class="side-block__title">Топ недели</div>
        <div class="side-block__content">
            <a class="popular d-flex ai-center" href="https://fantworld.net/8234-kodeks-ohotnika-kniga-14-jurij-vinokurov-oleg-sapfir.html">
                <div class="popular__img img-fit-cover">
                    <img
                        data-src="/uploads/mini/related/0f/kodeks-okhotnika-kniga-xiv-iurii-vinokurov-oleg-sapfir_95.webp"
                        src="images/no-img.png"
                        alt="Кодекс Охотника. Книга 14 - Юрий Винокуров, Олег Сапфир">
                </div>
                <div class="popular__desc flex-grow-1">
                    <div class="popular__title line-clamp">Кодекс Охотника. Книга 14 - Юрий Винокуров,
                        Олег Сапфир
                    </div>
                    <ul class="poster__subtitle">
                        <li class="ws-nowrap">Фантастика / Юмористическая фантастика / Попаданцы</li>
                    </ul>
                </div>
            </a>
            <a class="popular d-flex ai-center" href="https://fantworld.net/7807-kodeks-ohotnika-kniga-12-jurij-vinokurov-oleg-sapfir.html">
                <div class="popular__img img-fit-cover">
                    <img
                        data-src="/uploads/mini/related/c0/kodeks-okhotnika-iurii-vinokurov-oleg-sapfir_17.webp"
                        src="images/no-img.png"
                        alt="Кодекс Охотника. Книга 12 - Юрий Винокуров, Олег Сапфир">
                </div>
                <div class="popular__desc flex-grow-1">
                    <div class="popular__title line-clamp">Кодекс Охотника. Книга 12 - Юрий Винокуров,
                        Олег Сапфир
                    </div>
                    <ul class="poster__subtitle">
                        <li class="ws-nowrap">Фантастика / Попаданцы / Юмористическая фантастика</li>
                    </ul>
                </div>
            </a><a class="popular d-flex ai-center"
                   href="https://fantworld.net/7806-kodeks-ohotnika-kniga-11-jurij-vinokurov-oleg-sapfir.html">
                <div class="popular__img img-fit-cover">
                    <img
                        data-src="/uploads/mini/related/eb/kodeks-okhotnika-iurii-vinokurov-oleg-sapfir_18.webp"
                        src="images/no-img.png"
                        alt="Кодекс Охотника. Книга 11 - Юрий Винокуров, Олег Сапфир">
                </div>
                <div class="popular__desc flex-grow-1">
                    <div class="popular__title line-clamp">Кодекс Охотника. Книга 11 - Юрий Винокуров,
                        Олег Сапфир
                    </div>
                    <ul class="poster__subtitle">
                        <li class="ws-nowrap">Фантастика / Попаданцы / Юмористическая фантастика</li>
                    </ul>
                </div>
            </a><a class="popular d-flex ai-center"
                   href="https://fantworld.net/8215-kodeks-ohotnika-kniga-13-oleg-sapfir.html">
                <div class="popular__img img-fit-cover">
                    <img data-src="/uploads/mini/related/9e/kodeks-okhotnika-13-oleg-sapfir_35.webp"
                         src="images/no-img.png" alt="Кодекс Охотника. Книга 13 - Олег Сапфир">
                </div>
                <div class="popular__desc flex-grow-1">
                    <div class="popular__title line-clamp">Кодекс Охотника. Книга 13 - Олег Сапфир</div>
                    <ul class="poster__subtitle">
                        <li class="ws-nowrap">Фантастика / Попаданцы / Юмористическая фантастика</li>
                    </ul>
                </div>
            </a><a class="popular d-flex ai-center"
                   href="https://fantworld.net/7803-kodeks-ohotnika-kniga-8-jurij-vinokurov-oleg-sapfir.html">
                <div class="popular__img img-fit-cover">
                    <img
                        data-src="/uploads/mini/related/14/kodeks-okhotnika-iurii-vinokurov-oleg-sapfir_21.webp"
                        src="images/no-img.png"
                        alt="Кодекс Охотника. Книга 8 - Юрий Винокуров, Олег Сапфир">
                </div>
                <div class="popular__desc flex-grow-1">
                    <div class="popular__title line-clamp">Кодекс Охотника. Книга 8 - Юрий Винокуров,
                        Олег Сапфир
                    </div>
                    <ul class="poster__subtitle">
                        <li class="ws-nowrap">Фантастика / Попаданцы / Юмористическая фантастика</li>
                    </ul>
                </div>
            </a><a class="popular d-flex ai-center"
                   href="https://fantworld.net/7805-kodeks-ohotnika-kniga-10-jurij-vinokurov-oleg-sapfir.html">
                <div class="popular__img img-fit-cover">
                    <img
                        data-src="/uploads/mini/related/af/kodeks-okhotnika-iurii-vinokurov-oleg-sapfir_19.webp"
                        src="images/no-img.png"
                        alt="Кодекс Охотника. Книга 10 - Юрий Винокуров, Олег Сапфир">
                </div>
                <div class="popular__desc flex-grow-1">
                    <div class="popular__title line-clamp">Кодекс Охотника. Книга 10 - Юрий Винокуров,
                        Олег Сапфир
                    </div>
                    <ul class="poster__subtitle">
                        <li class="ws-nowrap">Фантастика / Попаданцы / Юмористическая фантастика</li>
                    </ul>
                </div>
            </a><a class="popular d-flex ai-center"
                   href="https://fantworld.net/7804-kodeks-ohotnika-kniga-9-jurij-vinokurov-oleg-sapfir.html">
                <div class="popular__img img-fit-cover">
                    <img
                        data-src="/uploads/mini/related/a0/kodeks-okhotnika-iurii-vinokurov-oleg-sapfir_20.webp"
                        src="images/no-img.png"
                        alt="Кодекс Охотника. Книга 9 - Юрий Винокуров, Олег Сапфир">
                </div>
                <div class="popular__desc flex-grow-1">
                    <div class="popular__title line-clamp">Кодекс Охотника. Книга 9 - Юрий Винокуров,
                        Олег Сапфир
                    </div>
                    <ul class="poster__subtitle">
                        <li class="ws-nowrap">Фантастика / Попаданцы / Юмористическая фантастика</li>
                    </ul>
                </div>
            </a>
        </div>
    </div>
    <div class="side-block">
        <div class="side-block__title">Комментируют</div>
        <div class="side-block__content">
            <div class="lcomm">
                <div class="lcomm__meta d-flex ai-center">
                    <div class="lcomm__author flex-grow-1 ws-nowrap">Гость Александр</div>
                    <div class="lcomm__date">07.10.23</div>
                </div>
                <div class="lcomm__text">Книга 3 - тоже самое что и книга 2?</div>
                <a class="lcomm__link ws-nowrap icon-at-left"
                   href="https://fantworld.net/7530-gildija-zlodeev-kniga-3-dmitrij-ra.html#comment"><span
                        class="fal fa-arrow-circle-right"></span>Гильдия злодеев. Книга 3 - Дмитрий �&nbsp;а</a>
            </div>
            <div class="lcomm">
                <div class="lcomm__meta d-flex ai-center">
                    <div class="lcomm__author flex-grow-1 ws-nowrap">SAIK860</div>
                    <div class="lcomm__date">07.10.23</div>
                </div>
                <div class="lcomm__text">Опять за*рот анимешник книги пишет. Надоели уже такие писаки.
                </div>
                <a class="lcomm__link ws-nowrap icon-at-left"
                   href="https://fantworld.net/7159-oruzhejnyj-baron-sergej-polev.html#comment"><span
                        class="fal fa-arrow-circle-right"></span>Оружейный Барон. Книга 1 - Сергей Полев</a>
            </div>
            <div class="lcomm">
                <div class="lcomm__meta d-flex ai-center">
                    <div class="lcomm__author flex-grow-1 ws-nowrap">SAIK860</div>
                    <div class="lcomm__date">07.10.23</div>
                </div>
                <div class="lcomm__text">Вся книга - это большое избиение и топтание на одном месте.
                </div>
                <a class="lcomm__link ws-nowrap icon-at-left"
                   href="https://fantworld.net/8105-nulevoj-mir-2-mera-odin-aleksandr-izotov.html#comment"><span
                        class="fal fa-arrow-circle-right"></span>Нулевой мир 2. Мера один - Александр
                    Изотов</a>
            </div>
        </div>
    </div>

</aside>
