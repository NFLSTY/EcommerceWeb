<?php
require "../koneksi.php";

$queryCategory = mysqli_query($conn, "SELECT c.*, m.name as main_name FROM categories c JOIN main_categories m ON c.main_category_id = m.main_category_id");

$groupedCategories = [];

while ($category = mysqli_fetch_assoc($queryCategory)) {
    $mainName = $category['main_name'];
    $groupedCategories[$mainName][] = $category;
}

if (isset($_GET['keyword'])) {
    $queryProduct = mysqli_query($conn, "SELECT * FROM product WHERE name LIKE '%$_GET[keyword]%'");
} elseif (isset($_GET['categories'])) {
    $queryGetCategory = mysqli_query($conn, "SELECT category_id FROM categories WHERE name='$_GET[categories]'");
    $categoryId = mysqli_fetch_array($queryGetCategory);
    $queryProduct = mysqli_query($conn, "SELECT * FROM product WHERE category_id='$categoryId[category_id]'");
} else {
    $queryProduct = mysqli_query($conn, "SELECT * FROM product");
}

$countData = mysqli_num_rows($queryProduct);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marketplace | Product</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="../css/user.css">
</head>

<body>
    <?php require "navbar.php" ?>
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-3 mb-5">
                <h3>Categories</h3>
                <?php foreach ($groupedCategories as $mainCategory => $categoriesList) {
                    $collapseId = 'collapse_' . md5($mainCategory);
                    ?>
                    <div class="mb-2">
                        <!-- Toggle area: full row clickable -->
                        <button
                            class="d-flex justify-content-between align-items-center w-100 fw-bold btn btn-toggle text-start"
                            data-bs-toggle="collapse" data-bs-target="#<?php echo $collapseId; ?>" aria-expanded="false"
                            aria-controls="<?php echo $collapseId; ?>">
                            <?php echo $mainCategory; ?>
                            <i class="fas fa-chevron-down"></i>
                        </button>

                        <!-- Collapsible list -->
                        <div class="collapse" id="<?php echo $collapseId; ?>">
                            <ul class="list-group mt-2">
                                <?php foreach ($categoriesList as $cat) { ?>
                                    <a class="no-decoration" href="product.php?categories=<?php echo $cat['name']; ?>">
                                        <li class="list-group-item"><?php echo $cat['name']; ?></li>
                                    </a>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                <?php } ?>
            </div>


            <div class="col-lg-9">
                <h3 class="text-center mb-4">Product</h3>
                <div class="row">
                    <?php
                    if ($countData < 1) {
                        ?>
                        <h4 class="text-center my-5">Product not available!</h4>
                        <?php
                    }
                    ?>
                    <?php while ($product = mysqli_fetch_array($queryProduct)) { ?>
                        <div class="col-md-4 mb-4">
                            <div class="card h-100">
                                <div class="image-box">
                                    <img class="card-img-top" src="../image/<?php echo $product['image_url'] ?>"
                                        alt="Card image cap">
                                </div>
                                <div class="card-body">
                                    <h4 class="card-title"><?php echo $product['name'] ?></h4>
                                    <p class="card-text text-truncate"><?php echo $product['detail'] ?></p>
                                    <p class="card-text text-harga">Rp <?php echo $product['price'] ?></p>
                                    <a href="product-detail.php?name=<?php echo $product['name'] ?>"
                                        class="btn button">See Details</a>
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