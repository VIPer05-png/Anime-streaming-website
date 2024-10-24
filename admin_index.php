<?php
include 'config.php';
session_start();

// Check if the user is an admin
if ($_SESSION['role'] != 'admin') {
    header("location: ../index.php");
    exit;
}

// Retrieve anime data from the database
$sql = "SELECT * FROM anime";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
</head>
<body>
    <h1>Admin Dashboard</h1>
    <h2>Manage Anime</h2>
    <a href="admin_add_anime.php">Add Anime</a>
    <div class="anime-list">
        <?php
        // Display each anime as a div
        while($row = $result->fetch_assoc()) {
            echo "<div class='anime'>";
            echo "<img src='../" . $row['thumbnailURL'] . "' alt='" . $row['title'] . "'>";
            echo "<h2>" . $row['title'] . "</h2>";
            echo "<a href='admin_edit_anime.php?id=" . $row['animeID'] . "'>Edit</a> | ";
            echo "<a href='admin_delete_anime.php?id=" . $row['animeID'] . "'>Delete</a>";
            echo "</div>";
        }
        ?>
    </div>
</body>
</html>

