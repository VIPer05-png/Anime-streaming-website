<?php
include 'config.php';
session_start();

if (!isset($_SESSION['username'])) {
    header("location: login.php");
    exit;
}

$username = $_SESSION['username'];
$sql = "SELECT * FROM users WHERE username='$username'";
$result = $conn->query($sql);
$user = $result->fetch_assoc();

$sql = "SELECT anime.* FROM watchlist JOIN anime ON watchlist.animeID = anime.animeID WHERE watchlist.userID=" . $user['userID'];
$watchlist = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $user['username']; ?>'s Profile</title>
    <style>
        body {
            background-color: #000000;
            color: #f5f5f5;
            font-family: 'Poppins', sans-serif;
            padding: 20px;
            margin: 0;
        }

        h1, h2 {
            text-align: center;
            color: #f5f5f5;
            margin-bottom: 20px;
        }

        .watchlist {
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
            color: #ffc107;
        }

        .anime a {
            display: inline-block;
            width: 80%;
            padding: 10px;
            margin: 10px 10%;
            text-align: center;
            background: #ff5722;
            color: #fff;
            border-radius: 4px;
            transition: background 0.3s;
            text-decoration: none;
        }

        .anime a:hover {
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
    <h1><?php echo $user['username']; ?>'s Profile</h1>
    <h2>Watchlist</h2>
    <div class="watchlist">
        <?php
        while($anime = $watchlist->fetch_assoc()) {
            echo "<div class='anime'>";
            echo "<img src='" . $anime['thumbnailURL'] . "' alt='" . $anime['title'] . "'>";
            echo "<h2>" . $anime['title'] . "</h2>";
            echo "<a href='anime.php?id=" . $anime['animeID'] . "'>View Details</a>";
            echo "</div>";
        }
        ?>
    </div>
</body>
</html>
