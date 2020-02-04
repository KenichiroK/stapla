@if ($paginator->hasPages())

<ul role="navigation" class="impro-pagination">
    @if ($paginator->onFirstPage())
    <li aria-disabled="true" aria-label="« 前" class="page-item disabled">
        <span aria-hidden="true" class="page-link"><i class="fas fa-angle-left"></i></span>
    </li>
    @else
    <li class="page-item">
        <a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="« 前" class="page-link">
            <i class="fas fa-angle-left"></i>
        </a>
    </li>
    @endif

    {{-- Pagination Elements --}}
    @foreach ($elements as $element)
        {{-- "Three Dots" Separator --}}
        @if (is_string($element))
            <li class="disabled"><a>{{ $element }}</a></li>
        @endif

        {{-- Array Of Links --}}
        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                    <li aria-current="page" class="page-item active">
                        <span class="page-link">{{ $page }}</span>
                    </li>
                @else
                    <li class="page-item">
                        <a href="{{ $url }}" class="page-link">{{ $page }}</a>
                    </li>
                @endif
            @endforeach
        @endif
    @endforeach

    {{-- Next Page Link --}}
    @if ($paginator->hasMorePages())
    <li class="page-item">
        <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="次 »" class="page-link">
            <i class="fas fa-angle-right"></i>
        </a>
    </li>
    @else
    <li aria-disabled="true" aria-label="次 »" class="page-item disabled">
        <span aria-hidden="true" class="page-link"><i class="fas fa-angle-right"></i></span>
    </li>
    @endif
</ul>
@endif