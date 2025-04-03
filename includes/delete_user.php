<?php
session_start();
require_once("../includes/db.php"); // database connection

// check if the admin is logged in
if (!isset($_SESSION['username']) || $_SESSION['username'] !== 'admin') {
    // if not, send user to login page or show an error message
    header("Location: ../login.php");
    exit();
}

// check if 'id' is set in the URL
if (isset($_GET['id'])) {
    $user_id = $_GET['id'];

    // sanitize the ID
    $user_id = $conn->real_escape_string($user_id);

    // prepare the delete query
    $sql = "DELETE FROM users WHERE id = '$user_id'";

    // run the query
    if ($conn->query($sql) === TRUE) {
        // redirect to the user management page with a success message
        header("Location: ../manage_users.php?message=User deleted successfully");
        exit();
    } else {
        // if there's an error, show the error message
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    // if 'id' is not set, redirect to the manage users page
    header("Location: ../manage_users.php");
    exit();
}
?>
