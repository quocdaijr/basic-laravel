<!DOCTYPE html>
<html :class="{ 'dark': dark }" x-data="data()" lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>@yield('title')</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
        rel="stylesheet"
    />
    {{-- Laravel Mix - CSS File --}}
    <link rel="stylesheet" href="{{ mix('modules/core/css/core.css') }}">
    <link rel="stylesheet" href="{{ mix('modules/core/css/sweetalert-theme.css') }}">
    <link rel="stylesheet" href="{{ mix('modules/core/css/toastr.css') }}">
    @stack('stylesheets')
    {{-- Laravel Mix - Header JS File --}}
    <script src="{{ mix('modules/core/js/sweetalert.js') }}"></script>
    <script src="{{ mix('modules/core/js/toastr.js') }}"></script>
</head>
<body>
@yield('common')
@include('core::vendor.sweetalert.alert')

{{-- Laravel Mix - JS File --}}
<script src="{{ mix('modules/core/js/init.js') }}"></script>
<script src="{{ mix('modules/core/js/core.js') }}" defer></script>
@stack('scripts')
</body>
</html>

