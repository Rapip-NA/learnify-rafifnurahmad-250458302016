@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="pagination-wrapper">
        {{-- Mobile Pagination --}}
        <div class="flex justify-between items-center flex-1 sm:hidden">
            {{-- Previous Button Mobile --}}
            @if ($paginator->onFirstPage())
                <span
                    class="px-4 py-2 text-sm font-semibold text-slate-500 bg-slate-800/50 border border-slate-700 cursor-default rounded-lg">
                    <i class="bi bi-chevron-left mr-1"></i>
                    Previous
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}"
                    class="px-4 py-2 text-sm font-semibold text-white bg-slate-800 border border-slate-700 rounded-lg hover:bg-slate-700 hover:border-indigo-500/50 transition-all duration-200">
                    <i class="bi bi-chevron-left mr-1"></i>
                    Previous
                </a>
            @endif

            {{-- Page Info Mobile --}}
            <span class="text-sm text-slate-400 font-medium">
                Page {{ $paginator->currentPage() }} of {{ $paginator->lastPage() }}
            </span>

            {{-- Next Button Mobile --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}"
                    class="px-4 py-2 text-sm font-semibold text-white bg-slate-800 border border-slate-700 rounded-lg hover:bg-slate-700 hover:border-indigo-500/50 transition-all duration-200">
                    Next
                    <i class="bi bi-chevron-right ml-1"></i>
                </a>
            @else
                <span
                    class="px-4 py-2 text-sm font-semibold text-slate-500 bg-slate-800/50 border border-slate-700 cursor-default rounded-lg">
                    Next
                    <i class="bi bi-chevron-right ml-1"></i>
                </span>
            @endif
        </div>

        {{-- Desktop Pagination --}}
        <div class="hidden sm:flex sm:items-center sm:justify-between w-full">
            {{-- Results Info --}}
            <div>
                <p class="text-sm text-slate-400 font-medium">
                    Showing
                    @if ($paginator->firstItem())
                        <span class="font-bold text-white">{{ $paginator->firstItem() }}</span>
                        to
                        <span class="font-bold text-white">{{ $paginator->lastItem() }}</span>
                    @else
                        <span class="font-bold text-white">{{ $paginator->count() }}</span>
                    @endif
                    of
                    <span class="font-bold text-white">{{ $paginator->total() }}</span>
                    results
                </p>
            </div>

            {{-- Page Numbers --}}
            <div>
                <div class="flex items-center gap-1">
                    {{-- Previous Page Link --}}
                    @if ($paginator->onFirstPage())
                        <span
                            class="px-3 py-2 text-sm font-semibold text-slate-600 bg-slate-800/30 border border-slate-700/50 cursor-not-allowed rounded-lg"
                            aria-disabled="true">
                            <i class="bi bi-chevron-left"></i>
                        </span>
                    @else
                        <a href="{{ $paginator->previousPageUrl() }}" rel="prev"
                            class="px-3 py-2 text-sm font-semibold text-slate-300 bg-slate-800 border border-slate-700 rounded-lg hover:bg-gradient-to-r hover:from-indigo-500 hover:to-purple-600 hover:text-white hover:border-transparent hover:shadow-lg hover:shadow-indigo-500/30 transition-all duration-200"
                            aria-label="Previous page">
                            <i class="bi bi-chevron-left"></i>
                        </a>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($elements as $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <span
                                class="px-4 py-2 text-sm font-semibold text-slate-500 bg-slate-800/30 border border-slate-700/50 rounded-lg cursor-default">
                                {{ $element }}
                            </span>
                        @endif

                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <span
                                        class="px-4 py-2 text-sm font-bold text-white bg-gradient-to-r from-indigo-500 to-purple-600 border border-transparent rounded-lg shadow-lg shadow-indigo-500/30 cursor-default"
                                        aria-current="page">
                                        {{ $page }}
                                    </span>
                                @else
                                    <a href="{{ $url }}"
                                        class="px-4 py-2 text-sm font-semibold text-slate-300 bg-slate-800 border border-slate-700 rounded-lg hover:bg-gradient-to-r hover:from-indigo-500 hover:to-purple-600 hover:text-white hover:border-transparent hover:shadow-lg hover:shadow-indigo-500/30 transition-all duration-200"
                                        aria-label="Go to page {{ $page }}">
                                        {{ $page }}
                                    </a>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                        <a href="{{ $paginator->nextPageUrl() }}" rel="next"
                            class="px-3 py-2 text-sm font-semibold text-slate-300 bg-slate-800 border border-slate-700 rounded-lg hover:bg-gradient-to-r hover:from-indigo-500 hover:to-purple-600 hover:text-white hover:border-transparent hover:shadow-lg hover:shadow-indigo-500/30 transition-all duration-200"
                            aria-label="Next page">
                            <i class="bi bi-chevron-right"></i>
                        </a>
                    @else
                        <span
                            class="px-3 py-2 text-sm font-semibold text-slate-600 bg-slate-800/30 border border-slate-700/50 cursor-not-allowed rounded-lg"
                            aria-disabled="true">
                            <i class="bi bi-chevron-right"></i>
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </nav>

    {{-- Light Theme Styles --}}
    <style>
        /* Light Theme Support */
        body.light-theme .pagination-wrapper .text-slate-400 {
            color: #64748b !important;
        }

        body.light-theme .pagination-wrapper .text-slate-300 {
            color: #475569 !important;
        }

        body.light-theme .pagination-wrapper .text-slate-500 {
            color: #94a3b8 !important;
        }

        body.light-theme .pagination-wrapper .text-slate-600 {
            color: #cbd5e1 !important;
        }

        body.light-theme .pagination-wrapper .text-white {
            color: #0f172a !important;
        }

        body.light-theme .pagination-wrapper .bg-slate-800 {
            background: #f8fafc !important;
            border-color: #e2e8f0 !important;
        }

        body.light-theme .pagination-wrapper .bg-slate-800\/50,
        body.light-theme .pagination-wrapper .bg-slate-800\/30 {
            background: #f1f5f9 !important;
            border-color: #e2e8f0 !important;
        }

        body.light-theme .pagination-wrapper .border-slate-700,
        body.light-theme .pagination-wrapper .border-slate-700\/50 {
            border-color: #e2e8f0 !important;
        }

        body.light-theme .pagination-wrapper .bg-gradient-to-r {
            /* Keep gradient colors in light mode */
        }

        body.light-theme .pagination-wrapper a:hover {
            background: linear-gradient(to right, #6366f1, #9333ea) !important;
            color: white !important;
            border-color: transparent !important;
        }
    </style>
@endif
