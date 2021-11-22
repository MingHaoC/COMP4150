<?php

require_once "includes/DBConnection.php";
require_once "includes/Department.php";
require_once "includes/DepartmentView.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//start session
if (!isset($_SESSION) || $_SESSION['login']) {
    session_start();
    header("Location:Login.php");
}

$department = new DepartmentView();

if (isset($_GET['edit_deptEmployees'])) {
    $dno = $_GET['edit_deptEmployees'];
} else {
    Header("Location:Department.php");
}

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

            <form id="returnToDeptEdit" action="Department_edit.php" method="post"></form>
            <h3>
                Department Locations
                <button style="float: right;" name="backFromEditEmployees"
                        value=<? echo $dno ?> form="returnToDeptEdit">Back
                </button>
            </h3>

            <div class="column" style="width: 46%; margin: 0 1rem;">

                <?php

                $department->showEmployeesWorkingInDepartment($dno);

                if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["remove_FromDepartment"])){
                    $temp = $_POST["remove_FromDepartment"];
                    $temp = explode("-", $temp);
                    $ssn = $temp[0];
                    $dno = $temp[1];

                    $request = [
                        "Essn" => $ssn,
                        "Dnumber" => $dno
                    ];
                    $department->removeEmployeeFromDepartment($request);
                }

                ?>

            </div>

            <div class="column" style="width: 48%; margin: 0 1rem;">

                <?php

                $department->showEmployeesNotWorkingInDepartment($dno);

                if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add_ToDepartment"])){
                    $temp = $_POST["add_ToDepartment"];
                    $temp = explode("-", $temp);
                    $ssn = $temp[0];
                    $dno = $temp[1];

                    $request = [
                        "Essn" => $ssn,
                        "Dnumber" => $dno
                    ];

                    $department->addEmployeeToDepartment($request);
                }

                ?>

            </div>

        </div>
    </div>
</div>




</body>

</html>