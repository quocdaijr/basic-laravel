@if ($paginator->hasPages())
    <div role="navigation" aria-label="{{ __('Pagination Navigation') }}"
         class="grid px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800">
        <span class="flex items-center col-span-3">
            {!! __('Showing') !!} {{ $paginator->firstItem() }}-{{ $paginator->lastItem() }} {!! __('of') !!} {{ $paginator->total() }} {!! __('results') !!}
        </span>
        <span class="col-span-2"></span>
        <span class="flex col-span-4 mt-2 sm:mt-auto sm:justify-end">
            <nav aria-label="Table navigation">
                <ul class="inline-flex items-center">
                    {{-- Previous Page Link --}}
                    @if ($paginator->onFirstPage())
                        <li>
                        <span rel="prev"
                              aria-label="{{ __('pagination.previous') }}"
                              class="flex items-center justify-between px-3 py-2 rounded-md rounded-l-lg focus:outline-none focus:shadow-outline-purple">
                          <svg aria-hidden="true" class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                            <path
                                d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                clip-rule="evenodd"
                                fill-rule="evenodd"
                            ></path>
                          </svg>
                        </span>
                        </li>
                    @else
                        <li>
                        <a href="{{ $paginator->previousPageUrl() }}" rel="prev"
                           aria-label="{{ __('pagination.previous') }}"
                           class="flex items-center justify-between px-3 py-2 rounded-md rounded-l-lg focus:outline-none focus:shadow-outline-purple">
                          <svg aria-hidden="true" class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                            <path
                                d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                clip-rule="evenodd"
                                fill-rule="evenodd"
                            ></path>
                          </svg>
                        </a>
                        </li>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($elements as $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <li aria-disabled="true">
                            <span class="flex items-center justify-between px-3 py-2">{{ $element }}</span>
                          </li>
                        @endif

                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <li>
                                    <span aria-current="page"
                                          class="flex items-center justify-between px-3 py-2 cursor-pointer text-white transition-colors duration-150 bg-purple-600 border border-r-0 border-purple-600 rounded-md focus:outline-none focus:shadow-outline-purple">{{ $page }}</span>
                                    </li>
                                @else
                                    <li>
                                    <a href="{{ $url }}" aria-current="page"
                                       aria-label="{{ __('Go to page :page', ['page' => $page]) }}"
                                       class="flex items-center justify-between px-3 py-2 rounded-md focus:outline-none focus:shadow-outline-purple">{{ $page }}</a>
                                    </li>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                        <li>
                            <a class="flex items-center justify-between px-3 py-2 rounded-md rounded-r-lg focus:outline-none focus:shadow-outline-purple"
                               href="{{ $paginator->nextPageUrl() }}"
                               rel="next"
                               aria-label="{{ __('pagination.next') }}">
                              <svg class="w-4 h-4 fill-current" aria-hidden="true" viewBox="0 0 20 20">
                                <path
                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd"
                                    fill-rule="evenodd"
                                ></path>
                              </svg>
                            </a>
                        </li>
                    @else
                        <li>
                            <span
                                class="flex items-center justify-between px-3 py-2 rounded-md rounded-r-lg focus:outline-none focus:shadow-outline-purple"
                                aria-disabled="true"
                                aria-label="{{ __('pagination.next') }}">
                              <svg class="w-4 h-4 fill-current" aria-hidden="true" viewBox="0 0 20 20">
                                <path
                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd"
                                    fill-rule="evenodd"
                                ></path>
                              </svg>
                            </span>
                        </li>
                    @endif
                </ul>
            </nav>
        </span>
    </div>
@endif
