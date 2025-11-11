<?php
session_start();
require_once '../Model/DBClass.php';
require_once '../Model/User.Class.php';
require_once '../Model/Project.class.php';

$db = new DB();
$userModel = new User($db);

$username = $_POST['username'];
$password = $_POST['password'];
$name = $_POST['name'];
$RoleID = $_POST['role'];
print_r($RoleID);
print_r($_SESSION['RoleID']);
//  $userModel->createUser($username, $RoleID,  $password, $name,    )




//get the assigned id  then 
   ?>


