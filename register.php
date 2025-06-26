<?php
session_start();
require "../connection.php";

$username = $password = $name = $email = $phone_number = "";
$username_err = $password_err = $email_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate username
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter a username.";
    } else {
        // Prepare a select statement to check if username already exists
        $sql = "SELECT user_id FROM users WHERE username = ?";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("s", $param_username);
            $param_username = trim($_POST["username"]);
            if ($stmt->execute()) {
                $stmt->store_result();
                if ($stmt->num_rows == 1) {
                    $username_err = "This username is already taken.";
                } else {
                    $username = trim($_POST["username"]);
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
            $stmt->close();
        }
    }

    // Validate password
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter a password.";
    } elseif (strlen(trim($_POST["password"])) < 8) {
        $password_err = "Password must have at least 8 characters.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate email
    if (!empty(trim($_POST["email"]))) {
        if (!filter_var(trim($_POST["email"]), FILTER_VALIDATE_EMAIL)) {
            $email_err = "Invalid email format.";
        } else {
            $sql = "SELECT user_id FROM users WHERE email = ?";
            if ($stmt = $conn->prepare($sql)) {
                $stmt->bind_param("s", $param_email);
                $param_email = trim($_POST["email"]);
                if ($stmt->execute()) {
                    $stmt->store_result();
                    if ($stmt->num_rows == 1) {
                        $email_err = "This email is already registered.";
                    }
                } else {
                    echo "Oops! Something went wrong. Please try again later.";
                }
                $stmt->close();
            }
            $email = trim($_POST["email"]);
        }
    }

    // Check input errors before inserting into database
    if (empty($username_err) && empty($password_err) && empty($email_err)) {

        // Prepare an insert statement
        $sql = "INSERT INTO users (username, password_hash, name, email, phone_number) VALUES (?, ?, ?, ?, ?)";

        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("sssss", $param_username, $param_password_hash, $param_name, $param_email, $param_phone);

            // Set parameters
            $param_username = $username;
            $param_password_hash = password_hash($password, PASSWORD_DEFAULT); // Hash the password
            $param_name = trim($_POST["name"]); 
            $param_email = trim($_POST["email"]);
            $param_phone = trim($_POST["phone"]);

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                header("location: login-user.php"); // Redirect to login page
            } else {
                echo "Something went wrong. Please try again later.";
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

        .error { color: red; }
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

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>" required>
                <span class="error"><?php echo $username_err; ?></span>
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>
                <span class="error"><?php echo $password_err; ?></span>
            </div>
            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" name="name" class="form-control" value="<?php echo htmlspecialchars($_POST['name'] ?? ''); ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>" required>
                <span class="error"><?php echo $email_err; ?></span>
            </div>
            <div class="mb-3">
                <label class="form-label">Phone Number</label>
                <input type="text" name="phone_number" class="form-control" value="<?php echo htmlspecialchars($_POST['phone'] ?? ''); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Register</button>
        </form>

        <div class="register-link">
            Already have an account? <a href="login-user.php">Login here</a>
        </div>
    </div>

</body>

</html>