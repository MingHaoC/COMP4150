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

            <div class="column" style="width: 45%; margin: 0 1rem;">

                <?php

                $project->showEmployeesWorkingOnProject($pno);

                if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["remove_FromProject"])){
                    echo $_POST["remove_FromProject"];
                    $temp = $_POST["remove_FromProject"];
                    $temp = explode("-", $temp);
                    $ssn = $temp[0];
                    $pno = $temp[1];

                    $request = [
                        "Essn" => $ssn,
                        "Pnumber" => $pno
                    ];

                    print_r($request);
                    $project->removeEmployeeFromProject($request);
                    Header('Location: ' . $_SERVER['PHP_SELF']);
                }

                ?>

            </div>

            <div class="column" style="width: 45%; margin: 0 1rem;">

                <?php

                $project->showEmployeesNotWorkingOnProject($pno);

                if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add_ToProject"])){
                    echo $_POST["add_ToProject"];
                    $temp = $_POST["add_ToProject"];
                    $temp = explode("-", $temp);
                    $ssn = $temp[0];
                    $pno = $temp[1];

                    $request = [
                        "Essn" => $ssn,
                        "Pnumber" => $pno
                    ];

                    print_r($request);
                    $project->addEmployeeToProject($request);
                    Header('Location: ' . $_SERVER['PHP_SELF']);
                }

                ?>

            </div>


        </div>

    </div>
</div>




</body>

</html>