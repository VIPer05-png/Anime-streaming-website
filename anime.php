<?php
include 'config.php';

if(isset($_GET['id'])) {
    $animeID = $_GET['id'];
    $sql = "SELECT * FROM anime WHERE animeID=$animeID";
    $result = $conn->query($sql);
    $anime = $result->fetch_assoc();

    // Query to get episodes grouped by season
    $sql = "SELECT * FROM episodes WHERE animeID=$animeID ORDER BY seasonNumber, episodeNumber";
    $seasons = $conn->query($sql);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $anime['title']; ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            color: #f0f0f0;
            background-color: #121212; 
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
        }

        h1 {
            font-size: 2.5em;
            margin-top: 20px;
            text-align: center;
            color: #ff8a50;
        }

        h2 {
            font-size: 2em;
            margin-top: 20px;
            text-align: center;
            border-bottom: 2px solid #444;
            padding-bottom: 10px;
            color: #ff8a50;
        }

        .container {
            display: flex;
            align-items: flex-start;
            justify-content: left;
            margin: 40px auto;
            max-width: 1200px;
            padding: 20px;
            background: #1a1a1a;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }

        img {
            max-width: 40%;
            height: auto;
            border-radius: 8px;
            margin-right: 20px;
        }

        .description {
            max-width: 60%;
        }

        p {
            font-size: 1.1em;
            line-height: 1.6;
        }

        a {
            color: #ff5722; 
            text-decoration: none;
            font-weight: bold;
            transition: color 0.3s;
        }

        a:hover {
            color: #ff8a50;
        }

        .episode-list {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            margin: 20px auto;
        }

        .season {
            background: #1a1a1a;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            padding: 15px;
            margin: 10px;
            width: calc(50% - 20px);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .season:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.4);
        }

        .season h3 {
            font-size: 1.2em;
            margin: 0 0 10px;
            color: #ff5722;
        }

        .season a {
            display: inline-block;
            padding: 10px 20px;
            background: #ff5722;
            color: #fff;
            border-radius: 5px;
            text-transform: uppercase;
            transition: background 0.3s;
        }

        .season a:hover {
            background: #ff8a50;
        }

        @media (max-width: 768px) {
            img {
                max-width: 80%;
                margin-right: 0;
            }

            .description {
                max-width: 100%;
            }

            .season {
                width: calc(100% - 20px);
            }
        }
    </style>
</head>
<body>
    <h1><?php echo $anime['title']; ?></h1>
    <div class="container">
        <img src="<?php echo $anime['thumbnailURL']; ?>" alt="<?php echo $anime['title']; ?>">
        <div class="description">
            <p><?php echo $anime['description']; ?></p>
        </div>
    </div>
    <h2>Seasons</h2>
    <div class="episode-list">
        <?php
        while($season = $seasons->fetch_assoc()) {
            echo "<div class='season'>";
            echo "<h3>Season " . $season['seasonNumber'] . ", Episode " . $season['episodeNumber'] . ": " . $season['title'] . "</h3>";
            echo "<a href='episode.php?id=" . $season['episodeID'] . "'>Watch Now</a>";
            echo "</div>";
        }
        ?>
    </div>
</body>
</html>
