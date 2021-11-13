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
        <h3>Promote Employee:
            <?
            $ssn = $_GET["promote"];
            echo $ssn;
            ?>
        </h3>


        <div>
            <label>
                Select a department for the new manager to manage
            </label>
            <br>
            <?
            $ssn = $_GET["promote"];
            $department = new DepartmentView();
            $department->showAllDepartmentWithNoManager();
            ?>
        </div>

        <!-- form to promote manager -->
        <form id='PromoteEmployeeForm' action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">


        </form>
        <button form='editEmployeeForm' name='key' value="987654321" type='submit'>Submit</button>
        <button type='button' onclick="document.location.href='Manager.php'">Cancel</button>
        <?
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

        }
        ?>
    </div>
</div>
</body>

</html>