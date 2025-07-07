<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'E-commerce')</title>

    @vite(['resources/js/app.js', 'resources/sass/app.scss', 'resources/css/user.css', 'resources/js/user.js'])

    <!-- Custom CSS -->
    <style>
        .banner-tampilan {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 200px;
        }

        .cart-count {
            font-size: 0.75rem;
            min-width: 1.5rem;
            height: 1.5rem;
        }

        .add-to-cart-form .btn:hover {
            transform: translateY(-2px);
            transition: all 0.3s ease;
        }
    </style>

    @stack('styles')
</head>

<body>
    @include('user.layouts.navbar')

    @yield('content')

    @include('user.layouts.footer')

    <!-- jQuery (if needed) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    @stack('scripts')
</body>

</html>