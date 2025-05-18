<?php
require "../connection.php";

$queryCategory = mysqli_query($conn, "SELECT * FROM categories");

if (isset($_GET['keyword'])) {
    $queryProduct = mysqli_query($conn, "SELECT * FROM products WHERE product_name LIKE '%$_GET[keyword]%'");
} elseif (isset($_GET['categories'])) {
    $queryGetCategories = mysqli_query($conn, "SELECT category_id FROM categories WHERE category_name='$_GET[categories]'");
    $categoryId = mysqli_fetch_array($queryGetCategories);
    $queryProduct = mysqli_query($conn, "SELECT * FROM products WHERE category_id='$categoryId[category_id]'");
} else {
    $queryProduct = mysqli_query($conn, "SELECT * FROM products");
}

$countData = mysqli_num_rows($queryProduct);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="../css/user.css">
</head>

<body>
    <?php require "navbar.php" ?>

    <main>
        <div class="container-fluid px-5 py-4">
            <div class="row">
                <!-- categories -->
                <div class="col-lg-2 mb-5">
                    <h3 class="mb-4">Category</h3>
                    <ul class="list-group">
                        <?php while ($category = mysqli_fetch_array($queryCategory)) { ?>
                            <a class="text-decoration-none"
                                href="products.php?categories=<?php echo $category['category_name'] ?>">
                                <li class="list-group-item"><?php echo $category['category_name'] ?></li>
                            </a>
                        <?php } ?>
                    </ul>
                </div>

                <!-- Products -->
                <div class="col-lg-10">
                    <h3 class="text-center mb-3">Products</h3>
                    <?php
                    if ($countData < 1) {
                        ?>
                        <h4 class="text-center my-5">Product not available!</h4>
                        <?php
                    }
                    ?>
                    <div class="row row-cols-2 row-cols-md-4">
                        <?php while ($data = mysqli_fetch_array($queryProduct)) { ?>
                            <div class="col px-1 py-2 d-flex">
                                <div class="d-flex flex-column w-100 p-0">
                                    <a href="#" class="text-decoration-none product-text">
                                        <div class="card-template mb-2"
                                            style="--bg-image: url('../image/<?php echo $data['product_image'] ?>')"></div>
                                        <h6 class="mb-1"><?php echo $data['product_name'] ?></h6>
                                        <p class="price-text mb-2">Rp<?php echo $data['price'] ?></p>
                                    </a>
                                    <div class="mt-auto">
                                        <button id="product-button" type="button" class="w-100 button-template">Add to cart</button>
                                    </div>
                                </div>
                            </div>


                            <!-- <div class="col px-1 py-2">
                                <a href="#" class="text-decoration-none product-text">
                                    <div class="card-template"
                                        style="--bg-image: url('../image/<?php echo $data['product_image'] ?>')">
                                    </div>
                                    <div>
                                        <h6 id="product-name"><?php echo $data['product_name'] ?></h6>
                                        <p id="product-price" class="price-text">Rp<?php echo $data['price'] ?></p>
                                        <a href="products-detail.php?nama=<?php echo $data['product_name'] ?>"></a>
                                    </div>
                                </a>
                                <button id="product-button" type="button" href="example" class="w-100 button-template">Add
                                    to cart</button>
                            </div> -->
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