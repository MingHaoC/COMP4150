<?php

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

<h1 style="margin: 0 4rem; ">
    Company Admin Home Page

    <span style="float: right; margin: 0 4rem;">
        <button class="center" name="submit" onClick="document.location.href='Department.php'">Departments</button>
        <button class="center" name="submit" onClick="document.location.href='Dependent.php'">Dependents</button>
        <button class="center" name="submit" onClick="document.location.href='Employee.php'">Employees</button>
        <button class="center" name="submit" onClick="document.location.href='Manager.php'">Managers</button>
        <button class="center" name="submit" onClick="document.location.href='Project.php'">Projects</button>
    </span>

</h1>

<div style="width: 40%; margin: 2rem auto;">
    <h2>
        Phase 3.
    </h2>

    <h2>
        Please make sure to check functionality of all fields and buttons and make sure the correct pages are performing the correct queries.
    </h2>

    <h2>
        Remember to check for FK constraints
    </h2>

</div>

<!-- Feature for the index page: check to see what employees birthday it is and display it. -->

</body>

</html>