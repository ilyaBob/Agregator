@if ($paginator->hasPages())
    <div class="pagination ignore-select" id="pagination">

        <div class="pagination__btn-loader d-flex jc-center ai-center"><a
                href="https://fantworld.net/page/2/">Загрузить еще<span
                    class="fal fa-ellipsis-h"></span></a></div>


        <div class="pagination__pages d-flex jc-center">

            @foreach ($elements as $element)

                @if (is_string($element))
                    <span class="nav_ext">...</span>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span>{{$page}}</span>
                        @else
                            <a href="{{$url}}">{{$page}}</a>
                        @endif
                    @endforeach
                @endif

            @endforeach
        </div>


    </div>
@endif
