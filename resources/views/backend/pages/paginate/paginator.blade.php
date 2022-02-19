@if ($paginator->hasPages())
    <nav>
        <ul class="pagination">

            @if ($paginator->onFirstPage())
                <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span aria-hidden="true"><button class="btn btn-primary mr-1 disabled">Önceki</button></span>
                </li>
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev"
                        aria-label="@lang('pagination.previous')"><button
                            class="btn btn-primary mr-1">Önceki</button></a>
                </li>
            @endif

            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')"><button
                            class="btn btn-primary">Sonraki</button></a>
                </li>
            @else
                <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span aria-hidden="true"><button class="btn btn-primary disabled">Sonraki</button></span>
                </li>
            @endif
        </ul>
    </nav>
@endif
