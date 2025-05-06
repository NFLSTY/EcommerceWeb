<?php
require "session.php";
require "../koneksi.php";

$queryProduk = mysqli_query($conn, "SELECT a.*, b.nama AS nama_kategori FROM produk a JOIN kategori b ON a.kategori_id=b.id_kategori");
$jumlahProduk = mysqli_num_rows($queryProduk);
$queryKategori = mysqli_query($conn, "SELECT * FROM kategori");

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
    <title>Produk</title>
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
                <li class="breadcrumb-item active" aria-current="page">Kategori</li>
            </ol>
        </nav>

        <div class="my-4 col-12 col-md-6"> <!-- edit sendiri biar bagus -->
            <h3>Tambah Produk</h3>

            <form action="" method="post", enctype="multipart/form-data">
                <div>
                    <label for="nama">Nama</label>
                    <input type="text" name="nama" id="nama" class="form-control" autocomplete="off" required>
                </div>
                <div>
                    <label for="kategori">Kategori</label>
                    <select name="kategori" id="kategori" class="form-control">
                        <option value="">Pilih Kategori</option>
                        <?php
                        while ($data = mysqli_fetch_array($queryKategori)) {
                        ?>
                            <option value="<?php echo $data['id_kategori'] ?>"><?php echo $data['nama'] ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div>
                    <label for="harga">Harga</label>
                    <input type="number" name="harga" id="harga" class="form-control" required>
                </div>
                <div>
                    <label for="foto">Foto Produk</label>
                    <input type="file" name="foto" id="foto" class="form-control">
                </div>
                <div>
                    <label for="detail">Detail</label>
                    <textarea name="detail" id="detail" cols="20" rows="10" class="form-control"></textarea>
                </div>
                <div>
                    <label for="stok">Stok</label>
                    <select name="stok" id="stok" class="form-control">
                        <option value="tersedia">Tersedia</option>
                        <option value="habis">Habis</option>
                    </select>
                </div>
                <div class="mt-3">
                    <button class="btn btn-primary" type="Submit" name="tambah_produk">Tambah</button>
                </div>
            </form>

            <?php
            if (isset($_POST['tambah_produk'])) {
                $nama = htmlspecialchars($_POST['nama']);
                $kategori = htmlspecialchars($_POST['kategori']);
                $harga = htmlspecialchars($_POST['harga']);
                $detail = htmlspecialchars($_POST['detail']);
                $stok = htmlspecialchars($_POST['stok']);

                $target_dir = "../image/";
                $nama_file = basename($_FILES["foto"]["name"]);
                $target_file = $target_dir . $nama_file;
                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                $image_size = $_FILES["foto"]["size"];
                $random_name = generateRandomString(20);
                $new_image = $random_name . "." . $imageFileType;

                if ($kategori == '' || $harga == '' || $detail == '' || $stok == '') {
                ?>
                    <div class="p-3 mb-2 bg-warning text-dark mt-3">Data belum lengkap!</div>
                <?php
                } else {
                    if ($nama_file != '') {
                        if ($image_size > 5000000) {
                        ?>
                            <div class="p-3 mb-2 bg-warning text-dark mt-3">Gambar tidak boleh lebih dari 50 mb!</div>
                        <?php
                        } else {
                            if ($imageFileType != 'jpg' && $imageFileType != 'jpeg' && $imageFileType != 'png' && $imageFileType != 'gif') {
                            ?>
                                <div class="p-3 mb-2 bg-warning text-dark mt-3">Gambar harus berformat jpg, png, atau gif!</div>
                            <?php
                            } else {
                                move_uploaded_file($_FILES["foto"]["tmp_name"], $target_dir . $new_image);
                            }
                        }
                    }
                    $queryCreate = mysqli_query($conn, "INSERT INTO produk (kategori_id, nama, harga, foto, detail, stok)
                        VALUES ('$kategori', '$nama', '$harga', '$new_image', '$detail', '$stok')");

                    if ($queryCreate) {
                    ?>
                        <div class="p-3 mb-2 bg-info text-white">Produk berhasil ditambah</div>
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
            <h3>List Produk</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($jumlahProduk == 0) {
                    ?>
                        <tr>
                            <td colspan="6" class="text-center">Data produk tidak tersedia</td>
                        </tr>
                        <?php // jgn lupa colspan ditambah jika column nambah
                    } else {
                        $jumlah = 1;
                        while ($data = mysqli_fetch_array($queryProduk)) {
                        ?>
                            <tr>
                                <td><?php echo $jumlah ?></td>
                                <td><?php echo $data['nama'] ?></td>
                                <td><?php echo $data['nama_kategori'] ?></td>
                                <td><?php echo $data['harga'] ?></td>
                                <td><?php echo $data['stok'] ?></td>
                                <td><a href="produk-detail.php?pro=<?php echo $data['id_produk'] ?>"
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