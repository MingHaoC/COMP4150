<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (!isset($_SESSION)) {
    session_start();
    if ($_SESSION["login"] != 1)
        header("Location:Login.php");
}

include 'includes/DBConnection.php';
include 'includes/Employee.php';
include 'includes/EmployeeView.php';
include 'includes/Dependent.php';
include 'includes/DependentView.php';

$dependentView = new DependentView();
$get_Ssn = $_GET["submit"];


?>

<!doctype html>
<html>
<head>
    <link rel="stylesheet" href="index.css">
</head>

<body style="background-color: #f2f2f2">

<h1 style="margin: 0 4rem 2rem 4rem">
    <?
    echo "Dependent for Employee $get_Ssn";
    ?>

    <span style="float: right; margin: 0 4rem;">
        <?
        $redirect = $_SESSION['original_url'];
        echo "<a href=\"$redirect\">
                    <button type=\"submit\">Back</button>
                  </a>"
        ?>
    </span>
</h1>

<div class="row">
    <div class="column" style="width: 30%;">
        <h3>Add an dependent</h3>
        <?
        $dependentView->showAddDependent();
        ?>
    </div>

    <div class="column" style="width: 60%; margin: 0 1rem;">
        <h3>View Dependents</h3>
        <?
        $dependentView->getUserDependent($get_Ssn);
        ?>
    </div>

    <div class="column" style="width: 100%; color: red">

        <?
        if (isset($_POST["AddDependent"])) {
            $dependentView->addDependent($get_Ssn, $_POST["Dependent_name"], $_POST["Sex"], $_POST["Bdate"], $_POST["Relationship"]);
        } else if (isset($_POST["DeleteDependent"])) {
            $dependentView->deleteDependent($get_Ssn, $_POST["DeleteDependent"]);
        }
        ?>
    </div>
</div>

</body>

</html>