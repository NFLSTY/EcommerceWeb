<?php
require "../koneksi.php";

$queryKategori = mysqli_query($conn, "SELECT * FROM kategori");

if (isset($_GET['keyword'])) {
    $queryProduk = mysqli_query($conn, "SELECT * FROM produk WHERE nama LIKE '%$_GET[keyword]%'");
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
    <title>Online Shop | Product</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="../css/user.css">
</head>

<body>
    <?php require "navbar.html" ?>

    <main>
        <div class="container-fluid px-5 py-4">
            <div class="row">
                <div class="col-lg-3 mb-5">
                    <h3 class="mb-3">Category</h3>
                    <ul class="list-group">
                        <?php while ($kategori = mysqli_fetch_array($queryKategori)) { ?>
                            <a class="text-decoration-none" href="product.php?kategori=<?php echo $kategori['nama'] ?>">
                                <li class="list-group-item"><?php echo $kategori['nama'] ?></li>
                            </a>
                        <?php } ?>
                    </ul>
                </div>

                <div class="col-lg-9">
                    <h3 class="text-center mb-2">Product</h3>
                    <div class="row row-cols-2 row-cols-md-4">
                        <?php
                        if ($countData < 1) {
                            ?>
                            <h4 class="text-center my-5">Product not available!</h4>
                            <?php
                        }
                        ?>
                        <?php while ($data = mysqli_fetch_array($queryProduk)) { ?>
                            <div class="col px-1 py-2">
                                <a href="#" class="text-decoration-none product-text">
                                    <div class="card-template"
                                        style="--bg-image: url('../image/<?php echo $data['foto'] ?>')">
                                    </div>
                                    <div>
                                        <h6 id="product-name"><?php echo $data['nama'] ?></h6>
                                        <p id="product-price" class="price-text">Rp<?php echo $data['harga'] ?></p>
                                        <a href="produk-detail.php?nama=<?php echo $data['nama'] ?>"></a>
                                    </div>
                                </a>
                                <button id="product-button" type="button" href="example" class="w-100 button-template">Add
                                    to cart</button>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php require "footer.html" ?>

    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../fontawesome/js/all.min.js"></script>
    <script src="../js/user.js"></script>

</body>

</html>