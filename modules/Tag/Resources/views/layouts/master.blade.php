@extends('core::layouts.common')

@section('master')
    <main class="h-full overflow-y-auto">
        <div class="container mx-auto grid">
            @if (Breadcrumbs::exists(Route::currentRouteName()))
                {!! Breadcrumbs::render(Route::currentRouteName(), $tag ?? null ) !!}
            @endif
            <h2 class="my-3 text-2xl font-semibold text-gray-700 dark:text-gray-200">@yield('title')</h2>
            @yield('content')
        </div>
    </main>
@stop
