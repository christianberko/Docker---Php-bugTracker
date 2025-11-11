<?php
session_start();
require_once '../Model/DBClass.php';
require_once '../Model/User.Class.php';
require_once '../Model/Bug.Class.php';

//get session var
//get args from form and put them in the insert function the redirect back 
//get projectid, summary and desc,
//get $ownerId by calling get 

$db = new DB();
$bugModel = new Bug($db);
function sanitizeString($var) {  //santization
    $var = trim($var);
    $var = stripslashes($var);
    $var = htmlentities($var);
    $var = strip_tags($var);
    return $var;
}

$bugId = sanitizeString($_POST['bugId']);
print_r($bugId);
$bugModel->deleteBugById($bugId);
header("Location: ../Views/AdminPage.php");
exit();






