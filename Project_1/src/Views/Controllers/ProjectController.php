<?php
   session_start();
   require_once '../Model/DBClass.php';
   require_once '../Model/User.Class.php';
   require_once '../Model/Project.class.php';
   

$db = new DB();
$projectModel = new Project($db);

function sanitizeString($var) {  //santization
   $var = trim($var);
   $var = stripslashes($var);
   $var = htmlentities($var);
   $var = strip_tags($var);
   return $var;
}
$projectName = sanitizeString($_POST['project']);

$projectModel->createProject($projectName);
header("Location: ../Views/AdminPage.php");
exit();





?>




