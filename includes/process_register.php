<?php
session_start();
include("./db.php"); // database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // get and sanitize inputs
    $username = trim($_POST["username"]);
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    // create error message variable
    $error_message = "";

    // validate username
    if (empty($username)) {
        $error_message = "Username is required.";
    } elseif (strlen($username) < 5) {
        $error_message = "Username must be at least 5 characters long.";
    }

    // validate password
    if (empty($password)) {
        $error_message = "Password is required.";
    } elseif (strlen($password) < 8) {
        $error_message = "Password must be at least 8 characters long.";
    }

    // check if passwords match
    if ($password !== $confirm_password) {
        $error_message = "Passwords do not match.";
    }

    // If no errors, proceed
    if (empty($error_message)) {
        // check if username already exists
        $sql = "SELECT * FROM users WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $error_message = "Username already taken.";
        } else {
            // Hash the password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // create new user into database
            $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $username, $hashed_password);
            $stmt->execute();

            // successful registration
            $_SESSION["username"] = $username;  // Log the user in
            header("Location: ../login.php"); // send to login page
            exit;
        }
    }

    // ff there was an error, store it in the session and display it on the form
    if (!empty($error_message)) {
        $_SESSION["error_message"] = $error_message;
        header("Location: ../register.php"); // send back to register page with an error message
        exit;
    }
}
?>
