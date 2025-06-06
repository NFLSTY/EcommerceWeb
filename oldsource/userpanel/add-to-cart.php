<?php
session_start();
require "../connection.php";

$product_id = $_GET['product_id'];

$query = mysqli_query($conn, "SELECT * FROM products WHERE product_id='$product_id'");
$products = mysqli_fetch_assoc($query);

$item = [
    'product_id' => $products['product_id'],
    'product_name' => $products['product_name'],
    'price' => $products['price'],
    'qty' => 1,
    'product_image' => $products['product_image']
];

// Cek kalo cart belum ada
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Cek products udah ada di cart atau belum
$found = false;
foreach ($_SESSION['cart'] as $key => $cartItem) {
    if ($cartItem['product_id'] == $product_id) {
        $_SESSION['cart'][$key]['qty'] += 1;
        $found = true;
        break;
    }
}

if (!$found) {
    $_SESSION['cart'][] = $item;
}

header('Location: shopping-cart.php');
