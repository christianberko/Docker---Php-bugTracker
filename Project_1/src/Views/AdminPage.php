<?php

session_start();

require_once '../Model/DBClass.php';
require_once '../Model/User.Class.php';
require_once '../Model/Project.class.php';
require_once '../Model/Bug.Class.php';
require_once '../Model/Priority.Class.php';
require_once '../Model/Status.Class.php';

if(isset($_SESSION['RoleID']) && $_SESSION['RoleID'] == 3){ //checking for unauthorized access
    header("Location: login.php?denied=true");
    exit();
}


$currentUser = $_SESSION['Username']; //current user 

$db = new DB();
$projModel = new Project($db);
$bugModel = new Bug($db);
$userModel = new User($db);
$priorityModel = new Priority($db);
$statusModel = new Status($db);
$users = $userModel->getAllUsers();

$projects = $projModel->getAllProjects();




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel = "stylesheet" href = "styles/admin.css">
    <title>Dashboard</title>
</head>
<body>
    <div class = "header">
        <h1> Admin Dashboard </h1>
        <form class = "logout" action="../Controllers/LogOutController.php" method="post" >
        <button class="logout-button" type="submit">Log Out</button>
    </div>
    <h1>All Projects:</h1>
    <div class="container">
      
        <?php if ($projects): ?>
            <?php foreach ($projects as $p): ?>
                    <div class="projects">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title"><?php echo $p['Project']; ?></h4>
                                <!-- <p><?php echo $p['Id']; ?></p> -->
                                <div class="bugs">
                                    <h5>Bugs:</h5>
                                    <?php
                                        $bugsArr = $bugModel->getBugByProject($p['Id']);
                                    ?>
                                     <?php foreach ($bugsArr as $b): ?>
                                        <div class="bug-text">
                                       
                                            <!-- <p><?php echo $b['assignedToId']; ?></p> -->
                                            <p><span class="bold">ID:</span> <?php echo $b['id']; ?></p>
                                            <p><span class="bold">Summary:</span> <?php echo $b['summary']; ?></p>
                                            <p><span class="bold">Description:</span> <?php echo $b['description']; ?></p>
                                            <?php
                                                $priorityLevel = $priorityModel->getPriorityById($b['priorityId']);
                                                $statusLevel = $statusModel->getStatusById($b['statusId']);
                                            ?>
                                            <p><span class= "bold">Priority</span>  <?php echo $priorityLevel ?> </p>
                                            <p><span class ="bold">Status: </span>  <?php echo $statusLevel ?></p>
                                            <p><span class = "bold">Fix Description: </span> <?php echo $b['fixDescription']; ?></p>
                                            <p><span class = "bold">Date Raised: </span> <?php echo $b['dateRaised']; ?>  &nbsp; Target Date: <?php echo $b['targetDate']; ?>  &nbsp; Date Closed: <?php echo $b['dateClosed']; ?></p>
                                            <!-- <p>Target Date: <?php echo $b['targetDate']; ?></p> 
                                            <p>Date Closed: <?php echo $b['dateClosed']; ?></p>
                                             -->
                                        </div>
                                    <?php endforeach; ?>
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                    <div style="clear: both;"></div> <!-- Add this after each project -->
                <?php endforeach; ?>

                <?php else: ?>
                    <p>No projects found for this user.</p>
                 <?php endif; ?>

                
            </div>

        </div>

        <div class="User-table">
            <h2>All Users</h2>
            <table border="1">
                <thead>
                    <tr bgcolor="grey">
                        <th>User ID</th>
                        <th>Username</th>
                        <th>Role ID</th>
                        <th>Project ID</th>
                        <th>Name</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($users): ?>
                        <?php foreach ($users as $user): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($user['Id']); ?></td>
                                <td><?php echo htmlspecialchars($user['Username']); ?></td>
                                <td><?php echo htmlspecialchars($user['RoleID']); ?></td>
                                <td><?php echo htmlspecialchars($user['ProjectId']); ?></td>
                                <td><?php echo htmlspecialchars($user['Name']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5">No users found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <?php if(isset($_SESSION['RoleID']) && $_SESSION['RoleID'] === 1): ?>          
    <div class="User-form-container">
        <h3>Create User</h3>
        <form action="../Controllers/CreateUserController.php" method="POST">
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" maxlength="50">

            <label for="password">Password:</label>
            <input type="password" name="password" id="password" maxlength="50">
            <br/>

            <label for="name">Name:</label>
            <input type="text" name="name" id="name" maxlength="50">

            <label for="role">Role</label>
            <select name="role" id="role">
                <option value="" disabled selected>Select a Role</option>
                <option value="1">Admin</option>
                <option value="2">Manager</option>
                <option value="3">User</option>
            </select>

            <label for="projectId">Project Id</label>
            <input type="text" name="projectId" id="projectId" maxlength="50">
            
            <br/>
            <button type="submit">Create User</button>
        </form>
    </div>
<?php endif; ?>


        
        <div class="projectRow">
            <div class="project-form-container">
                <h3>Create Project</h3>
                <form action ="../Controllers/ProjectController.php" method = "POST">
                    <label for="project">Project Name: <label>
                    <input type="text" name="project" id="project"  maxlength="250">
                    
                    <button type="submit">Submit </button>
                </form>
            </div>

            <div class="project2-form-container">
                <h3>Update Project</h3>
                <form action ="../Controllers/UpdateProjectController.php" method = "POST">
                    <label for="projectId"> Project:</label>
                        <select name="projectId" id="projectId" required>
                            <option value= "" disabled selected>Select a Project</option>
                            <?php foreach ($projects as $p): ?>
                            <option value= "<?php echo $p['Id'];?>"><?php echo $p['Project'];?></option>
                            <?php endforeach; ?>
                                
                            <!-- Options should be populated from database -->
                        </select>

                        <label for="project">New Project Name:<label>
                        <input type="text" name="project" id="project"  maxlength="250">

                        <button type="submit">Submit</button>
                </form>
                
            </div>

        </div>
       


        <div class="Addbug-container">
                <h3>Add Bug</h3>
                <form action="../Controllers/AddBugAdminController.php" method="POST">

                    <!-- Project selection -->
                    <label for="projectId">Project:</label>
                    <select name="projectId" id="projectId" required>
                        <option value= "" disabled selected>Select a Project</option>
                        <?php foreach ($projects as $p): ?>
                        <option value= "<?php echo $p['Id'];?>"><?php echo $p['Project'];?></option>
                        <?php endforeach; ?>
                            
                        <!-- Options should be populated from database -->
                    </select>

                    <label for="priority">Priority:</label>
                    <select name="priority" id="priority" >
                        <option value= "" disabled selected>Select Priority</option>
                        <option value= 1 >Low</option>
                        <option value= 2>Medium</option>
                        <option value= 3>High</option>
                    </select>

                    
                    <!-- Bug Summary -->
                    <label for="summary">Bug Summary:</label>
                    <input type="text" name="summary" id="summary" required maxlength="250">
                    </br>
                    <!-- Bug Description -->
                    <label for="description">Description:</label>
                    <input type="text" name="description" id="description" required maxlength="250">
               
                    <label for="targetDate">Target Date:</label>
                    <input type="datetime-local" name="targetDate" id="targetDate" required>
                    <br/>
                    

                    <button type="submit">Submit Bug</button>

                </form>
            
            </div>



            <div class="Addbug-container">
                <h3>Update Bug</h3>
                <form action="../Controllers/AddBugAdminController.php" method="POST">

                    <!-- Project selection -->
                    <label for="projectId">Project:</label>
                    <select name="projectId" id="projectId" required>
                        <option value= "" disabled selected>Select a Project</option>
                        <?php foreach ($projects as $p): ?>
                        <option value= "<?php echo $p['Id'];?>"><?php echo $p['Project'];?></option>
                        <?php endforeach; ?>
                            
                        <!-- Options should be populated from database -->
                    </select>

                    <label for="priority">Priority:</label>
                    <select name="priority" id="priority" >
                        <option value= "" disabled selected>Select Priority</option>
                        <option value= 1 >Low</option>
                        <option value= 2>Medium</option>
                        <option value= 3>High</option>
                    </select>

                    
                    <!-- Bug Summary -->
                    <label for="summary">Bug Summary:</label>
                    <input type="text" name="summary" id="summary" required maxlength="250">
                    </br>
                    <!-- Bug Description -->
                    <label for="description">Description:</label>
                    <input type="text" name="description" id="description" required maxlength="250">

                    <label for="fixDescription"> Fix Description:</label>
                    <input type="text" name="description" id="description" required maxlength="250">
               
                    <label for="targetDate">Target Date:</label>
                    <input type="datetime-local" name="targetDate" id="targetDate" required>
                    <br/>


                    

                    <button type="submit">Submit</button>

                </form>
            
            </div>
                        
            <div class="delete-container">
                <h3>Delete Bug</h3>
                <form action="../Controllers/DeleteBugController.php" method="POST">

                    <!-- Project selection -->
                    <label for="bugId">Project:</label>
                    <select name="bugId" id="bugId" required>
                        <option value= "" disabled selected>Select a Bug</option>
                        <?php
                            $bugsArr = $bugModel->getAllBugs();
                        ?>
                        <?php foreach ($bugsArr as $b): ?>
                            <option value= "<?php echo $b['id'];?>"><?php echo $b['id'];?></option>
                        <?php endforeach; ?>
                            
                        <!-- Options should be populated from database -->
                   
                        </select>
                    <button type="submit">Submit</button>

                </form>
            
            </div>

        
        
    </div>
    <footer>
        
    </footer>
</body>
</html>

<?php
    // var_dump($bugsArr);

?>