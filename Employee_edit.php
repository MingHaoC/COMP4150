<?php
include 'includes/DBConnection.php';
include 'includes/Employee.php';
include 'includes/EmployeeView.php';

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
        <h3>Edit Employee</h3>
        <!-- form to edit manager -->
        <form id='editEmployeeForm' action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <?php

            $EditEmployee = new EmployeeView();

            if(isset($_GET["key"])){
                $EditEmployee->showEditableEmployeeFields($_GET["key"]);
            } else if (isset($_POST["key"])) {
                $EditEmployee->showEditableEmployeeFields($_POST["key"]);
            } else {
                Header("Location:Manager.php");
            }
            ?>

        </form>
        <button form='editEmployeeForm' name='key' value="987654321" type='submit'>Submit</button>

        <button type='button' onclick="document.location.href='Employee.php'">Cancel</button>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $employee = new Employee();
            $employee->updatedEmployee($_POST["ssn"], $_POST["edit_fname"], $_POST["edit_minit"], $_POST["edit_lname"], $_POST["edit_bdate"], $_POST["edit_address"], $_POST["edit_sex"], $_POST["edit_salary"], $_POST["edit_super_ssn"]);
        }
        ?>
    </div>
</div>
</body>

</html>