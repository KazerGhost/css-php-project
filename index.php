<?php
session_start(); // load session data
require_once("./includes/db.php");

// check if a category is selected
$category = isset($_GET['category']) ? $_GET['category'] : '';

// get products from the database with filtering if a category is selected
if (!empty($category)) {
    $sql = "SELECT * FROM products WHERE category = ? ORDER BY id DESC";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $category);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $sql = "SELECT * FROM products ORDER BY id DESC";
    $result = $conn->query($sql);
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Buy and sell electronics like smartphones, tablets, laptops, and accessories.">
    <meta name="keywords" content="electronics, smartphones, tablets, laptops, accessories, buy, sell">
    <meta name="author" content="User Refurbished">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Funnel+Display:wght@300..800&family=Lexend+Giga:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/styles.css">
    <title>Home Page</title>
</head>
<body>
<?php include("./includes/nav.php"); ?>
<?php include("./includes/header.php"); ?>

<main>
    <div class="left">
        <div class="section-title">Categories</div>
        <a href="./index.php">All</a>
        <a href="?category=tablets">Tablets</a>
        <a href="?category=smartphones">Phones</a>
        <a href="?category=laptops">Computers</a>
        <a href="?category=accessories">Accessories</a>
        <a href="?category=wearables">Wearables</a>
    </div>
    <div class="right">
        <div class="section-title">Home Page</div>

        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="product">
                    <div class="product-left">
                        <img src="uploads/<?php echo htmlspecialchars($row['product_image']); ?>" alt="<?php echo htmlspecialchars($row['product_name']); ?>">
                    </div>
                    <div class="product-right">
                        <p class="title"><?php echo htmlspecialchars($row['product_name']); ?></p>
                        <p class="description"><?php echo htmlspecialchars($row['product_description']); ?></p>
                        <div class="price-delete">
                            <p class="price">$<?php echo number_format($row['product_price'], 2); ?></p>
                            <?php if (isset($_SESSION['username']) && ($_SESSION['username'] === $row['username'] || $_SESSION['username'] === 'admin')): ?>
                                <a href="./includes/edit_product.php?id=<?php echo $row['id']; ?>">Edit</a>
                                <a href="./includes/delete_product.php?id=<?php echo $row['id']; ?>">Delete</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No products available in this category.</p>
        <?php endif; ?>
    </div>
</main>

<?php include("./includes/footer.php"); ?>
</body>
</html>
