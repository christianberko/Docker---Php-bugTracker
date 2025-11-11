<?php
session_start();
require_once '../Model/DBClass.php';
require_once '../Model/User.Class.php';
require_once '../Model/Bug.Class.php';


function sanitizeString($var) {  //santization
    $var = trim($var);
    $var = stripslashes($var);
    $var = htmlentities($var);
    $var = strip_tags($var);
    return $var;
}


$db = new DB();
$bugModel = new Bug();  

$ownerId = 1; //creating as admin
$statusId = 1 ;//unassigned default can update later
$priorityId = sanitizeString($_POST['priority']);
$projectId = sanitizeString($_POST['projectId']);

$summary = sanitizeString($_POST['summary']);
$description = sanitizeString($_POST['description']);
$targetDate = sanitizeString($_POST['targetDate']) . ':00'; 

$bugModel->createBugAsAdmin($projectId, $ownerId, $statusId, $priorityId, $summary, $description, $targetDate);
header("Location: ../Views/AdminPage.php");
exit();



?>