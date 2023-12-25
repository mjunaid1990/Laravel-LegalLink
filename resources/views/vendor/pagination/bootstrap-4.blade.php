@if ($paginator->hasPages())
    <nav>
        <ul class="pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span class="page-link" aria-hidden="true">&lsaquo;</span>
                </li>
            @else
                @php
                $page = (int)$paginator->currentPage();
                $prevpage = $page - 1;
                @endphp
                @if(strpos(url()->full(), '?') !== false)
                <li class="page-item">
                    <a class="page-link" data-page="{{$prevpage}}" href="{{ url()->full().'&page='.$prevpage }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
                </li>
                @else
                <li class="page-item">
                    <a class="page-link" data-page="{{$prevpage}}" href="{{ url()->full().'?page='.$prevpage }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
                </li>
                @endif
            
                
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li>
                        @else
                            @if(strpos(url()->full(), '?') !== false)
                            <li class="page-item"><a class="page-link" data-page="{{$page}}" href="{{ url()->full().'&page='.$page }}">{{ $page }}</a></li>
                            @else
                            <li class="page-item"><a class="page-link" data-page="{{$page}}" href="{{ url()->full().'?page='.$page }}">{{ $page }}</a></li>
                            @endif
                            
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
            
                @php
                $page = (int)$paginator->currentPage();
                $nextpage = $page + 1;
                @endphp
            
                @if(strpos(url()->full(), '?') !== false)
                <li class="page-item">
                    <a class="page-link" data-page="{{$nextpage}}" href="{{ url()->full().'&page='.$nextpage }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
                </li>
                @else
                <li class="page-item">
                    <a class="page-link" data-page="{{$nextpage}}" href="{{ url()->full().'?page='.$nextpage }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
                </li>
                @endif
                
            @else
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span class="page-link" aria-hidden="true">&rsaquo;</span>
                </li>
            @endif
        </ul>
    </nav>
@endif
