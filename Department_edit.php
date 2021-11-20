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

if(isset($_GET['key'])) {
    $dno = $_GET["key"];
}else if(isset($_POST['backFromEditLocations'])){
    $dno = $_POST['backFromEditLocations'];
}else if(isset($_POST['backFromEditEmployees'])){
    $dno = $_POST['backFromEditEmployees'];
}

?>

<!doctype html>
<html lang="">

<head>
    <link rel="stylesheet" href="edit.css">
    <link rel="stylesheet" href="index.css">
</head>

<body>

<div class='modal-content animate'>

    <div class='container'>
        <h3>Edit Project</h3>
        <?php
            if(isset($dno)){

                $department->showEditableDepartmentFields($dno);
            }
            ?>
        <?php

        if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['key'])){

            $request = [
                "Dname" => $_POST["edit_Dname"],
                "Dnumber" => $dno
            ];


            $department = new Department();
            $department->updateDepartment($request);
        }

        ?>

    </div>

</div>
</body>

</html>