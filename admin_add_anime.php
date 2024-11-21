<?php
// Include database configuration
include 'config.php';
session_start();

// Ensure the user is an admin
if ($_SESSION['role'] != 'admin') {
    header("location: ../index.php");
    exit;
}

// Process the form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize inputs
    $title = trim(mysqli_real_escape_string($conn, $_POST['title']));
    $description = trim(mysqli_real_escape_string($conn, $_POST['description']));
    $thumbnailURL = trim(mysqli_real_escape_string($conn, $_POST['thumbnail']));

    // Verify inputs are not empty after sanitization
    if (empty($title) || empty($description) || empty($thumbnailURL)) {
        echo "<p style='color: red;'>All fields are required. Please fill in all details.</p>";
    } else {
        // Prepare the SQL query
        $stmt = $conn->prepare("INSERT INTO anime (title, description, thumbnailURL) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $title, $description, $thumbnailURL);

        // Execute the query
        if ($stmt->execute()) {
            header("location: index.php"); // Redirect on success
        } else {
            echo "<p style='color: red;'>Error: " . $stmt->error . "</p>";
        }

        // Close the prepared statement
        $stmt->close();
    }

    // Close the database connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Anime</title>
    <style>
        body {
            background-color: #121212; /* Dark theme */
            color: #ffffff; /* Light text */
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
        }
        h2 {
            font-size: 28px;
            margin-bottom: 20px;
            color: #ffa500; /* Accent color */
        }
        form {
            background-color: #1e1e1e; /* Slightly lighter background for form */
            padding: 25px 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.6); /* Soft shadow for depth */
            width: 90%;
            max-width: 400px;
        }
        label {
            font-size: 16px;
            color: #ffa500;
            margin-bottom: 10px;
            display: block;
        }
        input[type="text"], textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: none;
            border-radius: 5px;
            background-color: #333333; /* Input field background */
            color: #ffffff; /* White text in input */
            font-size: 14px;
            box-sizing: border-box; /* Consistent sizing */
        }
        textarea {
            resize: none;
            height: 100px;
        }
        input[type="submit"] {
            width: 100%;
            padding: 12px;
            background-color: #ffa500; /* Submit button */
            color: #ffffff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
        }
        input[type="submit"]:hover {
            background-color: #ff8c00; /* Hover effect */
        }
        p {
            font-size: 14px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <h2>Add Anime</h2>
    <form method="post">
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" required>
        
        <label for="description">Description:</label>
        <textarea id="description" name="description" required></textarea>
        
        <label for="thumbnail">Thumbnail URL:</label>
        <input type="text" id="thumbnail" name="thumbnail" required>
        
        <input type="submit" value="Add Anime">
    </form>
</body>
</html>
