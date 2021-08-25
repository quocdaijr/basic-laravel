<?php
/**
 * @var \Maatwebsite\Sidebar\Item $item
 */
?>

@if($layout == \Modules\Core\Constants\CoreConstant::LAYOUT_PC)
    <li class="relative px-6 py-2 @if($item->getItemClass()){{ $item->getItemClass() }}@endif">
        @if(!$item->hasItems())
            <a
                class="relative pl-2 inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200
                @if(count($appends) > 0) hasAppend @endif
                @if($active) text-gray-800 dark:text-gray-100 @endif
                    "
                href="{{ $item->getUrl() }}"
                @if($item->getNewTab())target="_blank"@endif
            >
                @if($active)
                    <span
                        class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"
                        aria-hidden="true"
                    ></span>
                @endif
                @if($item->getIcon() !== 'fa fa-angle-double-right')
                    {!! $item->getIcon() !!}
                @else
                    <svg
                        class="w-5 h-5"
                        aria-hidden="true"
                        fill="none"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"
                        ></path>
                    </svg>
                @endif
                <span class="ml-4">{{ $item->getName() }}</span>
                @foreach($badges as $badge)
                    {!! $badge !!}
                @endforeach
            </a>
            @foreach($appends as $append)
                {!! $append !!}
            @endforeach
        @else
            <button
                class="relative pl-2 inline-flex items-center justify-between w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200
                @if(count($appends) > 0) hasAppend @endif
                @if($active) text-gray-800 dark:text-gray-100 @endif
                    "
                @click="toggleMenu('{{$item->getName() . '-' . $item->getUrl()}}')"
                @if($active) x-init="toggleMenu('{{$item->getName() . '-' . $item->getUrl()}}')" @endif
                aria-haspopup="true"
            >
                @if($active)
                    <span
                        class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"
                        aria-hidden="true"
                    ></span>
                @endif

                <span class="inline-flex items-center">
                    @if($item->getIcon() !== 'fa fa-angle-double-right')
                    {!! $item->getIcon() !!}
                    @else
                        <svg
                            class="w-5 h-5"
                            aria-hidden="true"
                            fill="none"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                    <path
                        d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"
                    ></path>
                    </svg>
                    @endif
                  <span class="ml-4">{{ $item->getName() }}</span>
                    @foreach($badges as $badge)
                        {!! $badge !!}
                    @endforeach
                </span>
                @if($item->hasItems())
                    <svg
                        class="w-4 h-4"
                        aria-hidden="true"
                        fill="currentColor"
                        viewBox="0 0 20 20"
                    >
                        <path
                            fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd"
                        ></path>
                    </svg>
                @endif
                @foreach($appends as $append)
                    {!! $append !!}
                @endforeach
            </button>
            @if(count($items) > 0)

                <template x-if="(menuName==='{{$item->getName() . '-' . $item->getUrl()}}'&&isMenuOpen)">
                    <ul
                        x-transition:enter="transition-all ease-in-out duration-300"
                        x-transition:enter-start="opacity-25 max-h-0"
                        x-transition:enter-end="opacity-100 max-h-xl"
                        x-transition:leave="transition-all ease-in-out duration-300"
                        x-transition:leave-start="opacity-100 max-h-xl"
                        x-transition:leave-end="opacity-0 max-h-0"
                        class="p-2 mt-2 space-y-2 overflow-hidden text-sm font-medium text-gray-500 rounded-md shadow-inner bg-gray-50 dark:text-gray-400 dark:bg-gray-900"
                        aria-label="submenu"
                    >
                        @foreach($items as $item)
                            {!! $item !!}
                        @endforeach
                    </ul>
                </template>
            @endif
        @endif
    </li>
@else
    <li class="relative px-6 py-3" @if($item->getItemClass()){{ $item->getItemClass() }}@endif">
    @if(!$item->hasItems())
        <a
            class="relative pl-2 inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200
            @if(count($appends) > 0) hasAppend @endif
            @if($active) text-gray-800 dark:text-gray-100 @endif
                "
            href="{{ $item->getUrl() }}"
        >
            @if($active)
                <span
                    class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"
                    aria-hidden="true"
                ></span>
            @endif
            @if($item->getIcon() !== 'fa fa-angle-double-right')
                {!! $item->getIcon() !!}
            @else
                <svg
                    class="w-5 h-5"
                    aria-hidden="true"
                    fill="none"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                >
                    <path
                        d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"
                    ></path>
                </svg>
            @endif
            <span class="ml-4">{{ $item->getName() }}</span>
            @foreach($badges as $badge)
                {!! $badge !!}
            @endforeach
        </a>
        @foreach($appends as $append)
            {!! $append !!}
        @endforeach
    @else
        <button
            class="relative pl-2 inline-flex items-center justify-between w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200
            @if(count($appends) > 0) hasAppend @endif
            @if($active) text-gray-800 dark:text-gray-100 @endif
                "
            @click="toggleMenu('{{$item->getName() . '-' . $item->getUrl()}}', true)"
            {{--Layout PC already detect open menu or not--}}
{{--            @if($active) x-init="toggleMenu('{{$item->getName() . '-' . $item->getUrl()}}', true)" @endif--}}
            aria-haspopup="true"
        >
            @if($active)
                <span
                    class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"
                    aria-hidden="true"
                ></span>
            @endif
            <span class="inline-flex items-center">
                @if($item->getIcon() !== 'fa fa-angle-double-right')
                    {!! $item->getIcon() !!}
                @else
                    <svg
                        class="w-5 h-5"
                        aria-hidden="true"
                        fill="none"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                    <path
                        d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"
                    ></path>
                  </svg>
                @endif
              <span class="ml-4">{{ $item->getName() }}</span>
            </span>
            @if($item->hasItems())
                <svg
                    class="w-4 h-4"
                    aria-hidden="true"
                    fill="currentColor"
                    viewBox="0 0 20 20"
                >
                    <path
                        fill-rule="evenodd"
                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                        clip-rule="evenodd"
                    ></path>
                </svg>
            @endif
            @foreach($appends as $append)
                {!! $append !!}
            @endforeach
        </button>
        @if(count($items) > 0)
            <template x-if="(menuName==='{{$item->getName() . '-' . $item->getUrl()}}'&&isMenuOpen)">
                <ul
                    x-transition:enter="transition-all ease-in-out duration-300"
                    x-transition:enter-start="opacity-25 max-h-0"
                    x-transition:enter-end="opacity-100 max-h-xl"
                    x-transition:leave="transition-all ease-in-out duration-300"
                    x-transition:leave-start="opacity-100 max-h-xl"
                    x-transition:leave-end="opacity-0 max-h-0"
                    class="p-2 mt-2 space-y-2 overflow-hidden text-sm font-medium text-gray-500 rounded-md shadow-inner bg-gray-50 dark:text-gray-400 dark:bg-gray-900"
                    aria-label="submenu"
                >
                    @foreach($items as $item)
                        {!! $item !!}
                    @endforeach
                </ul>
            </template>
        @endif
    @endif
    </li>
@endif
