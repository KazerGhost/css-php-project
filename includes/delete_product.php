<?php
session_start();
require_once("./db.php");

// check if user is logged in
if (!isset($_SESSION['username'])) {
    die("Access denied. Please log in.");
}

// check if a product ID is provided
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Invalid product ID.");
}

$product_id = $_GET['id'];
$username = $_SESSION['username'];

// check if the user is an admin or the owner of the product
if ($_SESSION['username'] === 'admin') {
    // if admin, skip the ownership check, and proceed to delete
    $sql = "SELECT product_image FROM products WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $product_id);
} else {
    // ff not admin, check if the product belongs to the logged-in user
    $sql = "SELECT product_image FROM products WHERE id = ? AND username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $product_id, $username);
}

$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Product not found or unauthorized action.");
}

$row = $result->fetch_assoc();
$product_image = $row['product_image'];

// delete the product from the database
$sql = "DELETE FROM products WHERE id = ?";
if ($_SESSION['username'] !== 'admin') {
    // if not admin, add ownership check condition
    $sql .= " AND username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $product_id, $username);
} else {
    // if admin, no need for ownership check
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $product_id);
}

if ($stmt->execute()) {
    // delete the product image file
    $image_path = "uploads/" . $product_image;
    if (file_exists($image_path)) {
        unlink($image_path);
    }

    // redirect the user back to the home page
    header("Location: ../index.php?message=Product deleted successfully");
    exit();
} else {
    die("Error deleting product.");
}
?>
