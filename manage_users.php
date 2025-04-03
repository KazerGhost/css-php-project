<?php
session_start();
require_once("./includes/db.php"); // database connection

// get all users from the database
$sql = "SELECT id, username FROM users ORDER BY id ASC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Buy and sell electronics like smartphones, tablets, laptops, and accessories.">
    <meta name="keywords" content="electronics, smartphones, tablets, laptops, accessories, buy, sell">
    <meta name="author" content="User Refurbished">
    <title>Manage Users</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Funnel+Display:wght@300..800&family=Lexend+Giga:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/styles.css">
    <link rel="stylesheet" href="./css/admin.css">
</head>
<body>
    <?php include("./includes/nav.php"); ?>
    <div>
        <h2 style="text-align: center;">User Management</h2>
        <table>
            <tr>
                <th>User ID</th>
                <th>Username</th>
                <th>Actions</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['id']); ?></td>
                    <td><?php echo htmlspecialchars($row['username']); ?></td>
                    <td>
                        <?php if (isset($_SESSION['username']) && $_SESSION['username'] === 'admin'): ?>
                            <a class="delete-btn" href="./includes/delete_user.php?id=<?php echo $row['id']; ?>">Delete</a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>
    <?php include("./includes/footer.php"); ?>
</body>
</html>
