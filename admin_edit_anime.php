<?php
include 'config.php';
session_start();

if ($_SESSION['role'] != 'admin') {
    header("location: ../index.php");
    exit;
}

if(isset($_GET['id'])) {
    $animeID = $_GET['id'];
    $sql = "SELECT * FROM anime WHERE animeID=$animeID";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    }
}

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $animeID = $_POST['animeID'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $thumbnailURL = $_POST['thumbnail'];

    $sql = "UPDATE anime SET title='$title', description='$description', thumbnailURL='$thumbnailURL' WHERE animeID=$animeID";
   
    

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
    <title>Edit Anime</title>
    <style>/* General body styling */
body {
    background-color: #000000; /* Black background */
    color: #ffffff; /* White text color for contrast */
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
}

/* Header styling */
h2 {
    color: #ffa500; /* Orange color */
    text-align: center;
    margin-top: 20px;
}

/* Form styling */
form {
    width: 80%;
    max-width: 600px;
    margin: 0 auto;
    background-color: #333333; /* Dark grey background for form */
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
}

/* Label styling */
label {
    display: block;
    margin-bottom: 10px;
    color: #ffa500; /* Orange color */
}

/* Input and textarea styling */
input[type="text"], textarea {
    width: calc(100% - 20px);
    padding: 10px;
    border: 1px solid #ffa500; /* Orange border */
    border-radius: 4px;
    background-color: #000000; /* Black background for input fields */
    color: #ffffff; /* White text color */
    margin-bottom: 15px;
}

input[type="submit"] {
    background-color: #ffa500; /* Orange background */
    color: #000000; /* Black text color */
    border: none;
    padding: 10px 20px;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
}

input[type="submit"]:hover {
    background-color: #e59400; /* Darker orange on hover */
}

input[type="submit"]:focus {
    outline: none; /* Remove default focus outline */
    box-shadow: 0 0 5px rgba(255, 165, 0, 0.8); /* Glow effect */
}
</style>
</head>
<body>
    <h2>Edit Anime</h2>
    <form method="post" enctype="multipart/form-data">
        <input type="hidden" name="animeID" value="<?php echo $row['animeID']; ?>">
        <label>Title:</label>
        <input type="text" name="title" value="<?php echo $row['title']; ?>" required><br>
        <label>Description:</label>
        <textarea name="description" required><?php echo $row['description']; ?></textarea><br>
        <label>Thumbnail:</label>
        <textarea name="thumbnail"></textarea><br><br>
        <input type="submit" value="Update Anime">
    </form>
</body>
</html>
