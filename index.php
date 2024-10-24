<?php
include 'config.php';
session_start(); // Start the session to access session variables

$sql = "SELECT * FROM anime";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Anime</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <style>
        /* POPPINS FONT */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');

        * {  
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: url("https://th.bing.com/th/id/OIP.gNZv6H-8IwCKFp2CO_0oewHaDt?w=306&h=174&c=7&r=0&o=5&dpr=1.3&pid=1.7") no-repeat center center fixed;
            background-size: cover;
            color: #f8f9fa;
        }

        .wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: rgba(0, 0, 0, 0.6); /* Darker overlay for better contrast */
            padding: 100px;
        }

        .container {
            margin-top: 20px;
        }

        .nav {
            position: fixed;
            top: 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            height: 100px;
            padding: 0 20px;
            background: rgba(0, 0, 0, 0.8); /* Darker navbar background */
            z-index: 100;
        }

        .nav-logo p a {
            color: #f8f9fa;
            font-size: 25px;
            font-weight: 600;
            text-decoration: none;
        }

        .nav-menu ul {
            display: inline-flex;
            gap: 75px; /* Reduced gap for a cleaner look */
        }

        .nav-menu ul li {
            list-style-type: none;
        }

        .nav-menu ul li .link {
            text-decoration: none;
            font-weight: 500;
            color: #f8f9fa;
            padding-bottom: 10px; /* Reduced padding for a sleeker appearance */
            transition: border-bottom 0.3s ease;
        }

        .link:hover, .active {
            border-bottom: 2px solid #f8f9fa;
        }

        .nav-button {
            display: flex;
            align-items: center;
        }

        .nav-button .username {
            color: #f8f9fa;
            margin-right: 20px;
            font-weight: 600;
        }

        .nav-button .btn {
            width: 130px;
            height: 40px;
            font-weight: 500;
            background: #ffc107; /* Brighter button color for contrast */
            border: none;
            border-radius: 30px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .nav-button a.no-underline {
            text-decoration: none;
            color: #000;
        }

        .btn:hover {
            background: #e0a800;
        }

        #registerBtn {
            margin-left: 15px;
        }

        .nav-menu-btn {
            display: none;
        }

        @media (max-width: 768px) {
            .nav-button {
                display: none;
            }

            .nav-menu ul {
                flex-direction: column;
                align-items: center;
            }

            .nav-menu-btn {
                display: flex;
                align-items: center;
                cursor: pointer;
            }

        .nav-menu-btn i {
            font-size: 25px;
            color: #f8f9fa;
            padding: 10px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            margin-right: 10px; /* Space between icon and label */
            transition: background 0.3s ease;
        }

        .nav-menu-btn .menu-label {
            font-size: 18px; /* Adjust the font size as needed */
            color: #f8f9fa;
        }

        .nav-menu-btn:hover i {
            background: rgba(255, 255, 255, 0.15);
        }


            .nav-menu {
                position: fixed;
                top: 100px;
                right: 0;
                width: 100%;
                height: calc(100vh - 100px);
                background: rgba(0, 0, 0, 0.9); /* Darker background for the mobile menu */
                flex-direction: column;
                align-items: center;
                justify-content: center;
                transform: translateX(100%);
                transition: transform 0.3s ease;
            }

            .nav-menu.active {
                transform: translateX(0);
            }
        }

        .card {
            background-color: #343a40; /* Dark card background */
            color: #f8f9fa;
            height: 100%;
            display: flex;
            flex-direction: column;
            border: none;
            border-radius: 10px;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
        }

        .card-img-top {
            max-height: 200px;
            object-fit: cover;
            border-bottom: 2px solid #ffc107; /* Bright border to add contrast */
        }

        .card-body {
            flex: 1;
            padding: 15px;
        }

        .card-title {
            font-size: 1.25rem;
            margin-bottom: 15px;
        }

        .card .btn-primary {
            background-color: #ffc107;
            border: none;
            color: #000;
            transition: background-color 0.3s ease;
        }

        .card .btn-primary:hover {
            background-color: #e0a800;
        }

        .nav-button .username {
            color: #f8f9fa;
            margin-right: 20px;
            font-weight: 600;
        }
        .footer {
            margin-top: auto;
            background-color: #1a1a1a;
            color: #d9d9d9;
            text-align: center;
            padding: 20px;
        }
        .footer a {
            color: #d9d9d9;
            text-decoration: none;
        }
        .footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<div class="wrapper">
    <nav class="nav">
        <div class="nav-logo">
            <p><a href="index.php"><img src="images/-j7sv6t-removebg-preview (1).png"></a></p>
        </div>
        <div class="nav-menu" id="navMenu">
            <ul>
                <li><a href="admin_dashboard.php" class="link active">Home</a></li>
                <li><a href="admin_login.php" class="link">Admin</a></li>
                <li><a href="#" class="link">Contacts</a></li>
                <li><a href="profile.php" class="link">User</a></li>
            </ul>
        </div>
        <div class="nav-button">
    <?php if (isset($_SESSION['username'])): ?>
        <a href='profile.php' class='username'>Hello, <?php echo $_SESSION['username']; ?></a>
        <button class='btn white-btn' id='logoutBtn' onclick="confirmLogout()">Logout</button>
    <?php else: ?>
        <button class='btn white-btn' id='loginBtn'><a href='login.php' class='no-underline'>Sign In</a></button>
    <?php endif; ?>
    </div>

    <script>
        function confirmLogout() {
            var confirmAction = confirm("Are you sure you want to logout?");
            if (confirmAction) {
                window.location.href = 'logout.php'; // Proceed to logout if confirmed
            }
            // Do nothing if the user cancels the action
        }

        function toggleMenu() {
            const navMenu = document.getElementById('navMenu');
            navMenu.classList.toggle('active');
        }
    </script>

        <div class="nav-menu-btn">
            <i class="bx bx-menu" onclick="toggleMenu()"></i>
            <span class="menu-label">Menu</span> 
        </div>
    </nav>
 
    <div class="container mt-5" style="margin-top: 20px;">
    <div class="row">
        <?php
        while ($row = $result->fetch_assoc()) {
            echo "<div class='col-sm-12 col-md-6 col-lg-3 mb-4'>"; // Adjusted column size for 4 cards per row
            echo "<div class='card'>";
            echo "<img src='" . $row['thumbnailURL'] . "' class='card-img-top' alt='" . $row['title'] . "'>";
            echo "<div class='card-body'>";
            echo "<h5 class='card-title'>" . $row['title'] . "</h5>";
            echo "<a href='anime.php?id=" . $row['animeID'] . "' class='btn btn-primary'>View Details</a>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
        }
        ?>
    </div>
</div>

</div>
<footer class="footer">
        <p>&copy; 2024 AnimeSite. All rights reserved.</p>
        <p><a href="privacy.html">Privacy Policy</a> | <a href="terms.html">Terms of Service</a></p>
        <p>Developed by <a href="https://www.instagram.com/ig_viper.05?igsh=OTZvbGVhbXl6cnFq" target="_blank">Aryan Prasher</a></p>
    </footer>
</body>
</html>
