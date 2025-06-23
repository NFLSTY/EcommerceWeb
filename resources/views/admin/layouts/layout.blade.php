<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title')</title>

    @vite(['resources/js/app.js', 'resources/sass/app.scss', 'resources/css/admin.css' 'resources/js/admin/js'])
</head>

<body>
    @include('admin.layouts.navbar')

    <main class="container mt-5">
        @yield('content')
    </main>
</body>

</html>