<?php
require "../koneksi.php";

$name = htmlspecialchars($_GET['name']);
$queryProduct = mysqli_query($conn, "SELECT * FROM product WHERE name='$name'");
$product = mysqli_fetch_array($queryProduct);
$queryRelated = mysqli_query($conn, "SELECT * FROM product WHERE category_id='$product[category_id]' 
AND product_id != '$product[product_id]' LIMIT 4");
$relatedProduct = mysqli_fetch_array($queryRelated);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Online | Detail product</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="../css/user.css">
</head>
<body>
    <?php require "navbar.php"?>
    <div class="container-fluid py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 mb-4">
                    <img class="image-box" src="../image/<?php echo $product['image_url']?>">
                </div>
                <div class="col-lg-6 offset-lg-1">
                    <h1><?php echo $product['name']?></h1>
                    <p class="fs-5"><?php echo $product['detail']?></p></p>
                    <p class="text-harga">Rp <?php echo $product['price']?></p>
                    <p class="fs-5">Stock Status: <strong><?php echo $product['stock']?></strong></p>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid py-5 warna2">
        <div class="container">
            <h2 class="text-center text-white mb-5">Related Product</h2>
            <div class="row">
                <?php while ($data = mysqli_fetch_array($queryRelated)) {?>
                <div class="col-md-6 col-lg-3 mb-3">
                    <a href="product-detail.php?name=<?php echo $data['name']?>">
                        <img src="../image/<?php echo $data['image_url']?>">
                    </a>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../fontawesome/js/all.min.js"></script>
</body>
</html>