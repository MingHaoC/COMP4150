<?php
include "includes/DBConnection.php";
include "includes/Employee.php";
include "includes/EmployeeView.php";

if(!isset($_SESSION)){
    session_start();
}

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
        <button class="center" name="submit" onClick="document.location.href='Dependent.php'">Dependents</button>
        <button class="center" name="submit" onClick="document.location.href='Manager.php'">Manager</button>
        <button class="center" name="submit" onClick="document.location.href='Project.php'">Projects</button>
    </span>
</h1>

<h1 style="margin: 0 4rem; ">


    <?
        $employee = new EmployeeView();
        $employee->ShowAllEmployee();
    ?>

</h1>

</body>

</html>