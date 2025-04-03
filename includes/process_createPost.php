<?php
session_start();
include("./db.php"); // database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // get and sanitize inputs
    $product_name = trim($_POST["product_name"]);
    $product_description = trim($_POST["product_description"]);
    $product_price = $_POST["product_price"];
    $category = $_POST["category"];
    $username = $_SESSION["username"]; // logged-in user

    // check if an image was uploaded
    if (!isset($_FILES["product_image"]) || $_FILES["product_image"]["error"] == 4) {
        die("Error: No image uploaded.");
    }

    // file upload settings
    $upload_dir = "../uploads/";  // folder to store images
    $product_image = basename($_FILES["product_image"]["name"]); // get original filename
    $imageFileType = strtolower(pathinfo($product_image, PATHINFO_EXTENSION)); // get file extension

    // generate a unique filename
    $product_image = uniqid("img_") . "." . $imageFileType;
    $upload_file = $upload_dir . $product_image;

    // all allowed image types
    $allowedTypes = ["jpg", "jpeg", "png", "gif", "webp"];
    if (!in_array($imageFileType, $allowedTypes)) {
        die("Error: Invalid file type. Only JPG, JPEG, PNG, GIF, & WEBP allowed.");
    }

    // move file to uploads directory
    if (!move_uploaded_file($_FILES["product_image"]["tmp_name"], $upload_file)) {
        die("Error: Failed to upload image.");
    }

    // add product data into the database
    $sql = "INSERT INTO products (product_name, product_description, product_price, category, product_image, username) 
            VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssdsss", $product_name, $product_description, $product_price, $category, $product_image, $username);

    if ($stmt->execute()) {
        echo "Product created successfully!";
    } else {
        die("Error: Failed to insert product into database.");
    }

    // redirect to index.php
    header("Location: ../index.php");
    exit();
}
?>
