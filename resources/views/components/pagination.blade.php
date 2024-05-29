@if (isset($paginator))
    @php
        $queryParams = isset($appends) && gettype($appends) === 'array' ? '&' . http_build_query($appends) : '';
    @endphp
    <nav role="navigation" aria-label="Pagination Navigation" class="d-flex justify-content-between">
        <ul class="pagination d-flex justify-content-center">
            {{-- Previous Page Link --}}
            @if ($paginator->firstPage())
                <li class="page-item disabled me-3" aria-disabled="true">
                    <span class="page-link">
                        <i class="bi bi-caret-left-fill"></i>
                    </span>
                </li>
            @else
                <li class="page-item me-3">
                    <a class="page-link" href="?page={{ $paginator->getNumberPreviousPage() }}{{ $queryParams }}"
                        rel="prev">
                        <i class="bi bi-caret-left-fill"></i>
                    </a>
                </li>
            @endif

            {{-- Next Page Link --}}
            @if (!$paginator->lastPage())
                <li class="page-item ms-3">
                    <a class="page-link" href="?page={{ $paginator->getNumberNextPage() }}{{ $queryParams }}"
                        rel="next">
                        <i class="bi bi-caret-right-fill"></i>
                    </a>
                </li>
            @else
                <li class="page-item disabled ms-3" aria-disabled="true">
                    <span class="page-link">
                        <i class="bi bi-caret-right-fill"></i>
                    </span>
                </li>
            @endif
        </ul>
        <div class="d-flex pt-1">
            <span>
                @if (!empty($appends['filter']))
                    Filtrados: {{ $paginator->total() }}
                @else
                    {{ $paginator->perpage() > $paginator->total() ? 'Mostrando ' . $paginator->total() . ' de ' . $paginator->total() : 'Mostrando ' . $paginator->perPage() . ' de ' . $paginator->total() }}
                @endif
            </span>
        </div>
    </nav>
@endif
