<?php
session_start();
require "../connection.php";

// Check if user is logged in
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    header("Location: login.php");
    exit;
}

// For dummy login, user_id is not set, so we skip using it
// $user_id = $_SESSION['user_id'];

// Dummy purchase history data for interface demonstration
$dummyPurchases = [
    [
        'purchase_date' => '2024-04-01 14:30:00',
        'product_name' => 'AMD Ryzen 7 5800X',
        'quantity' => 1,
        'total_price' => 4650000
    ],
    [
        'purchase_date' => '2024-04-10 10:15:00',
        'product_name' => 'Logitech G Pro X Gaming Headset',
        'quantity' => 2,
        'total_price' => 3198000
    ],
    [
        'purchase_date' => '2024-04-15 16:45:00',
        'product_name' => 'Dell XPS 15 (2023)',
        'quantity' => 1,
        'total_price' => 30499000
    ]
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Purchase History</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css" />
    <link rel="stylesheet" href="../css/user.css" />
</head>
<body>
    <?php require "navbar.php"; ?>

    <main class="container my-4">
        <h2>Purchase History</h2>
        <?php if (count($dummyPurchases) > 0): ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Purchase Date</th>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Total Price</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($dummyPurchases as $purchase): ?>
                        <tr>
                            <td><?php echo date("F j, Y, g:i a", strtotime($purchase['purchase_date'])); ?></td>
                            <td><?php echo htmlspecialchars($purchase['product_name']); ?></td>
                            <td><?php echo $purchase['quantity']; ?></td>
                            <td>Rp <?php echo number_format($purchase['total_price'], 0, ',', '.'); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No purchase history available.</p>
        <?php endif; ?>
    </main>

    <?php require "footer.html"; ?>

    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../fontawesome/js/all.min.js"></script>
</body>
</html>
