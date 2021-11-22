<?php

if(!isset($_SESSION)){
    session_start();
}

?>

<!doctype html>
<html lang="english">

<head>
    <link rel="stylesheet" href="index.css">
    <title>Phase 3</title>
</head>


<body style="background-color: #f2f2f2">

<h1 style="margin: 0 4rem; ">
    Company Admin Home Page
    <hr/>
</h1>

<div style="width: 50%; margin: 2rem auto;">
    <h2>
        Phase 3 Submission. Each button brings you to the appropriate tables.
    </h2>

    <div class="row">

        <div class="column" style="width: 20%;">
            <div id="buttonToDepartments" onClick="document.location.href='Department.php'"
                 style="border: 1px solid #000; margin: 1rem; border-radius: 1rem; cursor: pointer;">
                <h3>Departments</h3>
            </div>
        </div>

        <div class="column" style="width: 20%;">
            <div id="buttonToEmployees" onClick="document.location.href='Employee.php'"
                 style="border: 1px solid #000; margin: 1rem; border-radius: 1rem; cursor: pointer;">
                <h3>Employees</h3>
            </div>
        </div>

        <div class="column" style="width: 20%; ">
            <div id="buttonToManagers" onClick="document.location.href='Manager.php'"
                 style="border: 1px solid #000; margin: 1rem; border-radius: 1rem; cursor: pointer;">
                <h3>Managers</h3>
            </div>
        </div>

        <div class="column" style="width: 20%;">
            <div id="buttonToProjects" onClick="document.location.href='Project.php'"
                 style="border: 1px solid #000; margin: 1rem; border-radius: 1rem; cursor: pointer;">
                <h3>Projects</h3>
            </div>
        </div>

    </div>


</div>

</body>

</html>