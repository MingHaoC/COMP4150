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
    if ($_SESSION["login"] != 1)
        header("Location:Login.php");
}

if (isset($_GET['edit_deptLocations']))
    $dno = $_GET['edit_deptLocations'];
else
    Header("Location:Department.php");


$department = new DepartmentView();

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
            <form id="returnToDeptEdit" action="Department_edit.php" method="post"></form>
            <h3>
                Department Locations
                <button style="float: right;" name="backFromEditLocations"
                        value=<? echo $dno ?> form="returnToDeptEdit">Back
                </button>
            </h3>
            <div class="column" style="width: 30%; margin: 0 1rem;">

                <?php

                $department->showDepartmentLocations($dno);


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
                    Header('Location: ' . $_SERVER['PHP_SELF']);
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
                    Header('Location: ' . $_SERVER['PHP_SELF']);
                }
                ?>
            </div>
        </div>
    </div>
</div>

</body>

</html>