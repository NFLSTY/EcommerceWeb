<?php
session_start();
require "../koneksi.php";

$id = $_GET['id'];

$query = mysqli_query($conn, "SELECT * FROM produk WHERE id='$id'");
$produk = mysqli_fetch_assoc($query);

$item = [
    'id' => $produk['id'],
    'nama' => $produk['nama'],
    'harga' => $produk['harga'],
    'qty' => 1,
    'foto' => $produk['foto']
];

// Cek kalo cart belum ada
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Cek produk udah ada di cart atau belum
$found = false;
foreach ($_SESSION['cart'] as $key => $cartItem) {
    if ($cartItem['id'] == $id) {
        $_SESSION['cart'][$key]['qty'] += 1;
        $found = true;
        break;
    }
}

if (!$found) {
    $_SESSION['cart'][] = $item;
}

header('Location: shopping-cart.php');
