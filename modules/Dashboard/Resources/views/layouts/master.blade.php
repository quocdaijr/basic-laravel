@extends('core::layouts.common')

@section('master')
    <main class="h-full overflow-y-auto">
        <div class="container mx-auto grid h-full">
            @yield('content')
        </div>
    </main>
@stop
