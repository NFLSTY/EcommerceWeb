<?php
require "session.php";
require "../connection.php";

$queryCategory = mysqli_query($conn, "SELECT * FROM categories");
$totalCategory = mysqli_num_rows($queryCategory);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="../css/admin.css">
</head>

<body>
    <?php require "navbar.php"?>
    <div class="container mt-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php" class="no-decoration1 text-muted">
                        <i class="fa-solid fa-house"></i> Home</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Category</li>
            </ol>
        </nav>

        <div class="my-4 col-12 col-md-6"> <!-- edit sendiri biar bagus -->
            <h3>Add category</h3>

            <form action="" method="post">
                <div>
                    <label for="category">Category</label>
                    <input type="text" name="category" id="category" placeholder="Input category name"
                        class="form-control" autocomplete="off" required>
                </div>
                <div class="mt-3">
                    <button class="btn btn-primary" type="Submit" name="add_category">Add</button>
                </div>
            </form>

            <?php
            if (isset($_POST['add_category'])) { 
                $category = htmlspecialchars($_POST['category']);
                $queryDouble = mysqli_query($conn, "SELECT category_name FROM categories WHERE category_name = '$category'");
                $totalCategoryDouble = mysqli_num_rows($queryDouble);

                if ($totalCategoryDouble > 0) {
                ?>
                    <div class="p-3 mb-2 bg-warning text-dark mt-3">Category already used!</div>
                    <?php
                } else {
                    $queryCreate = mysqli_query($conn, "INSERT INTO categories (category_name) VALUES ('$category')");

                    if ($queryCreate) {
                    ?>
                        <div class="p-3 mb-2 bg-info text-white">Category added sucessfully!</div>
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
            <h3>Category List</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($totalCategory == 0) {
                    ?> 
                        <tr>
                            <td colspan="3" class="text-center">Category data not available</td> 
                        </tr>
                        <?php // jgn lupa colspan ditambah jika column nambah
                    } else {
                        $total = 1;
                        while ($data = mysqli_fetch_array($queryCategory)) {
                        ?>
                            <tr>
                                <td><?php echo $total ?></td>
                                <td><?php echo $data['category_name'] ?></td>
                                <td><a href="category-detail.php?cat=<?php echo $data['category_id'] ?>"
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