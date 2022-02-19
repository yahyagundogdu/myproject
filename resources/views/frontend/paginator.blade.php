@if ($paginator->hasPages())
    <ul class="my-pagination">
        @if ($paginator->onFirstPage())
            <li class="disabled">
                <span class="fa fa-angle-left"></span>
            </li>
        @else
            <li class="">
                <a href="{{ $paginator->previousPageUrl() }}"><span class="fa fa-angle-left"></span></a>
            </li>
        @endif
        @foreach ($elements as $element)
            @if (is_string($element))
                <li class="disabled">
                    <span class="fa fa-angle-left">{{ $element }}</span>
                </li>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="active">
                            <a href="#">{{ $page }}</a>
                        </li>
                    @else
                        <li class="">
                            <a href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endif
                @endforeach
            @endif
        @endforeach

        @if ($paginator->hasMorePages())
            <li class="">
                <a href="{{ $paginator->nextPageUrl() }}"><span class="fa fa-angle-right"></span></a>
            </li>
        @else
            <li class="disabled">
                <span class="fa fa-angle-right"></span>
            </li>
        @endif
    </ul>
@endif
