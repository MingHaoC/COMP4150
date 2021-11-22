<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//start session
if (!isset($_SESSION)) {
    session_start();
    $_SESSION['original_url'] = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    if ($_SESSION["login"] != 1)
        header("Location:Login.php");
}


include 'includes/DBConnection.php';
include 'includes/Employee.php';
include 'includes/EmployeeView.php';
include 'includes/Dependent.php';
include 'includes/DependentView.php';

$dependentView = new DependentView();
$get_Ssn = $_GET["key"];

?>

<!doctype html>
<html lang="">

<head>
    <link rel="stylesheet" href="edit.css">
</head>

<body>

<h1 style="margin: 0 4rem 2rem 4rem">
    Employees
    <form id="dependent" action="Dependent.php" method="GET">

    </form>
</h1>

<div class='modal-content animate' style="margin-bottom: 0px">

    <div class='container'>
        <h3>Edit Employee
            <span style="float: right; margin: 0 4rem;">
                <?
                echo "<button form='dependent' class='center' name='submit' onClick=\"document.location.href='Dependent.php'\" value=\"" . $get_Ssn . "\">Dependent</button>"
                ?>
            </span>
        </h3>
        <!-- form to edit manager -->

        <form id='editEmployeeForm' method="POST">
            <?
            $EditEmployee = new EmployeeView();
            if ($get_Ssn) {
                $EditEmployee->showEditableEmployeeFields($get_Ssn);
            } else if ($_POST["key"]) {

                $EditEmployee->showEditableEmployeeFields($_POST["key"]);
            } else {
                Header("Location:Manager.php");
            }
            ?>

        </form>

        <button form='editEmployeeForm' name='key' value="$get_Ssn" type='submit'>Submit</button>

        <button type='button' onclick="document.location.href='Employee.php'" name="submitEdit">Cancel</button>
        <?
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $employee = new Employee();
            $employee->updatedEmployee($_POST["key"], $_POST["edit_fname"], $_POST["edit_minit"], $_POST["edit_lname"], $_POST["edit_bdate"], $_POST["edit_address"], $_POST["edit_sex"], $_POST["edit_salary"], $_POST["edit_super_ssn"], $_POST["edit_department"]);
        }
        ?>
    </div>
</div>


</body>

</html>