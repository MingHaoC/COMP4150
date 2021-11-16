<?php

require 'includes/DBConnection.php';
require 'includes/Dependent.php';
require 'includes/DependentView.php';

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

        <h3>Edit Dependent</h3>
        <!-- form to edit manager -->
        <form id='editDependentForm' action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">

            <?php
            $EditDepartment = new DepartmentView();
            $get_Dnumber = $_GET["key"];
            $post_Dnumber = $_POST["key"];
            if ($get_Dnumber) {
                $EditDepartment->showEditableDepartmentFields($get_Dnumber);
            } else if ($post_Dnumber) {
                $EditDepartment->showEditableDepartmentFields($post_Dnumber);
            } else {
                Header("Location:Dependent.php");
            }
            ?>

        </form>

        <button type='button' onclick="document.location.href='Dependent.php'">Cancel</button>
        <?php
//        if ($_SERVER["REQUEST_METHOD"] == "POST") {
//            $employee = new Employee();
//            $employee->updatedEmployee($_POST["ssn"], $_POST["edit_fname"], $_POST["edit_minit"], $_POST["edit_lname"], $_POST["edit_bdate"], $_POST["edit_address"], $_POST["edit_sex"], $_POST["edit_salary"]);
//        }

        ?>
    </div>
</div>
</body>

</html>