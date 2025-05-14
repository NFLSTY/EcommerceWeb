<?php
session_start();
require "../koneksi.php";
$queryProduk = mysqli_query($conn, "SELECT id_produk, nama, harga, foto, detail FROM produk LIMIT 6");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Shop | Home</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="../css/user.css">

</head>

<body>
    <?php require "navbar.html"?>

    <!-- Carousel -->
    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="..\image\banner\Banner-Slider-Home-banner-1742015338.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="..\image\banner\Banner-Slider-Home-Casing-CG-Cinema-Athos-1744711639.jpg"
                    class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="..\image\banner\Banner-Slider-Home-Cooler-Anima-1745993994.jpg" class="d-block w-100"
                    alt="...">
            </div>
            <div class="carousel-item">
                <img src="..\image\banner\Banner-Slider-Home-Cooler-galahad-1746179641.jpg" class="d-block w-100"
                    alt="...">
            </div>
            <div class="carousel-item">
                <img src="..\image\banner\Banner-Slider-Home-PSU-1stplayer-ngdp-1746154754.jpg" class="d-block w-100"
                    alt="...">
            </div>
            <div class="carousel-item">
                <img src="..\image\banner\Banner-Slider-Home-PSU-bequiet-pure-power-1744711720.jpg"
                    class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <!-- Categories -->
    <div class="container-fluid py-5">
        <div class="container">
            <h2 style="margin-top: -10px; margin-bottom: -20px">Categories</h2>

            <div class="row mt-5">
                <div class="col-md-3">
                    <a class="no-decoration" href="produk.php?kategori=pc">
                        <div class="highlight card-template d-flex justify-content-center align-items-center"
                            style="--bg-image: url('../image/categories/pc_components.jpg');">
                        </div>
                        <div class="category-text">
                            <h5>PC Components <span class="arrow">→</span></h5>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a class="no-decoration" href="produk.php?kategori=pc">
                        <div class="highlight card-template d-flex justify-content-center align-items-center"
                            style="--bg-image: url('../image/categories/peripherals.jpeg');">
                        </div>
                        <div class="category-text">
                            <h5>Peripherals <span class="arrow">→</span></h5>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a class="no-decoration" href="produk.php?kategori=pc">
                        <div class="highlight card-template d-flex justify-content-center align-items-center"
                            style="--bg-image: url('../image/categories/laptops_and_desktops.jpg');">
                        </div>
                        <div class="category-text">
                            <h5>Laptops and Desktops <span class="arrow">→</span></h5>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a class="no-decoration" href="produk.php?kategori=pc">
                        <div class="highlight card-template d-flex justify-content-center align-items-center"
                            style="--bg-image: url('../image/categories/accessories.jpg');">
                        </div>
                        <div class="category-text">
                            <h5>Accesories <span class="arrow">→</span></h5>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid py-5">
        <div class="container">
            <h4>Products</h4>
            <div class="row m-5">
                <?php while ($data = mysqli_fetch_array($queryProduk)) { ?>
                    <div class="col-sm-6 col-md-4 mb-3">
                        <div class="card-template" style="--bg-image: url('../image/<?php echo $data['foto'] ?>')">
                        </div>
                        <div class="product-text">
                            <h5><?php echo $data['nama'] ?></h5>
                            <p class="price-text">Rp<?php echo $data['harga'] ?></p>
                            <a href="produk-detail.php?nama=<?php echo $data['nama'] ?>" class="btn button">Lihat
                                Detail</a>
                        </div>
                    </div>
                <?php } ?>
            </div>

            <a class="btn btn-outline-primary mt-3" href="produk.php">See More</a>
        </div>
    </div>

    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../fontawesome/js/all.min.js"></script>
    <script src="navbar.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO"
        crossorigin="anonymous"></script> -->
</body>

</html>