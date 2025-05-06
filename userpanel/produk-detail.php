<?php
session_start();
require "../koneksi.php";

$nama = htmlspecialchars($_GET['nama']);
$queryProduk = mysqli_query($conn, "SELECT * FROM produk WHERE nama='$nama'");
$produk = mysqli_fetch_array($queryProduk);
$queryTerkait = mysqli_query($conn, "SELECT * FROM produk WHERE kategori_id='$produk[kategori_id]' 
AND id_produk != '$produk[id_produk]' LIMIT 4");

// Handle review form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_review'])) {
    $user_name = htmlspecialchars($_POST['user_name']);
    $rating = intval($_POST['rating']);
    $comment = htmlspecialchars($_POST['comment']);
    $product_id = $produk['id_produk'];

    $insertReview = mysqli_query($conn, "INSERT INTO reviews (product_id, user_name, rating, comment, created_at) VALUES ('$product_id', '$user_name', '$rating', '$comment', NOW())");
    if ($insertReview) {
        echo "<script>alert('Review submitted successfully'); window.location.href='produk-detail.php?nama=" . urlencode($nama) . "';</script>";
        exit;
    } else {
        echo "<script>alert('Failed to submit review');</script>";
    }
}

// Fetch reviews for this product
$reviewsQuery = mysqli_query($conn, "SELECT * FROM reviews WHERE product_id = '" . $produk['id_produk'] . "' ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Online | Detail Produk</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="../css/user.css">
</head>
<body>
    <?php require "navbar.php"?>
    <div class="container-fluid py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 mb-4">
                    <img class="image-box" src="../image/<?php echo $produk['foto']?>">
                </div>
                <div class="col-lg-6 offset-lg-1">
                    <h1><?php echo $produk['nama']?></h1>
                    <p class="fs-5"><?php echo $produk['detail']?></p></p>
                    <p class="text-harga">Rp <?php echo $produk['harga']?></p>
                    <p class="fs-5">Status Stok: <strong><?php echo $produk['stok']?></strong></p>
                </div>
            </div>

            <!-- Reviews Section -->
            <div class="mt-5">
                <h3>Ulasan dan Komentar</h3>
                <?php if (mysqli_num_rows($reviewsQuery) > 0) { ?>
                    <?php while ($review = mysqli_fetch_array($reviewsQuery)) { ?>
                        <div class="border p-3 mb-3">
                            <strong><?php echo htmlspecialchars($review['user_name']); ?></strong> 
                            <span class="text-warning">
                                <?php for ($i = 0; $i < $review['rating']; $i++) { ?>
                                    &#9733;
                                <?php } ?>
                                <?php for ($i = $review['rating']; $i < 5; $i++) { ?>
                                    &#9734;
                                <?php } ?>
                            </span>
                            <p><?php echo nl2br(htmlspecialchars($review['comment'])); ?></p>
                            <small class="text-muted"><?php echo $review['created_at']; ?></small>
                        </div>
                    <?php } ?>
                <?php } else { ?>
                    <p>Belum ada ulasan untuk produk ini.</p>
                <?php } ?>

                <!-- Review Form -->
                <form method="POST" class="mt-4">
                    <div class="mb-3">
                        <label for="user_name" class="form-label">Nama Anda</label>
                        <input type="text" class="form-control" id="user_name" name="user_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="rating" class="form-label">Rating</label>
                        <select class="form-select" id="rating" name="rating" required>
                            <option value="">Pilih rating</option>
                            <option value="5">5 - Sangat Baik</option>
                            <option value="4">4 - Baik</option>
                            <option value="3">3 - Cukup</option>
                            <option value="2">2 - Kurang</option>
                            <option value="1">1 - Buruk</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="comment" class="form-label">Komentar</label>
                        <textarea class="form-control" id="comment" name="comment" rows="3" required></textarea>
                    </div>
                    <button type="submit" name="submit_review" class="btn btn-primary">Kirim Ulasan</button>
                </form>
            </div>
        </div>
    </div>

    <div class="container-fluid py-5 warna2">
        <div class="container">
            <h2 class="text-center text-white mb-5">Produk Terkait</h2>
            <div class="row">
                <?php while ($data = mysqli_fetch_array($queryTerkait)) {?>
                <div class="col-md-6 col-lg-3 mb-3">
                    <a href="produk-detail.php?nama=<?php echo $data['nama']?>">
                        <img src="../image/<?php echo $data['foto']?>">
                    </a>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../fontawesome/js/all.min.js"></script>
</body>
</html>
