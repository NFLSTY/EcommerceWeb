<?php
session_start();
require "../connection.php";

$login_user = $password = "";
$login_user_err = $password_err = $login_err = $acc_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate username
    if (empty(trim($_POST["login_user"]))) {
        $login_user_err = "Please enter your username or email.";
    } else {
        $login_user = trim($_POST["login_user"]);
    }

    // Validate password
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter your password.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Check credentials (first users, then admins)
    if (empty($login_user_err) && empty($password_err)) {
        $username_found = null;
        $sql = "SELECT user_id, username, password_hash FROM users WHERE username = ? OR email = ?";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("ss", $param_login_user, $param_login_user);
            $param_login_user = $login_user;
            if ($stmt->execute()) {
                $stmt->store_result();
                if ($stmt->num_rows == 1) {
                    $stmt->bind_result($id, $username_found, $hashed_password);
                    $stmt->fetch();

                    if (password_verify($password, $hashed_password)) {
                        session_regenerate_id(); // Prevent session fixation attacks
                        $_SESSION["loginuser"] = true;
                        $_SESSION["id"] = $id;
                        $_SESSION["username"] = $username_found;
                        $_SESSION["role"] = "user";

                        header("location: user-dashboard.php");
                        exit;
                    } else {
                        $login_err = "Invalid username/email or password.";
                    }
                } else {
                    $acc_err = "Account not found.";
                }
            }
            $stmt->close();
        }
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
            <h1>Gaming House</h1>
        </div>
        <div class="title">
            <h2>Login</h2>
        </div>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <div class="mb-3">
                <label>Username or Email</label>
                <input type="text" name="login_user" class="form-control" autocomplete="given-name">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <div class="mb-3 text-end">
                <a href="#">Forgot password?</a>
            </div>
            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>

        <div class="register-link mt-3">
            Don't have an account? <a href="register.php">Register Now!</a>
        </div>
    </div>

    <div class="mt-3" style="width: 500px">
        <?php if (!empty($login_user_err)): ?>
            <div class="p-3 mb-2 bg-danger text-white mt-3"><?php echo $login_user_err; ?></div>
        <?php elseif (!empty($acc_err)): ?>
            <div class="p-3 mb-2 bg-warning text-dark mt-3"><?php echo $acc_err; ?></div>
        <?php endif; ?>
    </div>

    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>