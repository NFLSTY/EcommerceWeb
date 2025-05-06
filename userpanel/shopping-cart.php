<?php
session_start();

// Dummy cart buat testing frontend doang
$cart = [
    [
        'foto' => 'monitor.jpeg',
        'nama' => 'Monitor ASUS 24 Inch',
        'harga' => 1500000,
        'qty' => 2
    ],
    [
        'foto' => 'pc.jpeg',
        'nama' => 'PC Gaming Ryzen 5',
        'harga' => 5500000,
        'qty' => 1
    ]
];

// Buat nyimpen dummy ke session (opsional aja buat persist pas refresh)
$_SESSION['cart'] = $cart;
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Shopping Cart</title>
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css">
  <link rel="stylesheet" href="../css/user.css">
</head>
<body>
  <?php require "navbar.php" ?>
  <div class="container-fluid banner-tampilan d-flex align-items-center">
    <div class="container">
      <h1 class="text-white text-center">Shopping Cart</h1>
    </div>
  </div>

  <div class="container my-5">
    <h2 class="mb-4">Your Shopping Cart</h2>
    <?php if (count($cart) > 0): ?>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Foto</th>
            <th>Nama Produk</th>
            <th>Harga</th>
            <th>Qty</th>
            <th>Total</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $grandTotal = 0;
          foreach ($cart as $item):
              $total = $item['harga'] * $item['qty'];
              $grandTotal += $total;
          ?>
          <tr>
            <td><img src="../image/<?php echo $item['foto'] ?>" width="80"></td>
            <td><?php echo $item['nama'] ?></td>
            <td>Rp <?php echo number_format($item['harga'], 0, ',', '.') ?></td>
            <td><?php echo $item['qty'] ?></td>
            <td>Rp <?php echo number_format($total, 0, ',', '.') ?></td>
          </tr>
          <?php endforeach; ?>
          <tr>
            <td colspan="4"><strong>Total Semua</strong></td>
            <td><strong>Rp <?php echo number_format($grandTotal, 0, ',', '.') ?></strong></td>
          </tr>
        </tbody>
      </table>
      <div class="text-end mt-3">
        <a href="checkout.php" class="btn btn-primary">Checkout</a>
      </div>
    <?php else: ?>
      <p>Your cart is empty</p>
    <?php endif; ?>
  </div>
</body>
</html>
