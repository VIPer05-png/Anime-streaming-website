<?php
include 'config.php';
session_start();

if ($_SESSION['role'] != 'admin') {
    header("location: ../index.php");
    exit;
}

if(isset($_GET['id'])) {
    $animeID = $_GET['id'];
    echo "<script>
    if (confirm('Are you sure you want to delete this item?')) {
        window.location.href = 'admin_delete_anime.php?confirm=true&id=$animeID';
    } else {
        window.location.href = 'index.php';
    }
    </script>";
}

if(isset($_GET['confirm']) && $_GET['confirm'] == 'true' && isset($_GET['id'])) {
    $animeID = $_GET['id'];

    $sql = "DELETE FROM anime WHERE animeID=$animeID";
    if ($conn->query($sql) === TRUE) {
        header("location: index.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
