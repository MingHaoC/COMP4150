<?php

include 'includes/DBConnection.php';
include 'includes/Project.php';
include 'includes/ProjectView.php';
include 'includes/Department.php';
include 'includes/DepartmentView.php';

if (!isset($_SESSION)) {
    session_start();
}

$departments = new DepartmentView();
$projects = new ProjectView();

?>

<!doctype html>
<html>
<head>
    <link rel="stylesheet" href="index.css">
</head>
<body style="background-color: #f2f2f2">

<h1 style="margin: 0 4rem 2rem 4rem; ">
    Projects

    <span style="float: right; margin: 0 4rem;">
        <button class="center" name="submit" onClick="document.location.href='index.php'">Home</button>
        <button class="center" name="submit" onClick="document.location.href='Department.php'">Departments</button>
        <button class="center" name="submit" onClick="document.location.href='Employee.php'">Employees</button>
        <button class="center" name="submit" onClick="document.location.href='Manager.php'">Managers</button>
    </span>

</h1>

<div class="row">

    <div class="column" style="width: 30%;">
        <h3>Add a Project</h3>
        <?php
        $projects->showAddProjectFields();

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])){

            $request = [
                "Pname" => $_POST["Pname"],
                "Plocation" => $_POST["Plocation"],
                "Dnum" => $_POST["add_department"],
            ];
            $projects->addProject($request);
        }

        ?>
    </div>

    <div class="column" style="width: 50%; margin: 0 1rem;">
        <h3>View Projects</h3>
        <?php
        $projects->showAllProjects();

        if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["delete"])) {
            $pno = $_GET["delete"];
            $projects->removeProject($pno);
        }

        ?>
    </div>

</div>

</body>

</html>