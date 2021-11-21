<?php
require "includes/DBConnection.php";
require "includes/Employee.php";
require "includes/EmployeeView.php";

if (!isset($_SESSION)) {
    session_start();
}
$employeeView = new EmployeeView();
?>

<!doctype html>
<html>
<link rel="stylesheet" href="index.css">
<head>

</head>

<body style="background-color: #f2f2f2">

<h1 style="margin: 0 4rem 2rem 4rem">
    Employees

    <span style="float: right; margin: 0 4rem;">
        <button class="center" name="submit" onClick="document.location.href='index.php'">Home</button>
        <button class="center" name="submit" onClick="document.location.href='Department.php'">Departments</button>
        <button class="center" name="submit" onClick="document.location.href='Manager.php'">Manager</button>
        <button class="center" name="submit" onClick="document.location.href='Project.php'">Projects</button>
    </span>
</h1>

<div class="row">
    <div class="column" style="width: 30%;">
        <h3>Add an employee</h3>
        <?
        $employeeView->showAddEmployee();
        ?>
    </div>

    <div class="column" style="width: 60%; margin: 0 1rem;">
        <h3>View Employee</h3>
        <?
        $employeeView->ShowAllEmployee();
        ?>
    </div>

    <div class="column" style="width: 100%; color: red">
        <?
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if ($_POST["delete"])
                $employeeView->deleteEmployee($_POST["delete"]);
            else {
                $employeeView->addEmployee($_POST["Fname"], $_POST["Minit"], $_POST["Lname"], $_POST["SSN"], $_POST["Password"], $_POST["Bdate"], $_POST["Address"], $_POST["Sex"], $_POST["Salary"], $_POST["Super_ssn"], $_POST["Department"], $_POST["Pno"]);
            }
        }
        ?>
    </div>
    <div>

</body>

</html>