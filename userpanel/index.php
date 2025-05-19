<?php
session_start();
require "../connection.php";
$queryProduct = mysqli_query($conn, "SELECT product_id, product_name, price, product_image, detail FROM products LIMIT 10");
$countData = mysqli_num_rows($queryProduct);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="../css/user.css">

</head>

<body>
    <?php require "navbar.php" ?>

    <main>
        <article>
            <!-- Banner Carousel -->
            <section>
                <div id="carouselBanner" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="..\image\banner\Banner-Slider-Home-banner-1742015338.jpg" class="d-block w-100"
                                alt="Banner 1">
                        </div>
                        <div class="carousel-item">
                            <img src="..\image\banner\Banner-Slider-Home-Casing-CG-Cinema-Athos-1744711639.jpg"
                                class="d-block w-100" alt="Banner 2">
                        </div>
                        <div class="carousel-item">
                            <img src="..\image\banner\Banner-Slider-Home-Cooler-Anima-1745993994.jpg"
                                class="d-block w-100" alt="Banner 3">
                        </div>
                        <div class="carousel-item">
                            <img src="..\image\banner\Banner-Slider-Home-Cooler-galahad-1746179641.jpg"
                                class="d-block w-100" alt="Banner 4">
                        </div>
                        <div class="carousel-item">
                            <img src="..\image\banner\Banner-Slider-Home-PSU-1stplayer-ngdp-1746154754.jpg"
                                class="d-block w-100" alt="Banner 5">
                        </div>
                        <div class="carousel-item">
                            <img src="..\image\banner\Banner-Slider-Home-PSU-bequiet-pure-power-1744711720.jpg"
                                class="d-block w-100" alt="Banner 6">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselBanner"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselBanner"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </section>

            <!-- Categories -->
            <section>
                <div class="container-fluid px-5 pt-5">
                    <h2 class="mb-4">Categories</h2>
                    <div class="row row-cols-2 row-cols-md-4 align-items-start justify-content-center">
                        <div class="col">
                            <a class="text-decoration-none" href="products.php?kategori=pc">
                                <div class="highlight card-template d-flex justify-content-center align-items-center"
                                    style="--bg-image: url('../image/categories/pc_components.jpg');">
                                </div>
                                <div class="category-text">
                                    <h5>PC Components <span class="arrow">→</span></h5>
                                </div>
                            </a>
                        </div>
                        <div class="col">
                            <a class="text-decoration-none" href="products.php?kategori=pc">
                                <div class="highlight card-template d-flex justify-content-center align-items-center"
                                    style="--bg-image: url('../image/categories/peripherals.jpeg');">
                                </div>
                                <div class="category-text">
                                    <h5>Peripherals <span class="arrow">→</span></h5>
                                </div>
                            </a>
                        </div>
                        <div class="col">
                            <a class="text-decoration-none" href="products.php?kategori=pc">
                                <div class="highlight card-template d-flex justify-content-center align-items-center"
                                    style="--bg-image: url('../image/categories/laptops_and_desktops.jpg');">
                                </div>
                                <div class="category-text">
                                    <h5>Laptops and Desktops <span class="arrow">→</span></h5>
                                </div>
                            </a>
                        </div>
                        <div class="col">
                            <a class="text-decoration-none" href="products.php?kategori=pc">
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
            </section>

            <!-- Products -->
            <section>
                <div class="container-fluid px-5 py-5">
                    <h2 class="mb-4">Products</h2>
                    <?php
                    if ($countData < 1) {
                        ?>
                        <h4 class="text-center my-5">Product not available!</h4>
                        <?php
                    }
                    ?>
                    <div class="row row-cols-3 row-cols-md-5">
                        <?php while ($data = mysqli_fetch_array($queryProduct)) { ?>
                            <div class="col px-1 py-2 d-flex">
                                <div class="d-flex flex-column w-100 p-0">
                                    <a href="product-detail.php?product_id=<?php echo $data['product_id']; ?>"
                                        class="text-decoration-none product-text">
                                        <div class="card-template mb-2"
                                            style="--bg-image: url('../image/<?php echo $data['product_image'] ?>')"></div>
                                        <h6 class="mb-1"><?php echo $data['product_name'] ?></h6>
                                        <p class="price-text mb-2">Rp<?php echo $data['price'] ?></p>
                                    </a>
                                    <div class="mt-auto">
                                        <button id="product-button" type="button" class="w-100 button-template">Add to
                                            cart</button>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </section>
        </article>
    </main>

    <?php require "footer.html" ?>

    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../fontawesome/js/all.min.js"></script>
    <script src="../js/user.js"></script>

</body>

</html>