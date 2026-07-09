@if ($paginator->hasPages())
    <nav class="pager" role="navigation" aria-label="Pagination">
        @if ($paginator->onFirstPage())
            <span class="pager-btn disabled" aria-hidden="true"><i class="hgi-stroke hgi-arrow-left-01"></i></span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="pager-btn" rel="prev" aria-label="Page précédente"><i class="hgi-stroke hgi-arrow-left-01"></i></a>
        @endif

        <div class="pager-pages">
            @foreach ($elements as $element)
                @if (is_string($element))
                    <span class="pager-dots">{{ $element }}</span>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="pager-page active" aria-current="page">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}" class="pager-page">{{ $page }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach
        </div>

        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="pager-btn" rel="next" aria-label="Page suivante"><i class="hgi-stroke hgi-arrow-right-01"></i></a>
        @else
            <span class="pager-btn disabled" aria-hidden="true"><i class="hgi-stroke hgi-arrow-right-01"></i></span>
        @endif
    </nav>
@endif
