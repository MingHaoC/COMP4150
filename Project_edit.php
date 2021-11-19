<?php
require 'includes/DBConnection.php';
require 'includes/Project.php';
require 'includes/ProjectView.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//start session
if (!isset($_SESSION)) {
    session_start();
}

$project = new ProjectView();

?>

<!doctype html>
<html lang="">

<head>
    <link rel="stylesheet" href="edit.css">
</head>

<body>
<div class='modal-content animate'>
    <div class='container'>
        <h3>Edit Project</h3>
        <!-- form to edit manager -->

        <?php

            if(isset($_GET['key'])){
                $pno = $_GET['key'];
                echo $pno;
            }

            if(isset($pno)){
                $project->showEditableProjectFields($pno);
            }
        ?>

        <button form='editProjectForm' name='key' value="987654321" type='submit'>Submit</button>
        <button type='button' onclick="document.location.href='Project.php'">Cancel</button>
    </div>
</div>
</body>

</html>