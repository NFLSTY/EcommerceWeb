<?php
$user = [
    'profile_image' => '',
    'name' => 'Test User',
    'email' => 'testuser@example.com',
];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>ShopNow - My Profile</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="../css/user.css">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" /> -->
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f4f4f4;
            min-height: 100vh;
        }

        .container {
            max-width: 1200px;
            margin: 30px auto;
            padding: 0 20px;
        }

        .profile-header {
            background-color: white;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            gap: 30px;
        }

        .profile-pic {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            overflow: hidden;
            background-color: #ddd;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
        }

        .profile-pic img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .profile-pic .edit-icon {
            position: absolute;
            bottom: 0;
            right: 0;
            background-color: #4a90e2;
            color: white;
            width: 35px;
            height: 35px;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            font-size: 18px;
        }

        .profile-info {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .profile-info h2 {
            font-size: 24px;
            margin-bottom: 5px;
        }

        .profile-info p {
            color: #666;
            margin-bottom: 15px;
        }

        .edit-profile-btn {
            background-color: transparent;
            border: 1px solid #4a90e2;
            color: #4a90e2;
            padding: 8px 15px;
            border-radius: 5px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s;
            align-self: flex-start;
        }

        .edit-profile-btn:hover {
            background-color: #4a90e2;
            color: white;
        }

        .profile-content {
            margin-top: 30px;
            display: grid;
            grid-template-columns: 250px 1fr;
            gap: 30px;
        }

        .profile-sidebar {
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            height: fit-content;
        }

        .sidebar-menu {
            list-style: none;
        }

        .sidebar-menu li {
            margin-bottom: 10px;
        }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px;
            color: #333;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .sidebar-menu a:hover {
            background-color: #f4f4f4;
        }

        .sidebar-menu a.active {
            background-color: #e6f0ff;
            color: #4a90e2;
            font-weight: 500;
        }

        .sidebar-menu i {
            font-size: 20px;
        }

        .profile-main {
            background-color: white;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .section-title {
            font-size: 20px;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
        }

        .form-control {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }

        .form-control:focus {
            border-color: #4a90e2;
            outline: none;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .save-btn {
            background-color: #4a90e2;
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 5px;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .save-btn:hover {
            background-color: #3b7bd4;
        }

        .success-alert {
            padding: 12px;
            background-color: #d4edda;
            color: #155724;
            border-radius: 5px;
            margin-bottom: 20px;
            display: none;
        }

        .address-card {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 15px;
        }

        .address-card h4 {
            margin-bottom: 5px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .address-card p {
            color: #666;
            margin-bottom: 3px;
        }

        .address-actions {
            display: flex;
            gap: 15px;
            margin-top: 10px;
        }

        .address-actions button {
            background: none;
            border: none;
            color: #4a90e2;
            cursor: pointer;
            font-size: 14px;
            padding: 0;
        }

        .address-actions button:hover {
            text-decoration: underline;
        }

        .default-badge {
            background-color: #e6f0ff;
            color: #4a90e2;
            font-size: 12px;
            padding: 3px 8px;
            border-radius: 3px;
        }

        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
        }

        /* Modal styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            background-color: white;
            margin: 5% auto;
            padding: 30px;
            border-radius: 10px;
            width: 90%;
            max-width: 600px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }

        .close-modal {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .close-modal:hover {
            color: #333;
        }

        .modal-title {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .file-upload {
            margin-bottom: 20px;
        }

        .upload-btn {
            display: inline-block;
            background-color: #f4f4f4;
            border: 1px solid #ddd;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }

        .upload-btn:hover {
            background-color: #e6e6e6;
        }

        /* Hamburger menu for mobile */
        .hamburger {
            display: none;
            cursor: pointer;
            font-size: 24px;
        }

        /* Enhanced responsive adjustments */
        @media (max-width: 992px) {
            .profile-content {
                grid-template-columns: 1fr;
            }

            .profile-sidebar {
                margin-bottom: 20px;
            }
        }

        @media (max-width: 768px) {
            .navbar .menu {
                display: none;
                flex-direction: column;
                position: absolute;
                top: 60px;
                left: 0;
                right: 0;
                background-color: #4a90e2;
                padding: 10px 20px;
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
                z-index: 100;
            }

            .hamburger {
                display: block;
            }

            .profile-header {
                flex-direction: column;
                text-align: center;
                padding: 20px;
            }

            .edit-profile-btn {
                align-self: center;
            }

            .form-row {
                grid-template-columns: 1fr;
                gap: 10px;
            }

            .profile-main {
                padding: 20px;
            }

            .address-actions {
                flex-direction: column;
                gap: 10px;
                align-items: flex-start;
            }
        }

        @media (max-width: 480px) {
            .navbar .logo h1 {
                font-size: 20px;
            }

            .container {
                margin: 15px auto;
                padding: 0 15px;
            }

            .profile-pic {
                width: 100px;
                height: 100px;
            }

            .modal-content {
                padding: 20px;
                margin: 10% auto;
                width: 95%;
            }
        }
    </style>
</head>

<body>
    <?php require "navbar.php" ?>

    <div class="container">
        <div class="profile-header">
            <div class="profile-pic">
                <img src="<?= $user['profile_image'] ?: 'https://via.placeholder.com/120' ?>" alt="Profile Picture"
                    id="profile-image">
                <div class="edit-icon" id="edit-profile-pic">
                    <i class="fas fa-camera"></i>
                </div>
            </div>
            <div class="profile-info">
                <h2 id="user-name"><?= htmlspecialchars($user['name']) ?></h2>
                <p id="user-email"><?= htmlspecialchars($user['email']) ?></p>
                <a href="#"><button class="edit-profile-btn">Edit Profile</button></a>
            </div>
        </div>

        <div class="profile-content">
            <div class="profile-sidebar">
                <ul class="sidebar-menu">
                    <li><a href="#" class="active" data-tab="profile-tab"><i class="fas fa-user"></i> Personal
                            Information</a></li>
                    <li><a href="#" data-tab="orders-tab"><i class="fas fa-shopping-bag"></i> My Orders</a></li>
                    <li><a href="#" data-tab="wishlist-tab"><i class="fas fa-heart"></i> Wishlist</a></li>
                    <li><a href="#" data-tab="password-tab"><i class="fas fa-lock"></i> Change Password</a></li>
                    <li><a href="#" data-tab="notification-tab"><i class="fas fa-bell"></i> Notifications</a></li>
                    <li><a href="login.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                </ul>
            </div>
            <div class="profile-main">
                <div class="section-title">Account Information</div>
                <div class="form-group">
                    <label>Full Name</label>
                    <input class="form-control" type="text" value="<?= htmlspecialchars($user['name']) ?>" readonly>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input class="form-control" type="email" value="<?= htmlspecialchars($user['email']) ?>" readonly>
                </div>
                <div class="form-group">
                    <label>Phone</label>
                    <input class="form-control" type="text" value="<?= htmlspecialchars($user['phone'] ?? '-') ?>"
                        readonly>
                </div>
            </div>
        </div>
    </div>

    <?php require "footer.html" ?>

    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../fontawesome/js/all.min.js"></script>
    <script src="../js/user.js"></script>

</body>

</html>