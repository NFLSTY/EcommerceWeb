<?php
require "session.php";
require "../koneksi.php";

$id = $_GET['pro'];
$query = mysqli_query($conn, "SELECT a.*, b.name AS category_name FROM product a JOIN categories b ON a.category_id=b.category_id
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
</head>

<style>
    form div {
        margin-bottom: 10px;
    }
</style>

<body>
    <?php require "navbar.php" ?>
    <div class="container mt-5">
        <h2>Product Detail</h2>
        <div>
            <form action="" method="post" enctype="multipart/form-data">
                <div>
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" value="<?php echo $data['name'] ?>" class="form-control" autocomplete="off" required>
                </div>
                <div>
                    <label for="category">Category</label>
                    <select name="category" id="category" class="form-control">
                        <option value=""><?php echo $data['category_name'] ?></option>
                        <?php
                        while ($dataCategory = mysqli_fetch_array($queryCategory)) {
                        ?>
                            <option value="<?php echo $dataCategory['category_id'] ?>"><?php echo $dataCategory['name'] ?></option>
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
                    <label for="lastPicture"></label>
                    <img src="../image/<?php echo $data['image_url'] ?>" alt="" width="300px">
                </div>
                <div>
                    <label for="picture">Product Picture</label>
                    <input type="file" name="picture" id="picture" class="form-control">
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
                        if ($data['stock'] == 'Tersedia') {
                        ?>
                            <option value="habis">Habis</option>
                        <?php
                        } else {
                        ?>
                            <option value="tersedia">Tersedia</option>
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
                $file_name = basename($_FILES["picture"]["name"]);
                $file_target = $dir_target . $file_name;
                $imageFileType = strtolower(pathinfo($file_target, PATHINFO_EXTENSION));
                $image_size = $_FILES["picture"]["size"];
                $random_name = generateRandomString(20);
                $new_image = $random_name . "." . $imageFileType;

                if ($category == '' || $price == '' || $detail == '') { // requirements still inccorect (new image must be included)
                ?>
                    <div class="p-3 mb-2 bg-warning text-dark mt-3">Data still unchanged!</div>
                <?php
                } else {
                    $queryUpdate = mysqli_query($conn, "UPDATE product SET category_id='$category', name='$name',
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
                                move_uploaded_file($_FILES["picture"]["tmp_name"], $dir_target . $new_image);

                                $queryUpdateImage = mysqli_query($conn, "UPDATE product SET image_url='$new_image' WHERE product_id=$id"); // wrong logic

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
                $queryDelete  = mysqli_query($conn, "DELETE FROM product WHERE product_id='$id'");

                if ($queryDelete) {
                ?>
                    <div class="p-3 mb-2 bg-info text-white mt-3">Product deleted successfully</div>
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
</body>

</html>