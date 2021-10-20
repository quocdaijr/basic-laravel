<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>@yield('title')</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
        rel="stylesheet"
    />
    @stack('stylesheets')
</head>
<body>
<nav class="navbar navbar-light sticky-top bg-primary flex-md-nowrap p-0 mb-3">
    <a class="navbar-brand col-sm-3 col-md-2 mr-0 text-white" href="/"> <img class="mr-2" src="/favicon.ico">{{config('app.name')}}</a>
</nav>
@yield('content')
@stack('scripts')
</body>
</html>
