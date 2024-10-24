<?php
$servername = "localhost";
$username = "Root";
$password = "";
$dbname = "anime_stream";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


?>
