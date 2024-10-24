<?php
session_start();

// Check if the user is an admin
if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
    // Unset all session variables related to the admin
    session_unset();

    // Destroy the session if necessary
    session_destroy();

    // Redirect to the admin login page or homepage
    header("location: admin_login.php"); // Change this to the appropriate page
    exit;
} else {
    // If the user is not an admin, redirect to the homepage or user dashboard
    header("location: ../index.php"); // Change this to the appropriate page
    exit;
}
