<?php
session_start();
require "../koneksi.php";

$queryKategori = mysqli_query($conn, "SELECT * FROM kategori");

// Store search history in session
if (isset($_GET['keyword'])) {
    $keyword = $_GET['keyword'];
    if (!isset($_SESSION['search_history'])) {
        $_SESSION['search_history'] = [];
    }
    // Add keyword to search history if not already present
    if (!in_array($keyword, $_SESSION['search_history'])) {
        array_unshift($_SESSION['search_history'], $keyword);
        // Limit history to last 10 searches
        if (count($_SESSION['search_history']) > 10) {
            array_pop($_SESSION['search_history']);
        }
    }
    $queryProduk = mysqli_query($conn, "SELECT * FROM produk WHERE nama LIKE '%$keyword%'");
} elseif (isset($_GET['kategori'])) {
    $queryGetKategori = mysqli_query($conn, "SELECT id_kategori FROM kategori WHERE nama='$_GET[kategori]'");
    $kategoriId = mysqli_fetch_array($queryGetKategori);
    $queryProduk = mysqli_query($conn, "SELECT * FROM produk WHERE kategori_id='$kategoriId[id_kategori]'");
} else {
    $queryProduk = mysqli_query($conn, "SELECT * FROM produk");
}

$countData = mysqli_num_rows($queryProduk); 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Online | Produk</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="../css/user.css">
</head>

<body>
    <?php require "navbar.php" ?>
    <div class="container-fluid banner-tampilan d-flex align-items-center">
        <div class="container">
            <h1 class="text-white text-center">Produk</h1>
        </div>
    </div>

    <div class="container py-5">
        <div class="row">
            <div class="col-lg-3 mb-5">
                <h3>Kategori</h3>
                <ul class="list-group">
                    <?php while ($kategori = mysqli_fetch_array($queryKategori)) { ?>
                        <a class="no-decoration" href="produk.php?kategori=<?php echo $kategori['nama'] ?>">
                            <li class="list-group-item"><?php echo $kategori['nama'] ?></li>
                        </a>
                    <?php } ?>
                </ul>
            </div>
            
            <div class="col-lg-9">
                <h3 class="text-center mb-4">Produk</h3>
                <div class="row">
                    <?php
                        if ($countData < 1) {
                            ?>
                            <h4 class="text-center my-5">Produk tidak tersedia!</h4>
                            <?php
                        }
                    ?>
                    <?php while ($produk = mysqli_fetch_array($queryProduk)) { ?>
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            <div class="image-box">
                                <img class="card-img-top" src="../image/<?php echo $produk['foto'] ?>" alt="Card image cap">
                            </div>
                            <div class="card-body">
                                <h4 class="card-title"><?php echo $produk['nama'] ?></h4>
                                <p class="card-text text-truncate"><?php echo $produk['detail'] ?></p>
                                <p class="card-text text-harga">Rp <?php echo $produk['harga'] ?></p>
                                <a href="produk-detail.php?nama=<?php echo $produk['nama'] ?>" class="btn button">Lihat Detail</a>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../fontawesome/js/all.min.js"></script>
</body>

</html>