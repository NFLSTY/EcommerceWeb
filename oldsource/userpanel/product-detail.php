<?php
require "../connection.php";

if (!isset($_GET['product_id'])) {
    die("Product ID is required.");
}

$product_id = intval($_GET['product_id']);

// Handle form submission for new review
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_name = mysqli_real_escape_string($conn, $_POST['user_name']);
    $rating = intval($_POST['rating']);
    $comment = mysqli_real_escape_string($conn, $_POST['comment']);

    if ($user_name && $rating >= 1 && $rating <= 5 && $comment) {
        $insertReview = mysqli_query($conn, "INSERT INTO product_reviews (product_id, user_name, rating, comment) VALUES ($product_id, '$user_name', $rating, '$comment')");
        if (!$insertReview) {
            $error_message = "Failed to submit review. Please try again.";
        } else {
            header("Location: product-detail.php?product_id=$product_id");
            exit;
        }
    } else {
        $error_message = "Please fill all fields correctly.";
    }
}

// Fetch product details
$productQuery = mysqli_query($conn, "SELECT * FROM products WHERE product_id = $product_id");
if (mysqli_num_rows($productQuery) < 1) {
    die("Product not found.");
}
$product = mysqli_fetch_assoc($productQuery);

// Fetch reviews
$reviewsQuery = mysqli_query($conn, "SELECT * FROM product_reviews WHERE product_id = $product_id ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?php echo htmlspecialchars($product['product_name']); ?> - Product Detail</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css" />
    <link rel="stylesheet" href="../css/user.css" />
</head>
<body>
    <?php require "navbar.php"; ?>

    <main class="container my-4">
        <div class="row">
            <div class="col-md-6">
                <img src="../image/<?php echo htmlspecialchars($product['product_image']);
                ?>" alt="<?php echo htmlspecialchars($product['product_name']); ?>" class="img-fluid" />
            </div>
            <div class="col-md-6">
                <h2><?php echo htmlspecialchars($product['product_name']); ?></h2>
                <p class="price-text">Rp<?php echo number_format($product['price'], 0, ',', '.'); ?></p>
                <p><?php echo nl2br(htmlspecialchars($product['detail'])); ?></p>
                <p><strong>Stock:</strong> <?php echo htmlspecialchars($product['stock']); ?></p>
            </div>
        </div>

        <hr />

        <h3>Submit Your Review</h3>
        <?php if (isset($error_message)) : ?>
            <div class="alert alert-danger"><?php echo $error_message; ?></div>
        <?php endif; ?>
        <form method="POST" action="product-detail.php?product_id=<?php echo $product_id; ?>">
            <div class="mb-3">
                <label for="user_name" class="form-label">Name</label>
                <input type="text" id="user_name" name="user_name" class="form-control" required />
            </div>
            <div class="mb-3">
                <label for="rating" class="form-label">Rating</label>
                <div id="star-rating" class="star-rating">
                    <input type="radio" id="star5" name="rating" value="5" required /><label for="star5" title="5 stars">&#9733;</label>
                    <input type="radio" id="star4" name="rating" value="4" /><label for="star4" title="4 stars">&#9733;</label>
                    <input type="radio" id="star3" name="rating" value="3" /><label for="star3" title="3 stars">&#9733;</label>
                    <input type="radio" id="star2" name="rating" value="2" /><label for="star2" title="2 stars">&#9733;</label>
                    <input type="radio" id="star1" name="rating" value="1" /><label for="star1" title="1 star">&#9733;</label>
                </div>
            </div>

            <style>
                .star-rating {
                    direction: rtl;
                    font-size: 1.5rem;
                    unicode-bidi: bidi-override;
                    display: inline-block;
                }
                .star-rating input[type="radio"] {
                    display: none;
                }
                .star-rating label {
                    color: #ddd;
                    cursor: pointer;
                }
                .star-rating input[type="radio"]:checked ~ label,
                .star-rating label:hover,
                .star-rating label:hover ~ label {
                    color: #ffc107;
                }
            </style>
            <div class="mb-3">
                <label for="comment" class="form-label">Comment</label>
                <textarea id="comment" name="comment" rows="4" class="form-control" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit Review</button>
        </form>

        <hr />

        <h3>Reviews</h3>
        <?php if (mysqli_num_rows($reviewsQuery) < 1) : ?>
            <p>No reviews yet. Be the first to review this product!</p>
        <?php else : ?>
            <?php while ($review = mysqli_fetch_assoc($reviewsQuery)) : ?>
                <div class="mb-3 border rounded p-3">
                    <strong><?php echo htmlspecialchars($review['user_name']); ?></strong>
                    <span class="text-warning">
                        <?php
                        for ($i = 0; $i < $review['rating']; $i++) {
                            echo "&#9733;"; // star character
                        }
                        for ($i = $review['rating']; $i < 5; $i++) {
                            echo "&#9734;"; // empty star
                        }
                        ?>
                    </span>
                    <p><?php echo nl2br(htmlspecialchars($review['comment'])); ?></p>
                    <small class="text-muted"><?php echo date("F j, Y, g:i a", strtotime($review['created_at'])); ?></small>
                </div>
            <?php endwhile; ?>
        <?php endif; ?>
    </main>

    <?php require "footer.html"; ?>

    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../fontawesome/js/all.min.js"></script>
</body>
</html>
