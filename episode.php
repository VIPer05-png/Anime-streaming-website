<?php
include 'config.php';

if(isset($_GET['id'])) {
    $episodeID = $_GET['id'];
    $sql = "SELECT * FROM episodes WHERE episodeID=$episodeID";
    $result = $conn->query($sql);
    $episode = $result->fetch_assoc();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $episode['title']; ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background-color: #000;
            color: #f8f9fa;
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #1a1a1a;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
            font-size: 2.5rem;
        }

        video {
            width: 100%;
            height: auto;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            margin-bottom: 20px;
        }

        p {
            font-size: 1.2rem;
            line-height: 1.5;
            margin-top: 20px;
        }

        .btn {
            display: block;
            width: 100%;
            padding: 10px;
            margin-top: 30px;
            background-color: #ffc107;
            color: #000;
            text-align: center;
            font-size: 1.2rem;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #e0a800;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1><?php echo $episode['title']; ?></h1>
        <video controls>
            <source src="<?php echo $episode['videoURL']; ?>" type="video/mp4">
            Your browser does not support the video tag.
        </video>
        <p><?php echo $episode['description']; ?></p>
        <a href="anime.php?id=<?php echo $episode['animeID']; ?>" class="btn">Back to Anime</a>
    </div>
</body>
</html>
