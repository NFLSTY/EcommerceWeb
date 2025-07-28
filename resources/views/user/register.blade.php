<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShopNow - Register</title>
    @vite(['resources/js/app.js', 'resources/sass/app.scss', 'resources/css/user.css', 'resources/js/user.js'])

    <style>
        body {
            background-color: #f4f4f4;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 15px;
        }

        .container {
            max-width: 400px;
            width: 100%;
            padding: 40px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .logo h1 {
            color: #4a90e2;
            font-size: 28px;
            text-align: center;
        }

        .title h2 {
            color: #333;
            font-size: 24px;
            text-align: center;
            margin-bottom: 20px;
        }

        .form-control {
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }

        .btn-primary {
            background-color: #4a90e2;
            border-color: #4a90e2;
            color: white;
            font-weight: 600;
            padding: 12px;
        }

        .btn-primary:hover {
            background-color: #3b7bd4;
            border-color: #3b7bd4;
        }

        .alert-danger {
            padding: 15px;
            background-color: #f8d7da;
            color: #721c24;
            border-radius: 5px;
            margin-bottom: 20px;
            border: 1px solid #f5c6cb;
        }
        
        .alert-success {
             padding: 15px;
             background-color: #d4edda;
             color: #155724;
             border-color: #c3e6cb;
             border-radius: .25rem;
             margin-bottom: 20px;
        }

        .login-link {
            text-align: center;
            margin-top: 20px;
        }

        .login-link a {
            color: #4a90e2;
            text-decoration: none;
        }

        .login-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    @include('user.layouts.navbar')

    <div class="container">
        <div class="logo">
            <h1>Registration Page</h1>
        </div>
        <div class="title">
            <h2>Create New Account</h2>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Full Name</label>
                <input type="text" name="name" id="name"
                    class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}"
                    required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror"
                    value="{{ old('email') }}" required>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">Phone Number</label>
                <input type="tel" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror"
                    value="{{ old('phone') }}" required>
                @error('phone')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" name="username" id="username"
                    class="form-control @error('username') is-invalid @enderror" value="{{ old('username') }}" required>
                @error('username')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password"
                    class="form-control @error('password') is-invalid @enderror" required>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation"
                    class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">Register</button>
        </form>

        <div class="login-link">
            Already have an account? <a href="{{ route('login') }}">Login here</a>
        </div>
    </div>

    {{-- @include('user.layouts.footer') --}}
</body>

</html>
