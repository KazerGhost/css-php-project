<?php
session_start(); // Start the session to access session data
?>

<nav>
    <div class="brand">User Refurbished</div>
    <div class="links">
        <a href="./index.php">Home</a>
        <a href="./about.php">About</a>

        <?php
        //  if user is logged in, show "Create", "Logout", and "Manage Users" if admin
        if (isset($_SESSION["username"])) {
            echo '<a href="./createPost.php">Create</a>';
            if ($_SESSION["username"] === "admin") {
                echo '<a href="./manage_users.php">Admin</a>';
            }
            echo '<a href="./includes/logout.php">Logout</a>';
        } else {
            // if user is not logged in, show "Login" and "Register"
            echo '<a href="./register.php">Register</a>';
            echo '<a href="./login.php">Login</a>';
        }
        ?>
    </div>
</nav>
