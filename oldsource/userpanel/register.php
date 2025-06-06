<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShopNow - Register</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
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
            <h1>Registration Page</h1>
        </div>
        <div class="title">
            <h2>Create New Account</h2>
        </div>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $firstName = $_POST["first_name"];
            $lastName = $_POST["last_name"];
            $email = $_POST["email"];
            $phone = $_POST["phone"];
            $password = $_POST["password"];
            $confirmPassword = $_POST["confirm_password"];

            if (strlen($password) < 8) {
                echo "<div class='alert'>Password must be at least 8 characters long!</div>";
            } elseif ($password !== $confirmPassword) {
                echo "<div class='alert'>Password and confirmation password do not match!</div>";
            } else {
                // Simpan data ke file atau database (buat demo kita simpan ke file JSON)
                $data = [
                    "first_name" => $firstName,
                    "last_name" => $lastName,
                    "email" => $email,
                    "phone" => $phone,
                    "password" => password_hash($password, PASSWORD_DEFAULT)
                ];
                $json = json_encode($data, JSON_PRETTY_PRINT);
                file_put_contents("user_data.json", $json);

                echo "<div class='alert alert-success'>Registration successful! <a href='login.php'>Click here to login</a></div>";
            }
        }
        ?>

        <form method="POST" action="">
            <div class="mb-3">
                <label for="first_name" class="form-label">First Name</label>
                <input type="text" name="first_name" id="first_name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="last_name" class="form-label">Last Name</label>
                <input type="text" name="last_name" id="last_name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone Number</label>
                <input type="tel" name="phone" id="phone" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="confirm_password" class="form-label">Confirm Password</label>
                <input type="password" name="confirm_password" id="confirm_password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Register</button>
        </form>

        <div class="register-link">
            Already have an account? <a href="login.php">Login here</a>
        </div>
    </div>

</body>
</html>
