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

if(isset($_GET['edit_deptLocations'])) {
    $dno = $_GET['edit_deptLocations'];
}else{
    Header("Location:Department.php");
}

?>

<!doctype html>
<html>

<head>
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="edit.css">
</head>

<body style="background-color: #f2f2f2">
<div class='modal-content animate'>
    <div class="container">
        <div class="row">
            <h3>
                Department Locations
                <form id="returnToDeptEdit" action="Department.php"></form>
                <button style="float: right;" form="returnToDeptEdit">Back</button>
            </h3>
            <div class="column" style="width: 30%; margin: 0 1rem;">

            <?php
                if(isset($dno)){
                    $department->showDepartmentLocations($dno);
                }

                if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {

                    $dno_dloc = $_POST['delete'];
                    $temp = explode("-", $dno_dloc);
                    $dno = $temp[0];
                    $dlocation = $temp[1];

                    $request = [
                        "Dnum" => $dno,
                        "Dlocation" => $dlocation
                    ];

                    $department->removeLocationFromDepartment($request);
                    Header('Location: '.$_SERVER['PHP_SELF']);
                }
            ?>
            </div>
            <div class="column" style="width: 40%; margin: 0 1rem;">
                <h4>Add Location</h4>
                <?php

                    $department->showAddLocation();

                    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['Dlocation'])) {

                        $request = [
                            "Dnum" => $dno,
                            "Dlocation" => $_POST['Dlocation']
                        ];

                        $department->addLocationToDepartment($request);
                        Header('Location: '.$_SERVER['PHP_SELF']);
                    }
                ?>
            </div>
        </div>
    </div>
</div>

</body>

</html>