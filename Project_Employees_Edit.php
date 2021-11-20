<?php

require_once "includes/DBConnection.php";
require_once "includes/Project.php";
require_once "includes/ProjectView.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$project = new ProjectView();

if(isset($_GET['edit_ProjectEmployeesForm'])){
    $pno = $_GET['edit_ProjectEmployeesForm'];
}else{
    Header("Location:Project.php");
}

?>

<!doctype html>
<html>
<link rel="stylesheet" href="index.css">
<link rel="stylesheet" href="edit.css">
<head>

</head>

<body style="background-color: #f2f2f2">
<div class='modal-content animate'>
    <div class="container">

        <div class="row">

            <form id="returnToProjectEdit" action="Project_edit.php" method="post"></form>
            <h3>
                Project Employees
                <button style="float: right;" name="backFromEditEmployees"
                        value=<? echo $pno ?> form="returnToProjectEdit">Back
                </button>
            </h3>

            <div class="column" style="width: 46%; margin: 0 1rem;">

                <?php

                $project->showEmployeesWorkingOnProject($pno);


                ?>

            </div>

            <div class="column" style="width: 48%; margin: 0 1rem;">

                <?php

                $project->showEmployeesNotWorkingOnProject($pno);


                ?>

            </div>


        </div>

    </div>
</div>




</body>

</html>