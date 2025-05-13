<?php
session_start();

// Data dummy
$dummyEmail = 'test@example.com';
$dummyPassword = '123456';

$error = '';

// Handle form submit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Cek dengan data dummy
    if ($email === $dummyEmail && $password === $dummyPassword) {
        $_SESSION['login'] = true;
        $_SESSION['email'] = $email;
        header('Location: profile.php'); 
        exit;
    } else {
        $error = 'Email atau password salah';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Dummy</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
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

        .btn {
            background-color: #4a90e2;
            color: white;
            font-weight: 600;
        }

        .btn:hover {
            background-color: #3b7bd4;
        }

        .alert {
            padding: 10px;
            background-color: #f8d7da;
            color: #721c24;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .register-link {
            text-align: center;
            margin-top: 20px;
        }

        .register-link a {
            color: #4a90e2;
            text-decoration: none;
        }

        .register-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo">
            <h1>Login Page</h1>
        </div>
        <div class="title">
            <h2>Login</h2>
        </div>

        <?php if ($error != '') { ?>
            <div class="alert"><?php echo $error; ?></div>
        <?php } ?>

        <form method="POST" action="">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
            </div>
            <div class="mb-3 text-end">
                <a href="#">Forgot password?</a>
            </div>
            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>

        <div class="register-link mt-3">
            Does not have an account?? <a href="register.php">Register First</a>
        </div>
    </div>

    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
