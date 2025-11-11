<?php
   session_start();
   require_once '../Model/DBClass.php';
   require_once '../Model/User.Class.php';
   require_once '../Model/Project.class.php';
   

$db = new DB();
$projectModel = new Project($db);


$projectId =  $_POST['projectId'];
$newProjectName = $_POST['project'];
// print_r ($projectId);
// print_r ($newProjectName);
$projectModel->updateProjectNameById($projectId, $newProjectName);
header("Location: ../Views/AdminPage.php");
exit();