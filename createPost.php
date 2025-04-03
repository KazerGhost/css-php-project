<?php
session_start(); // load session data

if (!isset($_SESSION["username"])) {
    header("Location: login.php"); // sent to login page if not logged in
    exit();
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
    <link rel="stylesheet" href="./css/register.css">
    <title>Create Product Post</title>
</head>
<body>

<?php include("./includes/nav.php"); ?>

<main>
    <div class="register-form">
        <h2>Create Product Post</h2>
        <form action="./includes/process_createPost.php" method="post" enctype="multipart/form-data">

            <!-- Product Name -->
            <label for="product_name">Product Name:</label>
            <input type="text" id="product_name" name="product_name" required>

            <!-- Product Description -->
            <label for="product_description">Product Description:</label>
            <textarea id="product_description" name="product_description" required></textarea>

            <!-- Product Price -->
            <label for="product_price">Price:</label>
            <input type="number" id="product_price" name="product_price" step="0.01" required>

            <!-- Electronics Categories (Dropdown) -->
            <label for="category">Category:</label>
            <select id="category" name="category" required>
                <option value="" disabled selected>Select an option</option>
                <option value="smartphones">Smartphones</option>
                <option value="tablets">Tablets</option>
                <option value="laptops">Laptops</option>
                <option value="accessories">Accessories</option>
                <option value="wearables">Wearables</option>
            </select>

            <!-- Product Image Upload -->
            <label for="product_image">Product Image:</label>
            <input type="file" id="product_image" name="product_image" accept="image/*" required>

            <button type="submit">Create Product Post</button>
        </form>
    </div>
</main>

<?php include("./includes/footer.php"); ?>

</body>
</html>
