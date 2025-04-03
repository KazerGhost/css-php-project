<?php
$host = "localhost";
$user = "root";
$pass = "mysql";
$dbname = "tech_marketplace"; // database name

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

