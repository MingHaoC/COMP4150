<?php
include 'includes/DBConnection.php';
include 'includes/Manager.php';
include 'includes/ManagerView.php';
if (!isset($_SESSION)) {
    session_start();
}
?>
<!doctype html>

<html>

<head>

    <style>

        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Clear floats after the columns */
        .row:after {
            content: "";
            display: table;
            clear: both;
        }

        .column {
            float: left;
            text-align: center;
        }

        input {
            width: 75%;
            display: inline-block;
            margin: 4px auto;
            height: 2.5vh;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 3%;
        }

        table td, #editManagerForm th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        table tr:hover {
            background-color: #ddd;
        }

        table th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #66AAFF;
        }

    </style>

</head>

<body style="background-color: #f2f2f2">
<h1 style="margin: 1rem 4rem 2rem 4rem">
    Managers

    <span style="float: right; margin: 0 4rem;">
        <button class="center" name="submit" onClick="document.location.href='index.php'">Home</button>
        <button class="center" name="submit" onClick="document.location.href='Department.php'">Departments</button>
        <button class="center" name="submit" onClick="document.location.href='Dependent.php'">Dependents</button>
        <button class="center" name="submit" onClick="document.location.href='Employee.php'">Employees</button>
        <button class="center" name="submit" onClick="document.location.href='Project.php'">Projects</button>
    </span>
</h1>

<div style="width: 50%; margin: auto">

    <!-- database display -->
    <?php
    $managers = new ManagerView();
    $managers->showAllManagers();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $ssn = $_POST["demote"];
        $managers->demoteManager($ssn);
    }
    ?>

</div>
</body>

</html>