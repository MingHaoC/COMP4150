<?php

include 'includes/DBConnection.php';
include 'includes/Project.php';
include 'includes/ProjectView.php';

if(!isset($_SESSION)){
    session_start();
}

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
        <button class="center" name="submit" onClick="document.location.href='Dependent.php'">Dependents</button>
        <button class="center" name="submit" onClick="document.location.href='Employee.php'">Employees</button>
        <button class="center" name="submit" onClick="document.location.href='Manager.php'">Managers</button>
    </span>

</h1>

<div style="width: 50%; margin: auto">
    <?php
    $projects = new ProjectView();
    $projects->showAllProjects();
    ?>
</div>

</body>

</html>