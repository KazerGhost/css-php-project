<?php
session_start(); // load session data
require_once("./db.php");

if (!isset($_SESSION["username"])) {
    header("Location: ../login.php"); // send user to login page if not logged in
    exit();
}

// check if product ID is provided
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Invalid product ID.");
}

$product_id = $_GET['id'];
$username = $_SESSION['username'];

// get the product details
$sql = ($_SESSION['username'] === 'admin') ?
    "SELECT * FROM products WHERE id = ?" :
    "SELECT * FROM products WHERE id = ? AND username = ?";

$stmt = $conn->prepare($sql);

if ($_SESSION['username'] === 'admin') {
    $stmt->bind_param("i", $product_id);
} else {
    $stmt->bind_param("is", $product_id, $username);
}

$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Product not found or unauthorized action.");
}

$product = $result->fetch_assoc();

// handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST['product_name'];
    $description = $_POST['product_description'];
    $price = $_POST['product_price'];
    $category = $_POST['category'];

    $update_sql = "UPDATE products SET product_name = ?, product_description = ?, product_price = ?, category = ? WHERE id = ?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("ssdsi", $name, $description, $price, $category, $product_id);

    if ($update_stmt->execute()) {
        header("Location: ../index.php?message=Product updated successfully");
        exit();
    } else {
        echo "Error updating product.";
    }
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
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/register.css">
    <title>Edit Product</title>
</head>
<body>

<?php include("./nav.php"); ?>

<main>
    <div class="register-form">
        <h2>Edit Product</h2>
        <form action="" method="post">
            <label for="product_name">Product Name:</label>
            <input type="text" id="product_name" name="product_name" value="<?php echo htmlspecialchars($product['product_name']); ?>" required>

            <label for="product_description">Product Description:</label>
            <textarea id="product_description" name="product_description" required><?php echo htmlspecialchars($product['product_description']); ?></textarea>

            <label for="product_price">Price:</label>
            <input type="number" id="product_price" name="product_price" step="0.01" value="<?php echo htmlspecialchars($product['product_price']); ?>" required>

            <label for="category">Category:</label>
            <select id="category" name="category" required>
                <option value="" disabled>Select an option</option>
                <option value="smartphones" <?php echo ($product['category'] === 'smartphones') ? 'selected' : ''; ?>>Smartphones</option>
                <option value="tablets" <?php echo ($product['category'] === 'tablets') ? 'selected' : ''; ?>>Tablets</option>
                <option value="laptops" <?php echo ($product['category'] === 'laptops') ? 'selected' : ''; ?>>Laptops</option>
                <option value="accessories" <?php echo ($product['category'] === 'accessories') ? 'selected' : ''; ?>>Accessories</option>
                <option value="wearables" <?php echo ($product['category'] === 'wearables') ? 'selected' : ''; ?>>Wearables</option>
            </select>

            <button type="submit">Update Product</button>
        </form>
    </div>
</main>

<?php include("./footer.php"); ?>

</body>
</html>
