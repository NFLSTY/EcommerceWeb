<?php
require "session.php";
require "../koneksi.php";

$queryCategory = mysqli_query($conn, "SELECT * FROM kategori");
$totalCategory = mysqli_num_rows($queryCategory); 

$queryProduct = mysqli_query($conn, "SELECT * FROM produk");
$totalProduct = mysqli_num_rows($queryProduct); 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css">
</head>

<style>
    .kotak {
        border: solid;
    }

    .summary-category {
        border-radius: 15px;
        background-color: #0b8712;
    }

    .summary-product {
        border-radius: 15px;
        background-color: #0B5587;
    }

    .no-decoration {
        text-decoration: none!important;
        color: #F0BB78;
    }

    .no-decoration:hover {
        color: #500073;
    }

    .ui-breadcrumb{
        background-color: none!important;
    }
</style>

<body>
    <?php require "navbar.php" ?>
    <div class="container mt-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <i class="fa-solid fa-house"></i> Home
                </li>
            </ol>
        </nav>
        <h2>Hello <?php echo $_SESSION['username'] ?></h2>

        <div class="container mt-5">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-12 mb-3">
                    <div class="summary-category p-4">
                        <div class="row">
                            <div class="col-6">
                                <i class="fa-solid fa-list fa-7x text-dark"></i>
                            </div>
                            <div class="col-6 text-light">
                                <h3 class="fs-2">Category</h3>
                                <p class="fs-4"><?php echo $totalCategory?> Category</p>
                                <p><a href="category.php" class="no-decoration">Category Detail</a></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-12 mb-3">
                    <div class="summary-product p-4">
                        <div class="row">
                            <div class="col-6">
                                <i class="fa-solid fa-box-open fa-7x text-dark"></i>
                            </div>
                            <div class="col-6 text-light">
                                <h3 class="fs-2">Product</h3>
                                <p class="fs-4"><?php echo $totalProduct?> Product</p>
                                <p><a href="product.php" class="no-decoration">Product Detail</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../fontawesome/js/all.min.js"></script>
</body>

</html>