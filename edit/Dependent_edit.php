<?php
include 'includes/DBConnection.php';
include 'includes/Dependent.php';
include 'includes/DependentView.php';

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
        <form id='editDepartmentForm' action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <?
            $EditDepartment = new DepartmentView();
            $get_Dnumber = $_GET["key"];
            $post_Dnumber = $_POST["key"];
            if ($get_Dnumber) {
                $EditDepartment->showEditableDepartmentFields($get_Dnumber);
            } else if ($post_Dnumber) {
                $EditDepartment->showEditableDepartmentFields($post_Dnumber);
            } else {
                Header("Location:Department.php");
            }
            ?>

        </form>
        <button type='button' onclick="document.location.href='Manager.php'">Cancel</button>
        <?
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $employee = new Employee();
            $employee->updatedEmployee($_POST["ssn"], $_POST["edit_fname"], $_POST["edit_minit"], $_POST["edit_lname"], $_POST["edit_bdate"], $_POST["edit_address"], $_POST["edit_sex"], $_POST["edit_salary"]);
        }
        ?>
    </div>
</div>
</body>

</html>