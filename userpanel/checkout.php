<?php
session_start();
$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="../css/user.css">
</head>
<body>
<?php require "navbar.php" ?>
    <div class="container-fluid banner-tampilan d-flex align-items-center">
        <div class="container">
        <h1 class="text-white text-center">Checkout</h1>
    </div>
    </div>

<div class="container my-5">
    <h2 class="mb-4">Payment & Checkout</h2>

    <?php if (count($cart) > 0): ?>
    <form action="payment-process.php" method="POST">
        <div class="mb-3">
            <label for="nama" class="form-label">Nama Lengkap</label>
            <input type="text" class="form-control" id="nama" name="nama" required>
        </div>

        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat Pengiriman</label>
            <textarea class="form-control" id="alamat" name="alamat" rows="3" required></textarea>
        </div>

        <div class="mb-3">
            <label for="metode" class="form-label">Metode Pembayaran</label>
            <select class="form-select" id="metode" name="metode">
                <option value="transfer">Transfer Bank</option>
                <option value="cod">Bayar di Tempat (COD)</option>
                <option value="ewallet">E-Wallet</option>
            </select>
        </div>

        <h4>Total: Rp <?php echo number_format(array_sum(array_map(function($item) {
            return $item['harga'] * $item['qty'];
        }, $cart)), 0, ',', '.'); ?></h4>

        <button type="submit" class="btn btn-success mt-3">Bayar Sekarang</button>
    </form>
    <?php else: ?>
        <p>Cart kosong cuy, balik belanja dulu 😆</p>
    <?php endif; ?>
</div>
</body>
</html>
