<?php
session_start();
require "../connection.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/admin.css">
</head>

<body>
    <div class="login d-flex flex-column justify-content-center align-items-center">
        <h1 class="text-black text-center p-3">Shop Dashboard</h1>
        <div class="login-box shadow p-5">
            <form action="" method="post">
                <div>
                    <label for="username">Username</label>
                    <input type="text" class="form-control" name="username" id="username" autocomplete="given-name">
                </div>
                <div class="mt-2">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" id="password">
                </div>
                <div>
                    <button class="btn btn-success form-control mt-4" type="submit" name="loginbtn">Login</button>
                </div>
            </form>
        </div>

        <div class="mt-3" style="width: 500px">
            <?php
            if (isset($_POST['loginbtn'])) {
                $username = htmlspecialchars($_POST['username']);
                $password = htmlspecialchars($_POST['password']);

                $query = mysqli_query($conn, "SELECT * FROM users WHERE user_name='$username'");
                $countdata = mysqli_num_rows($query);
                $data = mysqli_fetch_array($query);

                if ($countdata > 0) {
                    if (password_verify($password, $data['user_password'])) { // password: admin
                        $_SESSION['username'] = $data['username'];
                        $_SESSION['login'] = true;
                        header('location: index.php'); 
                    } else {
                        ?>
                        <div class="p-3 mb-2 bg-danger text-white mt-3">Wrong Username or Password!</div>
                        <?php
                    }
                } else {
                    ?>
                    <div class="p-3 mb-2 bg-warning text-dark mt-3">Account not found!</div>
                    <?php
                }
            }
            ?>
        </div>
    </div>
</body>

</html>