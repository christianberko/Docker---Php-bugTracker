<?php
session_start();
require_once '../Model/DBClass.php';
require_once '../Model/User.Class.php';


$db = new DB(); //instatiating DB
$userModel = new User($db); //creating model objects 


function sanitizeString($var) {  //santization
    $var = trim($var);
    $var = stripslashes($var);
    $var = htmlentities($var);
    $var = strip_tags($var);
    return $var;
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
    $username = sanitizeString($_POST['username']);
    $password = sanitizeString($_POST['password']);

    // Fetch user by username
    $user = $userModel->getUserByUsername($username); // Get user from DB  
    // echo $user['Password'];
    if ($user && password_verify($password, $user['Password'])) { // Check if password matches
        // Set session for authenticated user
       
        $_SESSION['Username'] = $user['Username'];
        $_SESSION['RoleID'] = $user['RoleID'];
        $_SESSION['ProjectId'] = $user['ProjectId'];
        $_SESSION['Id'] = $user['Id'];

        switch($user['RoleID']){

            case 1:
                header("Location: ../Views/AdminPage.php");
                break;
            
            case 2:
                header("Location: ../Views/AdminPage.php");
                break;
            
            case 3:
                header("Location: ../Views/UserPage.php");
                break;

            }
        

        // Redirect to dashboard
    } else {
        // Display error message
        header("Location: ../Views/login.php?error=invalid_credentials");   
        exit();
        // echo "<p>Invalid username or password!</p>";
    }
    
}     




?>