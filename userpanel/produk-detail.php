<?php
require "../koneksi.php";

$nama = htmlspecialchars($_GET['nama']);
$queryProduk = mysqli_query($conn, "SELECT * FROM produk WHERE nama='$nama'");
$produk = mysqli_fetch_array($queryProduk);
$queryTerkait = mysqli_query($conn, "SELECT * FROM produk WHERE kategori_id='$produk[kategori_id]' 
AND id_produk != '$produk[id_produk]' LIMIT 4");
$produkTerkait = mysqli_fetch_array($queryTerkait);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Online | Detail Produk</title>
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
                    <img class="image-box" src="../image/<?php echo $produk['foto']?>">
                </div>
                <div class="col-lg-6 offset-lg-1">
                    <h1><?php echo $produk['nama']?></h1>
                    <p class="fs-5"><?php echo $produk['detail']?></p></p>
                    <p class="text-harga">Rp <?php echo $produk['harga']?></p>
                    <p class="fs-5">Status Stok: <strong><?php echo $produk['stok']?></strong></p>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid py-5 warna2">
        <div class="container">
            <h2 class="text-center text-white mb-5">Produk Terkait</h2>
            <div class="row">
                <?php while ($data = mysqli_fetch_array($queryTerkait)) {?>
                <div class="col-md-6 col-lg-3 mb-3">
                    <a href="produk-detail.php?nama=<?php echo $data['nama']?>">
                        <img src="../image/<?php echo $data['foto']?>">
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