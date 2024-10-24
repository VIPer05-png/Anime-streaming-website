<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $role = "user";

    // Sanitize input data
    $username = $conn->real_escape_string($username);
    $password = $conn->real_escape_string($password);
    $email = $conn->real_escape_string($email);

    $sql = "INSERT INTO users (username, password, email, role) VALUES ('$username', '$password', '$email', '$role')";

    if ($conn->query($sql) === TRUE) {
        echo "Registration successful";
        header("location: login.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
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
            margin: 0;
            padding: 0;
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
        @media (max-width: 768px) {
            form {
                padding: 40px 30px;
                margin: 40px auto;
            }
            form h3 {
                font-size: 28px;
            }
            input {
                height: 45px;
                font-size: 13px;
            }
            .button {
                padding: 12px 0;
                font-size: 16px;
            }
        }
        @media (max-width: 480px) {
            form {
                padding: 30px 20px;
                margin: 30px auto;
            }
            form h3 {
                font-size: 24px;
            }
            input {
                height: 40px;
                font-size: 12px;
            }
            .button {
                padding: 10px 0;
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <div class="background">
        <img src="images/wallpapersden.com_akatsuki-organization-anime_3500x1668.jpg" alt="anime background">
    </div>
    <form method="post">
        <h3>Register</h3>
        <label>Username:</label>
        <input type="text" name="username" placeholder="Username" required>
        <label>Password:</label>
        <input type="password" name="password" placeholder="Password" required>
        <label>Email:</label>
        <input type="email" name="email" placeholder="Email" required>
        <input type="submit" value="Register" class="button">
    </form>
</body>
</html>
