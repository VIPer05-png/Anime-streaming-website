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
    <style>
        /* Existing styles... */
        body, h1, h2, a {
            margin: 0;
            padding: 0;
            text-decoration: none;
            color: inherit;
            font-family: 'Roboto', sans-serif;
        }

        body {
            background-color: #000000;
            color: #f5f5f5;
            padding: 20px;
            position: relative;
        }

        h1 {
            text-align: center;
            font-size: 2.5em;
            margin-bottom: 20px;
        }

        h2 {
            font-size: 1.5em;
            margin: 20px 0;
        }

        a {
            color: #ff5722;
            font-weight: bold;
            transition: color 0.3s;
        }

        a:hover {
            color: #ff8a50;
        }

        .logout {
            position: absolute;
            top: 20px;
            right: 20px;
            padding: 10px 20px;
            background-color: #ff5722;
            color: #fff;
            border-radius: 5px;
            transition: background-color 0.3s;
            text-decoration: none;
            font-weight: bold;
        }

        .logout:hover {
            background-color: #ff8a50;
        }

        .anime-list {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
        }

        .anime {
            background: #1a1a1a;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            margin: 15px;
            width: calc(33% - 30px);
            transition: transform 0.3s, background 0.3s;
        }

        .anime img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .anime h2 {
            padding: 10px;
            font-size: 1.2em;
            text-align: center;
        }

        .anime a {
            display: inline-block;
            width: 45%;
            padding: 10px;
            text-align: center;
            margin: 5px 2.5%;
            background: #ff5722;
            color: #fff;
            border-radius: 4px;
            transition: background 0.3s;
        }

        .anime a:hover {
            background: #ff8a50;
        }

        .anime .actions {
            display: flex;
            justify-content: center;
            padding: 10px;
        }

        .anime .actions a {
            display: inline-block;
            width: auto;
            padding: 10px 15px;
            margin: 0 5px;
            background: #ff5722;
            color: #fff;
            border-radius: 4px;
            transition: background 0.3s;
        }

        .anime .actions a:hover {
            background: #ff8a50;
        }

        @media (max-width: 768px) {
            .anime {
                width: calc(50% - 30px);
            }
        }

        @media (max-width: 480px) {
            .anime {
                width: calc(100% - 30px);
            }
        }
    </style>
</head>
<body>
    <a href="admin_logout.php" class="logout">Logout</a>
    <h1>Admin Dashboard</h1>
    <h2>Manage Anime</h2>
    <a href="admin_add_anime.php">Add Anime</a>
    <div class="anime-list">
        <?php
        // Display each anime as a div
        while($row = $result->fetch_assoc()) {
            echo "<div class='anime'>";
            echo "<img src='" . $row['thumbnailURL'] . "' alt='" . $row['title'] . "'>";
            echo "<h2>" . $row['title'] . "</h2>";
            echo "<div class='actions'>";
            echo "<a href='admin_edit_anime.php?id=" . $row['animeID'] . "'>Edit</a>";
            echo "<a href='admin_delete_anime.php?id=" . $row['animeID'] . "'>Delete</a>";
            echo "<a href='admin_add_episode.php?id=" . $row['animeID'] . "'>Add Episodes</a>";
            echo "<a href='admin_view_episodes.php?id=" . $row['animeID'] . "'>View Episodes</a>"; // New link to view episodes
            echo "</div>";
            echo "</div>";
        }
        ?>
    </div>
</body>
</html>
