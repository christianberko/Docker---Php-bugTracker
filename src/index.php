<?php
// Simple index page for the PHP Bug Tracking Application
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Bug Tracking Application</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
        }
        h1 {
            color: #333;
            text-align: center;
        }
        .nav-links {
            text-align: center;
            margin: 30px 0;
        }
        .nav-links a {
            display: inline-block;
            margin: 10px;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .nav-links a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>PHP Bug Tracking Application</h1>
    
    <p><strong>Status:</strong> Application is running successfully!</p>
    <p><strong>PHP Version:</strong> <?php echo phpversion(); ?></p>
    <p><strong>Port:</strong> 8080</p>

    <div class="nav-links">
        <a href="Views/login.php">Login</a>
        <a href="Views/dashboard.php">Dashboard</a>
    </div>

    <h3>Available Features:</h3>
    <ul>
        <li>User Authentication</li>
        <li>Bug Tracking</li>
        <li>Project Management</li>
    </ul>
</body>
</html>
