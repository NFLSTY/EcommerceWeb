<?php
require "session.php";
require "../koneksi.php";

$id = $_GET['pro'];
$query = mysqli_query($conn, "SELECT a.*, b.nama AS nama_kategori FROM produk a JOIN kategori b ON a.kategori_id=b.id_kategori
WHERE id_produk ='$id'");
$data = mysqli_fetch_array($query);
$queryKategori = mysqli_query($conn, "SELECT * FROM kategori WHERE id_kategori != $data[kategori_id]");

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
    <title>Detail Produk</title>
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
        <h2>Detail Produk</h2>
        <div>
            <form action="" method="post" enctype="multipart/form-data">
                <div>
                    <label for="nama">Nama</label>
                    <input type="text" name="nama" id="nama" value="<?php echo $data['nama'] ?>" class="form-control" autocomplete="off" required>
                </div>
                <div>
                    <label for="kategori">Kategori</label>
                    <select name="kategori" id="kategori" class="form-control">
                        <option value=""><?php echo $data['nama_kategori'] ?></option>
                        <?php
                        while ($dataKategori = mysqli_fetch_array($queryKategori)) {
                        ?>
                            <option value="<?php echo $dataKategori['id_kategori'] ?>"><?php echo $dataKategori['nama'] ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div>
                    <label for="harga">Harga</label>
                    <input type="number" name="harga" id="harga" value="<?php echo $data['harga'] ?>" class="form-control" required>
                </div>
                <div>
                    <label for="fotoTerakhir"></label>
                    <img src="../image/<?php echo $data['foto'] ?>" alt="" width="300px">
                </div>
                <div>
                    <label for="foto">Foto Produk</label>
                    <input type="file" name="foto" id="foto" class="form-control">
                </div>
                <div>
                    <label for="detail">Detail</label>
                    <textarea name="detail" id="detail" cols="20" rows="10" class="form-control">
                        <?php echo $data['detail'] ?>
                    </textarea>
                </div>
                <div>
                    <label for="stok">Stok</label>
                    <select name="stok" id="stok" class="form-control">
                        <option value=""><?php echo $data['stok'] ?></option>
                        <?php
                        if ($data['stok'] == 'Tersedia') {
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
                    <button class="btn btn-primary" type="update" name="ubah_produk">Update</button>
                    <button class="btn btn-danger" type="delete" name="hapus_produk">Delete</button>
                </div>
            </form>

            <?php
            if (isset($_POST['ubah_produk'])) {
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

                if ($kategori == '' || $harga == '' || $detail == '') {
                ?>
                    <div class="p-3 mb-2 bg-warning text-dark mt-3">Data belum berubah!</div>
                <?php
                } else {
                    $queryUpdate = mysqli_query($conn, "UPDATE produk SET kategori_id='$kategori', nama='$nama',
                    harga='$harga', detail='$detail', stok='$stok' WHERE id_produk=$id");

                    if ($nama_file != '') {
                        if ($image_size > 5000000) {
                        ?>
                            <div class="p-3 mb-2 bg-warning text-dark mt-3">Gambar tidak boleh lebih dari 50 mb!</div>
                            <?php
                        } else {
                            if ($imageFileType != 'jpg' && $imageFileType != 'jpeg' && $imageFileType != 'png' && $imageFileType != 'gif') {
                            ?>
                                <div class="p-3 mb-2 bg-warning text-dark mt-3">Format file tidak didukung!</div>
                            <?php
                            } else {
                                move_uploaded_file($_FILES["foto"]["tmp_name"], $target_dir . $new_image);

                                $queryUpdateImage = mysqli_query($conn, "UPDATE produk SET foto='$new_image' WHERE id_produk=$id");

                                if ($queryUpdateImage) {
                                ?>
                                    <div class="p-3 mb-2 bg-info text-white">Produk berhasil diubah</div>
                                    <meta http-equiv="refresh" content="2; url=produk.php">
                                <?php
                                } else {
                                    echo mysqli_error($conn);
                                }
                            }
                        }
                    }
                }
            }

            if (isset($_POST['hapus_produk'])) { 
                $queryDelete  = mysqli_query($conn, "DELETE FROM produk WHERE id_produk='$id'");

                if ($queryDelete) {
                ?>
                    <div class="p-3 mb-2 bg-info text-white mt-3">Produk berhasil dihapus</div>
                    <meta http-equiv="refresh" content="2; url=produk.php">
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