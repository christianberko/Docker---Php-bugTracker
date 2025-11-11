<?php
session_start();
require_once '../Model/DBClass.php';
require_once '../Model/User.Class.php';
require_once '../Model/Bug.Class.php';

//get session var
//get args from form and put them in the insert function the redirect back 
//get projectid, summary and desc,
//get $ownerId by calling get 

function sanitizeString($var) {  //santization
    $var = trim($var);
    $var = stripslashes($var);
    $var = htmlentities($var);
    $var = strip_tags($var);
    return $var;
}


$db = new DB();
$bugModel = new Bug($db);

$summary = sanitizeString($_POST['summary']); 
$description = sanitizeString($_POST['description']);
$id = sanitizeString($_POST['bugId']);
print_r($description);
$bugModel->updateBugAsUser($id, $summary, $description);


header("Location: ../Views/UserPage.php");
exit();

//somehow get date into this function 
//add redirect for users trying to go to pages they dont have access to. 




?>