<?php
/**
 * @var \Maatwebsite\Sidebar\Item $item
*/
?>
@if($layout == \Modules\Core\Constants\CoreConstant::LAYOUT_PC)
    <li class="@if($item->getItemClass()){{ $item->getItemClass() }}@endif @if($active)text-gray-800 @endif px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
    >
        <a class="relative pl-2 w-full @if(count($appends) > 0) hasAppend @endif"
           href="{{ $item->getUrl() }}"
           @if($item->getNewTab())target="_blank"@endif>
            @if($active)
                <span
                    class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"
                    aria-hidden="true"
                ></span>
            @endif
            {{ $item->getName() }}
            @foreach($badges as $badge)
                {!! $badge !!}
            @endforeach
        </a>
        @foreach($appends as $append)
            {!! $append !!}
        @endforeach
    </li>
@else
@endif
