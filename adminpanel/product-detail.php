<?php
require "session.php";
require "../connection.php";

$id = $_GET['pro'];
$query = mysqli_query($conn, "SELECT a.*, b.category_name FROM products a JOIN categories b ON a.category_id=b.category_id
WHERE product_id ='$id'");
$data = mysqli_fetch_array($query);
$queryCategory = mysqli_query($conn, "SELECT * FROM categories WHERE category_id != $data[category_id]");

function generateRandomString($length = 10)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';

    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[random_int(0, $charactersLength - 1)];
    }

    return $randomString;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Detail</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="../css/admin.css">
</head>

<body>
    <?php require "navbar.php" ?>
    <div class="container mt-5">
        <h2>Product Detail</h2>
        <div>
            <form action="" method="post" enctype="multipart/form-data">
                <div>
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" value="<?php echo $data['product_name'] ?>" class="form-control" autocomplete="off" required>
                </div>
                <div>
                    <label for="category">Category</label>
                    <select name="category" id="category" class="form-control">
                        <option value=""><?php echo $data['category_name'] ?></option>
                        <?php
                        while ($dataCategory = mysqli_fetch_array($queryCategory)) {
                        ?>
                            <option value="<?php echo $dataCategory['category_id'] ?>"><?php echo $dataCategory['category_name'] ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div>
                    <label for="price">Price</label>
                    <input type="number" name="price" id="price" value="<?php echo $data['price'] ?>" class="form-control" required>
                </div>
                <div>
                    <label for="lastImage"></label>
                    <img src="../image/<?php echo $data['product_image'] ?>" alt="" width="300px">
                </div>
                <div>
                    <label for="image">Product Image</label>
                    <input type="file" name="image" id="image" class="form-control">
                </div>
                <div>
                    <label for="detail">Detail</label>
                    <textarea name="detail" id="detail" cols="20" rows="10" class="form-control">
                        <?php echo $data['detail'] ?>
                    </textarea>
                </div>
                <div>
                    <label for="stock">Stock</label>
                    <select name="stock" id="stock" class="form-control">
                        <option value=""><?php echo $data['stock'] ?></option>
                        <?php
                        if ($data['stock'] == 'Available') {
                        ?>
                            <option value="empty">Empty</option>
                        <?php
                        } else {
                        ?>
                            <option value="available">Available</option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="mt-4 d-flex justify-content-between">
                    <button class="btn btn-primary" type="update" name="update-product">Update</button>
                    <button class="btn btn-danger" type="delete" name="delete-product">Delete</button>
                </div>
            </form>

            <?php
            if (isset($_POST['update-product'])) {
                $name = htmlspecialchars($_POST['name']);
                $category = htmlspecialchars($_POST['category']);
                $price = htmlspecialchars($_POST['price']);
                $detail = htmlspecialchars($_POST['detail']);
                $stock = htmlspecialchars($_POST['stock']);

                $dir_target = "../image/";
                $file_name = basename($_FILES["image"]["name"]);
                $file_target = $dir_target . $file_name;
                $imageFileType = strtolower(pathinfo($file_target, PATHINFO_EXTENSION));
                $image_size = $_FILES["image"]["size"];
                $random_name = generateRandomString(20);
                $new_image = $random_name . "." . $imageFileType;

                if ($category == '' || $price == '' || $detail == '') { // requirements still inccorect (new image must be included)
                ?>
                    <div class="p-3 mb-2 bg-warning text-dark mt-3">Data still unchanged!</div>
                <?php
                } else {
                    $queryUpdate = mysqli_query($conn, "UPDATE products SET category_id='$category', product_name='$name',
                    price='$price', detail='$detail', stock='$stock' WHERE product_id=$id");

                    if ($file_name != '') {
                        if ($image_size > 5000000) {
                        ?>
                            <div class="p-3 mb-2 bg-warning text-dark mt-3">Images size should not be more than 50 mb!</div>
                            <?php
                        } else {
                            if ($imageFileType != 'jpg' && $imageFileType != 'jpeg' && $imageFileType != 'png' && $imageFileType != 'gif') {
                            ?>
                                <div class="p-3 mb-2 bg-warning text-dark mt-3">Images must be in jpg, png, or gif format!</div>
                            <?php
                            } else {
                                move_uploaded_file($_FILES["image"]["tmp_name"], $dir_target . $new_image);

                                $queryUpdateImage = mysqli_query($conn, "UPDATE produk SET foto='$new_image' WHERE id_produk=$id"); // wrong logic

                                if ($queryUpdateImage) {
                                ?>
                                    <div class="p-3 mb-2 bg-info text-white">Product updated successfully!</div>
                                    <meta http-equiv="refresh" content="2; url=product.php">
                                <?php
                                } else {
                                    echo mysqli_error($conn);
                                }
                            }
                        }
                    }
                }
            }

            if (isset($_POST['delete-product'])) { 
                // Get the current product image file name
                $currentImage = $data['product_image'];
                $imagePath = "../image/" . $currentImage;

                // Check if the image file exists and delete it
                if (file_exists($imagePath)) {
                    unlink($imagePath); // Deletes the file
                }

                // Delete the product record from the database
                $queryDelete  = mysqli_query($conn, "DELETE FROM products WHERE product_id='$id'");

                if ($queryDelete) {
                ?>
                    <div class="p-3 mb-2 bg-info text-white mt-3">Product deleted successfully!</div>
                    <meta http-equiv="refresh" content="2; url=product.php">
                <?php
                } else {
                    echo mysqli_error($conn);
                }
            }
            ?>
        </div>
    </div>

    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../fontawesome/js/all.min.js"></script>
    <script>
        document.querySelector('button[type="delete"]').addEventListener('click', function (e) {
            if (!confirm('Are you sure you want to delete this product?')) {
                e.preventDefault();
            }
        });
    </script>
</body>

</html>