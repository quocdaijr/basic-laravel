@extends('core::layouts.base')

@section('common')
    <div class="flex h-screen bg-gray-50 dark:bg-gray-900" :class="{ 'overflow-hidden': isSideMenuOpen }">
        @if(Auth::guest())
            <div class="flex flex-col flex-1 w-full">
                @yield('master')
            </div>
        @else
            @include('core::partials.sidebar')
            <div class="flex flex-col flex-1 w-full">
                @include('core::partials.header')
                @yield('master')
            </div>
        @endif
    </div>
@stop
