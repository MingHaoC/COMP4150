<?php

require 'includes/DBConnection.php';
require 'includes/Department.php';
require 'includes/DepartmentView.php';
require 'includes/Manager.php';
require 'includes/ManagerView.php';

if (!isset($_SESSION) || $_SESSION['login']) {
    session_start();
    header("Location:Login.php");
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
        <button class="center" name="submit" onClick="document.location.href='Employee.php'">Employees</button>
        <button class="center" name="submit" onClick="document.location.href='Manager.php'">Managers</button>
        <button class="center" name="submit" onClick="document.location.href='Project.php'">Projects</button>
    </span>

</h1>

<div class="row">

    <div class="column" style="width: 20%;">
        <h3>Add a Department</h3>
        <?php
        $departments->showAddDepartmentFields();

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {

            $request = [
                    "Dname" => $_POST["Dname"],
                    "Dlocation" => $_POST["Dlocation"]
            ];

            $departments->addDepartment($request);
        }

        ?>
    </div>

    <div class="column" style="width: 50%; margin: 0 1rem;">
        <h3>View Departments</h3>
        <?php
        $departments->showAllDepartments();

        if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["delete"])) {
            $dno = $_GET["delete"];
            $departments->removeDepartment($dno);
        }

        ?>
    </div>

    <div class="column" style="width: 25%;">
        <h3>Department Locations</h3>
        <?php
        $departments->showAllDepartmentLocations();

        ?>

    </div>

</div>



</body>

</html>