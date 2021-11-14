<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'includes/DBConnection.php';
include 'includes/Department.php';
include 'includes/DepartmentView.php';
include 'includes/Manager.php';
include 'includes/ManagerView.php';


if(!isset($_SESSION)){
    session_start();
}

$departments = new DepartmentView();
$managers = new ManagerView();
?>

<!doctype html>
<html>

<head>

    <link rel="stylesheet" href="index.css">

</head>

<body style="background-color: #f2f2f2">

<h1 style="margin: 0 4rem 2rem 4rem">
    Departments

    <span style="float: right; margin: 0 4rem;">
        <button class="center" name="submit" onClick="document.location.href='index.php'">Home</button>
        <button class="center" name="submit" onClick="document.location.href='Dependent.php'">Dependents</button>
        <button class="center" name="submit" onClick="document.location.href='Employee.php'">Employees</button>
        <button class="center" name="submit" onClick="document.location.href='Manager.php'">Managers</button>
        <button class="center" name="submit" onClick="document.location.href='Project.php'">Projects</button>
    </span>

</h1>

<div class="row">

    <div class="column" style="width: 30%;">
        <h3>Add a Department</h3>
        <?php
        $departments->showAddDepartmentFields();


        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $request = [
                    "Dname" => $_POST["Dname"],
                    "Dlocation" => $_POST["Dlocation"],
                    "ManagerID" => $_POST["ManagerID"],

            ];
            $departments->addDepartment($request);
        }

        ?>
    </div>

    <div class="column" style="width: 50%; margin: 0 1rem;">
        <h3>View Departments</h3>
        <?php
        $departments->showAllDepartments();
        ?>
    </div>

</div>

</body>

</html>