<?php
require_once "../includes/DBConnection.php";
require_once "../includes/Department.php";
require_once "../includes/DepartmentView.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//start session
if (!isset($_SESSION)) {
    session_start();
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

        <h3>Edit Department</h3>
        <!-- form to edit department -->
        <?php


        $department = new DepartmentView();
        $department->showEditableDepartmentFields(5);

        ?>

    </div>

</div>
</body>

</html>