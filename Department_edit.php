<?php
include "includes/DBConnection.php";
include "includes/Department.php";
include "includes/DepartmentView.php";

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

        if(isset($_POST[''])) {
            $dno = $_POST["key"];
        }else if(isset($_GET['key'])) {
            $dno = $_GET["key"];
        }

        if (isset($dno)) {
            $department->showEditableDepartmentFields($dno);
        } else {
            Header("Location:Department.php");
        }


        ?>

        <button form='editDepartmentForm' name='key' value="1" type='submit'>Submit</button>
        <button type='button' onclick="document.location.href='Department.php'">Cancel</button>

    </div>

</div>
</body>

</html>