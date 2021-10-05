<?php
/**
 * @var \Maatwebsite\Sidebar\Group $group
 */
?>
@if($group->shouldShowHeading())
    <li class="menu-title">{{ $group->getName() }}</li>
@endif

@foreach($items as $item)
    {!! $item !!}
@endforeach
