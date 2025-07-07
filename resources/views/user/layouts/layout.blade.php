<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>

    @vite(['resources/js/app.js', 'resources/sass/app.scss', 'resources/css/user.css', 'resources/js/user.js'])
    @stack('styles')
</head>

<body>
    @include('user.layouts.navbar')

    @yield('content')

    @include('user.layouts.footer')
    
    @stack('scripts')
</body>

</html>