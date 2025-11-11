<?php
session_start();
//call authenticate method
//create user 

$password = "spider";
$hashed_password = password_hash($password, PASSWORD_DEFAULT);
// echo $hashed_password;




if (isset($_GET['error']) && $_GET['error'] === 'invalid_credentials') {
    echo "<p style='color:red;'>Invalid username or password!</p>";
}

if(isset($_GET['denied']) && $_GET['denied'] === 'true'){
    echo "<p style = 'color:red;'>Please Login</p>";
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/login.css">
    <title>BugTracker | Login </title>
</head>
<body>
    <div class="header">
        <h1>BugTracker</h1>
    </div>
    
    <form action="../Controllers/LoginController" method='POST'>
        <div class="login-box">
            <div class="login-header">
                <header>Login</header>
            </div>
            <div class="input-box">
                <input type="text" class="input-field" name = "username" placeholder="Username" autocomplete="off" required>
            </div>
            <div class="input-box">
                <input type="password" class="input-field" name = "password" placeholder="Password" autocomplete="off" required>
            </div>
            <!-- ``<div class="forgot">
                

                <section>
                    <a href="#">Forgot password</a>
                </section>
            </div>`` -->
            <div class="input-submit">
            <button class="submit-btn" id="submit" type="submit">Sign In</button>
            </div>
           
        </div>

    </form>
    
</body>
</html>

    