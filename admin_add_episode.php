<?php
include 'config.php';
session_start();

// Check if the user is an admin
if ($_SESSION['role'] != 'admin') {
    header("location: ../index.php");
    exit;
}

if (isset($_POST['submit'])) {
    $animeID = mysqli_real_escape_string($conn, $_POST['animeID']);
    $seasonNumbers = $_POST['seasonNumber'];
    $episodeNumbers = $_POST['episodeNumber'];
    $titles = $_POST['title'];
    $videoURLs = $_POST['videoURL'];
    $descriptions = $_POST['description'];

    for ($i = 0; $i < count($episodeNumbers); $i++) {
        $seasonNumber = mysqli_real_escape_string($conn, $seasonNumbers[$i]);
        $episodeNumber = mysqli_real_escape_string($conn, $episodeNumbers[$i]);
        $title = mysqli_real_escape_string($conn, $titles[$i]);
        $videoURL = mysqli_real_escape_string($conn, $videoURLs[$i]);
        $description = mysqli_real_escape_string($conn, $descriptions[$i]);

        $sql = "INSERT INTO episodes (animeID, seasonNumber, episodeNumber, title, videoURL, description) 
                VALUES ('$animeID', '$seasonNumber', '$episodeNumber', '$title', '$videoURL', '$description')";
        $conn->query($sql);
    }

    $successMessage = "Episodes added successfully!";
}

// Fetch all anime for the dropdown
$sql = "SELECT animeID, title FROM anime";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Episodes</title>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #1e1e2d;
            color: #f5f5f5;
            padding: 20px;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form-container {
            width: 100%;
            max-width: 900px;
            background: #2c2c3c;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 26px;
            color: #ff5722;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-size: 14px;
            margin-bottom: 8px;
            color: #f5f5f5;
        }

        input[type="text"],
        textarea,
        select {
            width: 100%;
            padding: 12px;
            background: #2c2c3c;
            border: 1px solid #444;
            border-radius: 8px;
            color: #f5f5f5;
            font-size: 14px;
            transition: border-color 0.3s;
        }

        input[type="text"]:focus,
        textarea:focus,
        select:focus {
            border-color: #ff5722;
            outline: none;
        }

        textarea {
            resize: vertical;
        }

        button {
            display: block;
            width: 100%;
            padding: 12px;
            background-color: #ff5722;
            color: #fff;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #e64a19;
        }

        .add-more {
            display: block;
            margin: 15px 0;
            text-align: center;
            color: #4fc3f7;
            cursor: pointer;
            font-size: 14px;
            transition: color 0.3s;
        }

        .add-more:hover {
            color: #00bcd4;
        }

        .form-group + .form-group {
            border-top: 1px solid #444;
            padding-top: 15px;
        }

        .success-message {
            background-color: #4caf50;
            color: #fff;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>Add Episodes</h1>
        <?php if (isset($successMessage)): ?>
            <div class="success-message"><?php echo $successMessage; ?></div>
        <?php endif; ?>
        <form method="POST" action="">
            <div class="form-group">
                <label for="animeID">Select Anime:</label>
                <select id="animeID" name="animeID" required>
                    <option value="">Select Anime</option>
                    <?php
                    while ($anime = $result->fetch_assoc()) {
                        echo "<option value='" . $anime['animeID'] . "'>" . $anime['title'] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div id="episodes-container">
                <div class="form-group">
                    <label for="seasonNumber[]">Season Number:</label>
                    <input type="text" name="seasonNumber[]" required>

                    <label for="episodeNumber[]">Episode Number:</label>
                    <input type="text" name="episodeNumber[]" required>

                    <label for="title[]">Title:</label>
                    <input type="text" name="title[]" required>

                    <label for="videoURL[]">Video URL:</label>
                    <input type="text" name="videoURL[]" required>

                    <label for="description[]">Description:</label>
                    <textarea name="description[]" rows="4"></textarea>
                </div>
            </div>
            <div class="add-more">+ Add More Episodes</div>
            <button type="submit" name="submit">Add Episodes</button>
        </form>
    </div>

    <script>
        document.querySelector('.add-more').addEventListener('click', function() {
            const episodeContainer = document.getElementById('episodes-container');
            const episodeGroup = document.createElement('div');
            episodeGroup.classList.add('form-group');
            episodeGroup.innerHTML = `
                <label for="seasonNumber[]">Season Number:</label>
                <input type="text" name="seasonNumber[]" required>

                <label for="episodeNumber[]">Episode Number:</label>
                <input type="text" name="episodeNumber[]" required>

                <label for="title[]">Title:</label>
                <input type="text" name="title[]" required>

                <label for="videoURL[]">Video URL:</label>
                <input type="text" name="videoURL[]" required>

                <label for="description[]">Description:</label>
                <textarea name="description[]" rows="4"></textarea>
            `;
            episodeContainer.appendChild(episodeGroup);
        });
    </script>
</body>
</html>
