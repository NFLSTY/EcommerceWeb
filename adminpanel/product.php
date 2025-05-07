<?php
require "session.php";
require "../koneksi.php";

$queryProduct = mysqli_query($conn, "SELECT a.*, b.nama AS category_name FROM produk a JOIN kategori b ON a.kategori_id=b.id_kategori");
$totalProduct = mysqli_num_rows($queryProduct);
$queryCategory = mysqli_query($conn, "SELECT * FROM kategori");

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
    <title>Product</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css">
</head>

<style>
    .no-decoration {
        text-decoration: none!important;
    }

    form div {
        margin-bottom: 10px;
    }
</style>

<body>
    <?php require "navbar.php" ?>
    <div class="container mt-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php" class="no-decoration text-muted">
                        <i class="fa-solid fa-house"></i> Home</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Category</li>
            </ol>
        </nav>

        <div class="my-4 col-12 col-md-6"> <!-- edit sendiri biar bagus -->
            <h3>Add Product</h3>

            <form action="" method="post", enctype="multipart/form-data">
                <div>
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="form-control" autocomplete="off" required>
                </div>
                <div>
                    <label for="category">Category</label>
                    <select name="category" id="category" class="form-control">
                        <option value="">Choose Category</option>
                        <?php
                        while ($data = mysqli_fetch_array($queryCategory)) {
                        ?>
                            <option value="<?php echo $data['id_kategori'] ?>"><?php echo $data['nama'] ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div>
                    <label for="price">Price</label>
                    <input type="number" name="price" id="price" class="form-control" required>
                </div>
                <div>
                    <label for="picture">Product Picture</label>
                    <input type="file" name="picture" id="picture" class="form-control">
                </div>
                <div>
                    <label for="detail">Detail</label>
                    <textarea name="detail" id="detail" cols="20" rows="10" class="form-control"></textarea>
                </div>
                <div>
                    <label for="stock">Stock</label>
                    <select name="stock" id="stock" class="form-control">
                        <option value="tersedia">Tersedia</option>
                        <option value="habis">Habis</option>
                    </select>
                </div>
                <div class="mt-3">
                    <button class="btn btn-primary" type="Submit" name="add_product">Add</button>
                </div>
            </form>

            <?php
            if (isset($_POST['add_product'])) {
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

                if ($category == '' || $price == '' || $detail == '' || $stock == '') {
                ?>
                    <div class="p-3 mb-2 bg-warning text-dark mt-3">Data still uncompleted!</div>
                <?php
                } else {
                    if ($file_name != '') {
                        if ($image_size > 5000000) {
                        ?>
                            <div class="p-3 mb-2 bg-warning text-dark mt-3">Images size should not be more than 50 mb</div>
                        <?php
                        } else {
                            if ($imageFileType != 'jpg' && $imageFileType != 'jpeg' && $imageFileType != 'png' && $imageFileType != 'gif') {
                            ?>
                                <div class="p-3 mb-2 bg-warning text-dark mt-3">Images must be in jpg, png, or gif format!</div>
                            <?php
                            } else {
                                move_uploaded_file($_FILES["picture"]["tmp_name"], $dir_target . $new_image);
                            }
                        }
                    }
                    $queryCreate = mysqli_query($conn, "INSERT INTO produk (kategori_id, nama, harga, foto, detail, stok)
                        VALUES ('$category', '$name', '$price', '$new_image', '$detail', '$stock')");

                    if ($queryCreate) {
                    ?>
                        <div class="p-3 mb-2 bg-info text-white">Product added successfully!</div>
                        <meta http-equiv="refresh" content="1">
                    <?php
                    } else {
                        echo mysqli_error($conn);
                    }
                }
            }
            ?>
        </div>

        <div class="table-responsive mt-5">
            <h3>Product List</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($totalProduct == 0) {
                    ?>
                        <tr>
                            <td colspan="6" class="text-center">Product data not available</td>
                        </tr>
                        <?php // jgn lupa colspan ditambah jika column nambah
                    } else {
                        $total = 1;
                        while ($data = mysqli_fetch_array($queryProduct)) {
                        ?>
                            <tr>
                                <td><?php echo $total ?></td>
                                <td><?php echo $data['nama'] ?></td>
                                <td><?php echo $data['category_name'] ?></td>
                                <td><?php echo $data['harga'] ?></td>
                                <td><?php echo $data['stok'] ?></td>
                                <td><a href="product-detail.php?pro=<?php echo $data['id_produk'] ?>"
                                        class="btn btn-info"><i class="fa-solid fa-pen-to-square"></i></a></td>
                            </tr>
                    <?php
                            $total++;
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../fontawesome/js/all.min.js"></script>
</body>

</html>