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
            <?
            $EditManager = new EmployeeView();
            $get_Ssn = $_GET["key"];
            $post_Ssn = $_POST["key"];
            if ($get_Ssn) {
                $EditManager->showEditableEmployeeFields($get_Ssn);
            } else if ($post_Ssn) {
                $EditManager->showEditableEmployeeFields($post_Ssn);
            } else {
                Header("Location:Employee.php");
            }
            ?>

        </form>
        <button form='editEmployeeForm' name='key' value="987654321" type='submit'>Submit</button>
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