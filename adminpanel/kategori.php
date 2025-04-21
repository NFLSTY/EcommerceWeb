<?php
require "session.php";
require "../koneksi.php";

$queryKategori = mysqli_query($conn, "SELECT * FROM kategori");
$jumlahKategori = mysqli_num_rows($queryKategori);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategori</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css">
</head>

<style>
    .no-decoration {
        text-decoration: none!important;
    }
</style>

<body>
    <?php require "navbar.php"?>
    <div class="container mt-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php" class="no-decoration text-muted">
                        <i class="fa-solid fa-house"></i> Home</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Kategori</li>
            </ol>
        </nav>

        <div class="my-4 col-12 col-md-6"> <!-- edit sendiri biar bagus -->
            <h3>Tambah Kategori</h3>

            <form action="" method="post">
                <div>
                    <label for="kategori">Kategori</label>
                    <input type="text" name="kategori" id="kategori" placeholder="Input nama kategori"
                        class="form-control" autocomplete="off" required>
                </div>
                <div class="mt-3">
                    <button class="btn btn-primary" type="Submit" name="tambah_kategori">Tambah</button>
                </div>
            </form>

            <?php
            if (isset($_POST['tambah_kategori'])) { 
                $kategori = htmlspecialchars($_POST['kategori']);
                $queryDouble = mysqli_query($conn, "SELECT nama FROM kategori WHERE nama = '$kategori'");
                $jumlahKategoriDouble = mysqli_num_rows($queryDouble);

                if ($jumlahKategoriDouble > 0) {
                ?>
                    <div class="p-3 mb-2 bg-warning text-dark mt-3">Kategori sudah ada!</div>
                    <?php
                } else {
                    $queryCreate = mysqli_query($conn, "INSERT INTO kategori (nama) VALUES ('$kategori')");

                    if ($queryCreate) {
                    ?>
                        <div class="p-3 mb-2 bg-info text-white">Kategori berhasil ditambah</div>
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
            <h3>List Kategori</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($jumlahKategori == 0) {
                    ?> 
                        <tr>
                            <td colspan="3" class="text-center">Data kategori tidak tersedia</td> 
                        </tr>
                        <?php // jgn lupa colspan ditambah jika column nambah
                    } else {
                        $jumlah = 1;
                        while ($data = mysqli_fetch_array($queryKategori)) {
                        ?>
                            <tr>
                                <td><?php echo $jumlah ?></td>
                                <td><?php echo $data['nama'] ?></td>
                                <td><a href="kategori-detail.php?cat=<?php echo $data['id_kategori'] ?>"
                                        class="btn btn-info"><i class="fa-solid fa-pen-to-square"></i></a></td>
                            </tr>
                    <?php
                            $jumlah++;
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