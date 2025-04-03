<?php
session_start();
include("./db.php"); // database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize inputs
    $username = trim($_POST["username"]);
    $password = $_POST["password"];

    // create error message variable
    $error_message = "";

    // validate the username
    if (empty($username)) {
        $error_message = "Username is required.";
    }

    // validate the password
    if (empty($password)) {
        $error_message = "Password is required.";
    }

    // if no errors, proceed with login
    if (empty($error_message)) {
        // Query the database for the username
        $sql = "SELECT * FROM users WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();

            // verify password with password_verify()
            if (password_verify($password, $user["password"])) {
                // Successful login
                $_SESSION["username"] = $username;
                header("Location: ../index.php"); // redirect to home page
                exit;
            } else {
                $error_message = "Invalid password.";
            }
        } else {
            $error_message = "No user found with that username.";
        }
    }

    // if there was an error, store it in the session and redirect back to login page
    if (!empty($error_message)) {
        $_SESSION["error_message"] = $error_message;
        header("Location: ../login.php"); // redirect back to login page with error message
        exit;
    }
}
?>
