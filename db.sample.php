<?php
$host = "localhost";
$username = "your_username_here";
$password = "your_password_here";
$database = "your_database_name_here";

// Connection example (MAMP default port might be 8889)
$connection = mysqli_connect($host, $username, $password, $database, 8889);

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
