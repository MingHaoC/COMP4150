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

        <h3>Edit Department</h3>
        <!-- form to edit department -->
        <?php

        if (isset($dno)) {
            $department->showEditableDepartmentFields($dno);
        } else {
            Header("Location:Department.php");
        }

        ?>
        <br/>
        <button form='editDepartmentForm' name='key' value=$dno type='submit'>Submit</button>
        <button type='button' onclick="document.location.href='Department.php'">Cancel</button>

        <hr/>

    </div>

</div>
</body>

</html>