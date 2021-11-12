<?php
include 'includes/DBConnection.php';
include 'includes/Department.php';
include 'includes/DepartmentView.php';

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

        <h3>Edit Department</h3>
        <!-- form to edit department -->
        <?php
        echo "test";
        $department = new DepartmentView();
        echo "test";
        $department->showEditableDepartmentFields(5);
        ?>
    test
    </div>
</div>
</body>

</html>