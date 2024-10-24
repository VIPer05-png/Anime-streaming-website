<?php
session_start();
include 'config.php';

if (isset($_POST['login'])) {
    $admin_id = $_POST['admin_id'];
    $password = $_POST['password'];

    // Prepare and execute the query to fetch the admin details
    $sql = "SELECT * FROM admins WHERE admin_id = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $admin_id, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $admin = $result->fetch_assoc();
        $_SESSION['admin_id'] = $admin['admin_id'];
        $_SESSION['role'] = 'admin';
        header("location: admin_dashboard.php");
        exit;
    } else {
        $error = "Invalid admin ID or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <style>
        *, *:before, *:after {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }
        body {
            background-color: #080710;
            font-family: 'Poppins', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            overflow: hidden;
        }
        .background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            overflow: hidden;
        }
        .background img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
        }
        form {
            max-width: 400px;
            width: 100%;
            background-color: rgba(255,255,255,0.13);
            border-radius: 10px;
            backdrop-filter: blur(10px);
            border: 2px solid rgba(255,255,255,0.1);
            box-shadow: 0 0 40px rgba(8,7,16,0.6);
            padding: 50px 35px;
            margin: 50px auto;
            z-index: 1;
        }
        form h3 {
            font-size: 32px;
            font-weight: 500;
            line-height: 42px;
            text-align: center;
            color: #ffffff;
        }
        label {
            display: block;
            margin-top: 20px;
            font-size: 16px;
            font-weight: 500;
            color: #ffffff;
        }
        input {
            display: block;
            height: 50px;
            width: 100%;
            background-color: rgba(255,255,255,0.07);
            border-radius: 3px;
            padding: 0 10px;
            margin-top: 8px;
            font-size: 14px;
            font-weight: 300;
            color: #ffffff;
        }
        ::placeholder {
            color: #e5e5e5;
        }
        .button {
            margin-top: 30px;
            width: 100%;
            background-color: #ffffff;
            color: #080710;
            padding: 15px 0;
            font-size: 18px;
            font-weight: 600;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .button:hover {
            background-color: #f0f0f0;
        }
        .error {
            color: red;
            text-align: center;
            margin-bottom: 10px;
        }
        .link {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #DADD98;
            text-decoration: none;
            font-size: 14px;
        }
        .link:hover {
            text-decoration: underline;
        }
        img {
            max-width: 100%;
            height: auto;
            display: block;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="background">
        <img src="images/satoru-gojo-7680x4320-15227.png" alt="anime background">
    </div>
    <form method="post" action="">
        <h3>Admin Login</h3>
        <?php if (isset($error)): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>
        <label for="admin_id">Admin ID:</label>
        <input type="text" name="admin_id" id="admin_id" placeholder="Admin ID" required>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" placeholder="Password" required>
        <button type="submit" name="login" class="button">Login</button>
    </form>
</body>
</html>
