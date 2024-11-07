@if ($paginator->hasPages())
    <div class="pagination">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="prev-arrow disabled"><i class="fa fa-long-arrow-left" aria-hidden="true"></i></span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="prev-arrow"><i class="fa fa-long-arrow-left" aria-hidden="true"></i></a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <span class="dot-dot"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></span>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <a href="#" class="active">{{ $page }}</a>
                    @else
                        <a href="{{ $url }}">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="next-arrow"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
        @else
            <span class="next-arrow disabled"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></span>
        @endif
    </div>
@endif
