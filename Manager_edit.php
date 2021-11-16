<?php


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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
    <style>
        input {
            width: 100%;
            display: inline-block;
            margin: 0 0 1rem 0;
        }

        .container {
            padding: 0 2rem 2rem 2rem;

        }

        /* Modal Content/Box */
        .modal-content {
            background-color: #fefefe;
            margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
            border: 1px solid #888;
            width: 80%; /* Could be more or less, depending on screen size */
        }

        /* Add Zoom Animation */
        .animate {
            -webkit-animation: animatezoom 0.6s;
            animation: animatezoom 0.6s
        }

        @-webkit-keyframes animatezoom {
            from {
                -webkit-transform: scale(0)
            }
            to {
                -webkit-transform: scale(1)
            }
        }

        @keyframes animatezoom {
            from {
                transform: scale(0)
            }
            to {
                transform: scale(1)
            }
        }
    </style>
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
                Header("Location:Manager.php");
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