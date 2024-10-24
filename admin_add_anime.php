<?php
include 'config.php';
session_start();

if ($_SESSION['role'] != 'admin') {
    header("location: ../index.php");
    exit;
}

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $thumbnailURL = $_POST['thumbnail'];

    $sql = "INSERT INTO anime (title, description, thumbnailURL) VALUES ('$title', '$description', '$thumbnailURL')";
    
    if ($conn->query($sql) === TRUE) {
        header("location: index.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Anime</title>
    <style>
        body {
            background-color: #121212; /* Dark background for a modern look */
            color: #ffffff; /* Light text for better contrast */
            font-family: 'Arial', sans-serif; /* Clean and modern font */
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column; /* Arrange content in a column */
        }

        h2 {
            font-size: 28px;
            margin-bottom: 20px;
            color: #ffa500; /* Orange color to match your theme */
        }

        form {
            background-color: #1e1e1e; /* Slightly lighter background for the form */
            padding: 20px 40px 20px 20px; /* Adjust right padding */
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5); /* Subtle shadow for depth */
            width: 100%;
            max-width: 400px;
        }

        label {
            font-size: 16px;
            color: #ffa500; /* Orange color for labels */
            margin-bottom: 10px;
            display: block;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: none;
            border-radius: 5px;
            background-color: #333333; /* Darker input background */
            color: #ffffff; /* White text inside inputs */
            font-size: 14px;
        }

        textarea {
            resize: none; /* Prevent resizing for a more consistent layout */
            height: 100px; /* Set a fixed height for the textarea */
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #ffa500; /* Orange button */
            color: #ffffff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #ff8c00; /* Slightly darker orange on hover */
        }

    </style>
</head>
<body>
    <h2>Add Anime</h2>
    <form method="post" enctype="multipart/form-data">
        <label>Title:</label>
        <input type="text" name="title" required><br>
        <label>Description:</label>
        <textarea name="description" required></textarea><br>
        <label>Thumbnail URL:</label>
        <input type="text" name="thumbnail" required><br>
        <input type="submit" value="Add Anime">
    </form>
</body>
</html>
