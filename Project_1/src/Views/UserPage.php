<?php
session_start();
require_once '../Model/DBClass.php';
require_once '../Model/Project.class.php';
require_once '../Model/Bug.Class.php';
require_once '../Model/Priority.Class.php';



if (!($_SESSION['Username'] = 'admin_user')) {
    header("Location: login.php");
}

$currentUser = $_SESSION['Username']; //current user 
$projectId = $_SESSION['ProjectId']; //current user projectId
$db = new DB();
$projModel = new Project($db);
$bugModel = new Bug($db);
$priorityModel = new Priority();

if(isset($_SESSION['RoleID']) && $_SESSION['RoleID'] == 1){ //checking for unauthorized access
    header("Location: login.php?denied=true");
    exit();
}elseif (isset($_SESSION['RoleID']) && $_SESSION['RoleID'] == 2){
    header("Location: login.php?denied=true");
    exit();
}



$projects = $projModel->getProject($projectId); //getting all project for user


// var_dump($projects);
// print_r ($projects[0]['Project']);
// $bugs = $bugModel->getBugByProject($projectId); //bugs of projects of the user
// var_dump($projects);


 //center current project top of page 
 //list all important info pertainng to proj
 //add form to add bugs
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel = "stylesheet" href = "styles/user.css">
</head>
<body>
    <div class="header">
        <h1>Dashboard</h1>
        <form class = "logout" action="../Controllers/LogOutController.php" method="post">
        <button class="logout-button" type="submit">Log Out</button>
    </form>
    </div>

    
    
    <p class = "project-header">Current Project: &nbsp; <span class = "bold"> <?php echo $projects[0]['Project']; ?> </span> </p>
   
    <div class = "bugContainer">
        <h3 class= "bugHeader" >Bugs:</h3>

      
        <?php
            $bugs = $bugModel->getBugByProject($projectId);
        ?>
        <?php foreach ($bugs as $b): ?>
            <?php
                $priority = $priorityModel->getPriorityById($b['priorityId']);
            ?>
            <div class="bug-box">
                <p><span class = "bold"> ID :</span><br/> <?php echo $b['id']  ?></p>
                <p><span class = "bold">Priority</span><br/> <?php echo $priority ?></p> 
                <p><span class = "bold"> Summary:</span><br/> <?php echo $b['summary']; ?></p>
                <p><span class = "bold">Description:</span><br/> <?php echo $b['description']; ?></p>
                <p><span class = "bold">Date Raised:</span> <br/> <?php echo $b['dateRaised']; ?></p>
                <p><span class = "bold">Due:</span> <br/><span class ="red"><?php echo $b['targetDate']; ?></span></p>

            </div>    
        <?php endforeach; ?>
        
    </div>    
            
        <br/>
       
            <!-- <h2 class= bug-header>Add Bug</h2> -->
            <div class="form-container">
                <h3>Add Bug</h3>
                <form action="../Controllers/BugController.php" method="POST">

                    <!-- Project selection -->
                    <label for="projectId">Project:</label>
                    <select name="projectId" id="projectId" required>
                        <option value= "" disabled selected>Select a Project</option>
                        <option value= ""><?php echo $projects[0]['Project'];?></option>
                        <!-- Options should be populated from database -->
                    </select>
                    
                    <!-- Bug Summary -->
                    <label for="summary">Bug Summary:</label>
                    <input type="text" name="summary" id="summary" required maxlength="250">
                   
                    <!-- Bug Description -->
                    <label for="description">Description:</label>
                    <input type="text" name="description" id="description" required maxlength="250">
                    <br/>
                    

                    <button type="submit">Submit Bug</button>

                </form>
            
            </div>

            <div class="form-container">
            <h3>Edit Bug</h3>
                <form action="../Controllers/EditBugController.php" method="POST">

                    <!-- Project selection -->
                    <label for="bugId">Choose a bug:</label>
                    <select name="bugId" id="bugId" required>
                    <?php
                        $bugs = $bugModel->getBugByProject($projectId);
                    ?>
                        <option value= "" disabled selected>Select an existing bug</option>
                        <?php foreach ($bugs as $b): ?>
                        
                        <option value= "<?php echo $b['id'];?>"><?php echo $b['id'];?></option>
                        <?php endforeach; ?>
                        <!-- Options should be populated from database -->
                    </select>
                    
                    <!-- Bug Summary -->
                    <label for="summary">Bug Summary:</label>
                    <input type="text" name="summary" id="summary" required maxlength="250">
                   
                    <!-- Bug Description -->
                    <label for="description">Description:</label>
                    <input type="text" name="description" id="description" required maxlength="250">
                   
                    <br/>
                    <button type="submit">Submit Bug</button>

                </form>
            
            </div>
   
    </body>
</html>