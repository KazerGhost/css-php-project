<?php
session_start(); // load session data
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Buy and sell electronics like smartphones, tablets, laptops, and accessories.">
    <meta name="keywords" content="electronics, smartphones, tablets, laptops, accessories, buy, sell">
    <meta name="author" content="User Refurbished">
    <title>Register</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Funnel+Display:wght@300..800&family=Lexend+Giga:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/styles.css">
    <link rel="stylesheet" href="./css/register.css">

</head>
<body>

    <?php include("./includes/nav.php"); ?>

    <main>
        <div class="register-form">
            <h2>Register</h2>

            <!-- show error message if any -->
            <?php if (isset($_SESSION["error_message"])): ?>
                <div class="error-message" style="color: red;">
                    <?php echo $_SESSION["error_message"]; ?>
                </div>
                <?php unset($_SESSION["error_message"]); ?> <!-- clear error message after displaying -->
            <?php endif; ?>

            <form action="./includes/process_register.php" method="post">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>

                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>

                <label for="confirm_password">Confirm Password:</label>
                <input type="password" id="confirm_password" name="confirm_password" required>

                <button type="submit">Register</button>
            </form>
        </div>
    </main>

    <?php include("./includes/footer.php"); ?>

</body>
</html>

