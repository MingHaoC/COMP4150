<?php

require_once "includes/DBConnection.php";
require_once "includes/Department.php";
require_once "includes/DepartmentView.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//start session
if (!isset($_SESSION)) {
    session_start();
}

$department = new DepartmentView();

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

            <h3>Department Employees</h3>

            <div class="column" style="width: 30%; margin: 0 1rem;">


            </div>

            <div class="column" style="width: 39%; margin: 0 1rem;">



            </div>

            <div class="column" style="width: 30%; margin: 0 1rem;">


            </div>


        </div>

    </div>
</div>




</body>

</html>