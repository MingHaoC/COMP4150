<?php
require 'includes/DBConnection.php';
require 'includes/Project.php';
require 'includes/ProjectView.php';
require 'includes/Department.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//start session
if (!isset($_SESSION)) {
    session_start();
}

$project = new ProjectView();

if(isset($_GET['key'])){
    $pno = $_GET['key'];
}else if(isset($_POST['backFromEditEmployees'])){
    $pno = $_POST['backFromEditEmployees'];
}

?>

<!doctype html>
<html lang="">

<head>
    <link rel="stylesheet" href="edit.css">
</head>

<body>
<div class='modal-content animate'>
    <div class='container'>
        <h3>Edit Project</h3>
        <!-- form to edit manager -->
        <form id='editProjectForm' method="POST">
        <?php
            if(isset($pno)){
                $project->showEditableProjectFields($pno);
            }
        ?>
        </form>
        <button form='editProjectForm' name='key' type='submit'>Submit</button>
        <button type='button' onclick="document.location.href='Project.php'">Cancel</button>

        <?php
        if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['key'])){

            $request = [
                "Pname" => $_POST["edit_Pname"],
                "Plocation" => $_POST["edit_Plocation"],
                "Dnum" => $_POST["edit_department"],
                "Pnumber" => $pno
            ];

            $project = new Project();
            $project->updateProject($request);
        }

        ?>

    </div>
</div>
</body>

</html>