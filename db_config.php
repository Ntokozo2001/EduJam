<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "biweek";

// Improved error message for connection issues
$conn = @new mysqli($servername, $username, $password, $dbname, 3307);

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error . "<br>
    Please make sure your MySQL server is running and the database settings in db_config.php are correct.");
}
?>
