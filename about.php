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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Funnel+Display:wght@300..800&family=Lexend+Giga:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/styles.css">
    <link rel="stylesheet" href="./css/about.css">
    <title>About</title>
</head>
<body>

    <?php include("./includes/nav.php"); ?>

    <main>
        <div class="about-main">
            <h2>About Us</h2>
            <p> Welcome to <em>User Refurbished</em>, the go-to marketplace for buying and selling used   tech. Whether you're upgrading your phone, looking for a budget-friendly laptop,    or giving your old tablet a second life, we make it easy to connect with buyers     and sellers in a safe, hassle-free way.

                Our platform is designed to help people sell their used phones, tablets, and
                computers without the stress of dealing with shady marketplaces. We prioritize security, transparency, and ease of use, ensuring you get the best deals with confidence.

                Join us and turn your old tech into cash—or find a great deal on a pre-loved device today! </p>
        </div>
    </main>

    <?php include("./includes/footer.php"); ?>

</body>
</html>

