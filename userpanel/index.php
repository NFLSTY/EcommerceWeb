<?php
session_start();
require "../koneksi.php";
// $queryProduk = mysqli_query($conn, "SELECT id_produk, nama, harga, foto, detail FROM produk LIMIT 6");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Online | Home</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="../css/user.css">

</head>

<body>
    <script src="..\bootstrap\js\bootstrap.bundle.min.js"></script>
    <?php require "navbar.php" ?>

    <!-- Carousel -->
    <!-- <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="..\image\banner.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="..\image\product.jpg" class="d-block w-100" alt="...">
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
    </div> -->


    <!-- Banner -->
    <div class="container-fluid banner-home d-flex align-items-center">
        <div class="container text-center text-white">
            <h1>Toko Online Alat Gaming</h1>
            <div class="col-md-8 offset-md-2">
                <form action="produk.php" method="get">
                    <div class="input-group input-group-lg my-4">
                        <input type="text" class="form-control" placeholder="Find Items" aria-describedby="basic-addon2"
                            name="keyword">
                        <button type="submit" class="btn warna2 text-white">Search</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Kategori -->
    <div class="container-fluid py-5">
        <div class="container text-center">
            <h3>Categories</h3>

            <div class="row mt-5">
                <div class="col-md-4 mb-3">
                    <a class="no-decoration" href="produk.php?kategori=pc">
                        <div class="highlight kategori-pc d-flex justify-content-center align-items-center">
                            <h4>Gaming PC</h3>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 mb-3">
                    <a class="no-decoration" href="produk.php?kategori=pc">
                        <div class="highlight kategori-monitor d-flex justify-content-center align-items-center">
                            <h4>Monitor</h3>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 mb-3">
                    <a class="no-decoration" href="produk.php?kategori=pc">
                        <div class="highlight kategori-peripheral d-flex justify-content-center align-items-center">
                            <h4>Peripheral</h3>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid warna3 py-5">
        <div class="container">
            <h3 class="text-center">About Us</h3>
            <p class="fs-5 mb-3">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ipsam numquam laboriosam
                magni officiis illo ratione vero reprehenderit deleniti nemo, magnam, quis in minus, rerum non quidem
                officia vitae sint dolore architecto a. Odit, ad! Et aut quia, voluptates eaque accusamus totam
                exercitationem ullam quaerat quod eligendi dolorum. Illum nostrum sint pariatur iusto, quos voluptas
                unde odit incidunt quia soluta non obcaecati beatae consectetur exercitationem saepe quidem voluptatibus
                possimus, similique cupiditate earum aspernatur distinctio tempore dolores. Vel itaque illum eaque
                inventore!</p>
        </div>
    </div>

    <div class="container-fluid py-5">
        <div class="container text-center">
            <h3>Produk</h3>
            <div class="row m-5">
                <?php while ($data = mysqli_fetch_array($queryProduk)) { ?>
                    <div class="col-sm-6 col-md-4 mb-3">
                        <div class="card h-100">
                            <div class="image-box">
                                <img class="card-img-top" src="../image/<?php echo $data['foto'] ?>" alt="Card image cap">
                            </div>
                            <div class="card-body">
                                <h4 class="card-title"><?php echo $data['nama'] ?></h4>
                                <p class="card-text text-truncate"><?php echo $data['detail'] ?></p>
                                <p class="card-text text-harga">Rp <?php echo $data['harga'] ?></p>
                                <a href="produk-detail.php?nama=<?php echo $data['nama'] ?>" class="btn button">Lihat
                                    Detail</a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>

            <a class="btn btn-outline-primary mt-3" href="produk.php">See More</a>
        </div>
    </div>

    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../fontawesome/js/all.min.js"></script>
</body>

</html>