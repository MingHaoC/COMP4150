<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'includes/DBConnection.php';
include 'includes/Manager.php';
include 'includes/ManagerView.php';
require 'includes/Employee.php';
require 'includes/Dependent.php';
require 'includes/DependentView.php';

$dependentView = new DependentView();
$get_Ssn = $_GET["key"];

//start session
if (!isset($_SESSION) || $_SESSION['login']) {
    session_start();
    header("Location:Login.php");
}

$_SESSION['original_url'] = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

?>

<!doctype html>
<html lang="">

<head>
    <link rel="stylesheet" href="edit.css">
</head>

<body>

<h1 style="margin: 0 4rem 2rem 4rem">
    Managers

</h1>

<div class='modal-content animate' style="margin-bottom: 0px">

    <div class='container'>
        <h3>Edit Managers
            <form id="dependent" action="Dependent.php" method="GET">
            <span style="float: right; margin: 0 1rem;">
        <?
        echo "<button form='dependent' class='center' name='submit' onClick=\"document.location.href='Dependent.php'\" value=\"" . $get_Ssn . "\">Dependent</button>"
        ?>
      </span>
            </form>
        </h3>
        <!-- form to edit manager -->
        <form id='editEmployeeForm' method="POST">
            <?
            $editManager = new ManagerView();
            if ($get_Ssn) {
                $editManager->showEditableManagerFields($get_Ssn);
            } else if ($_POST["key"]) {
                $editManager->showEditableManagerFields($_POST["key"]);
            } else {
                Header("Location:Manager.php");
            }
            ?>

        </form>
        <button form='editEmployeeForm' name='key' value="987654321" type='submit'>Submit</button>

        <button type='button' onclick="document.location.href='Manager.php'" name="submitEdit">Cancel</button>
        <?
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $manager = new Manager();
            $manager->executeUpdatedManager($_POST["ssn"], $_POST["edit_fname"], $_POST["edit_minit"], $_POST["edit_lname"], $_POST["edit_bdate"], $_POST["edit_address"], $_POST["edit_sex"], $_POST["edit_salary"], $_POST["edit_super_ssn"]);
        }
        ?>
    </div>
</div>


</body>

</html>