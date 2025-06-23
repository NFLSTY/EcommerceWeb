<?php
require "session.php";
require "../connection.php";

$id = $_GET['cat'];
$query = mysqli_query($conn, "SELECT * FROM categories WHERE category_id ='$id'");
$data = mysqli_fetch_array($query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category Detail</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css">
</head>

<body>
    <?php require "navbar.php" ?>
    <div class="container mt-5">
        <h2>Category Detail</h2>
        <div class="my-4 col-12 col-md-6">
            <form action="" method="post">
                <div>
                    <label for="category">Category</label>
                    <input type="text" name="category" id="category" class="form-control"
                        value="<?php echo $data['category_name'] ?>">
                </div>
                <div class="mt-4 d-flex justify-content-between">
                    <button class="btn btn-primary" type="update" name="update-category">Update</button>
                    <button class="btn btn-danger" type="delete" name="delete-category">Delete</button>
                </div>
            </form>

            <?php
            if (isset($_POST['update-category'])) {
                $category = htmlspecialchars($_POST['category']); 

                if ($data['category_name'] == $category) {
                ?>
                    <div class="p-3 mb-2 bg-warning text-dark mt-3">Category have not updated!</div>
                <?php
                } else {
                    $query = mysqli_query($conn, "SELECT * FROM categories WHERE category_name='$category'");
                    $totalData = mysqli_num_rows($query);

                    if ($totalData > 0) {
                    ?>
                        <div class="p-3 mb-2 bg-warning text-dark mt-3">Category already used!</div>
                    <?php
                    } else {
                        $queryUpdate = mysqli_query($conn, "UPDATE categories SET category_name='$category' WHERE category_id='$id'");

                        if ($queryUpdate) {
                        ?>
                            <div class="p-3 mb-2 bg-info text-white">Category updated successfully!</div>
                            <meta http-equiv="refresh" content="2; url=category.php">
                        <?php
                        } else {
                            echo mysqli_error($conn);
                        }
                    }
                }
            }

            if (isset($_POST['delete-category'])) { 
                $queryCheck = mysqli_query($conn, "SELECT * FROM products WHERE category_id='$id'");
                $dataCount = mysqli_num_rows($queryCheck);

                if ($dataCount > 0) {
                ?>
                    <div class="p-3 mb-2 bg-warning text-dark mt-3">Category cannot be deleted because it is in use in a product</div>
                <?php
                die();
                }

                $queryDelete = mysqli_query($conn, "DELETE FROM categories WHERE category_id='$id'");

                if ($queryDelete) {
                ?>
                    <div class="p-3 mb-2 bg-info text-white mt-3">Category deleted successfully!</div>
                    <meta http-equiv="refresh" content="2; url=category.php">
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
        document.addEventListener("DOMContentLoaded", function () {
            const deleteButton = document.querySelector('button[name="delete-category"]');
            deleteButton.addEventListener('click', function (event) {
                const confirmation = confirm("Are you sure you want to delete this category?");
                if (!confirmation) {
                    event.preventDefault();
                }
            });
        });
    </script>
</body>

</html>