<?php
include 'config.php';
session_start();

// Check if the user is an admin
if ($_SESSION['role'] != 'admin') {
    header("location: ../index.php");
    exit;
}

$animeID = $_GET['id'];

// Fetch episodes for the selected anime
$sql = "SELECT * FROM episodes WHERE animeID = $animeID ORDER BY episodeNumber";
$result = $conn->query($sql);

// Handle episode deletion
if (isset($_GET['delete'])) {
    $episodeID = $_GET['delete'];
    $deleteSQL = "DELETE FROM episodes WHERE episodeID = $episodeID";
    if ($conn->query($deleteSQL) === TRUE) {
        echo "<p style='color: #4CAF50;'>Episode deleted successfully!</p>";
    } else {
        echo "<p style='color: #f44336;'>Error deleting episode: " . $conn->error . "</p>";
    }
    // Refresh the page to update the episode list
    header("Location: admin_view_episodes.php?id=$animeID");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>View Episodes</title>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #121212;
            color: #f5f5f5;
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #444;
        }
        th {
            background-color: #333;
        }
        tr:hover {
            background-color: #444;
        }
        a {
            color: #ff5722;
            text-decoration: none;
            transition: color 0.3s;
        }
        a:hover {
            color: #ff8a50;
        }
        .delete {
            color: #f44336;
        }
    </style>
</head>
<body>
    <h1>View Episodes</h1>
    <a href="admin_dashboard.php">Back to Dashboard</a>
    <table>
        <tr>
            <th>Episode Number</th>
            <th>Title</th>
            <th>Actions</th>
        </tr>
        <?php
        // Display each episode in a table row
        while($episode = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $episode['episodeNumber'] . "</td>";
            echo "<td>" . $episode['title'] . "</td>";
            echo "<td><a href='?id=$animeID&delete=" . $episode['episodeID'] . "' class='delete'>Delete</a></td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>
