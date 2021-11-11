<?php
include 'includes/DBConnection.php';
include 'includes/Employee.php';
//start session
if (!isset($_SESSION)) {
    session_start();
}
?>

<!doctype html>
<html lang="">

<head>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: white;
            font-family: 'Arial';
        }

        .login {
            width: 382px;
            overflow: hidden;
            margin: auto;
            padding: 80px;
            background: grey;
            border-radius: 15px;

        }

        h2 {
            text-align: center;
            color: black;
            padding: 20px;
        }

        label {
            color: black;
            font-size: 17px;
        }

        input {
            width: 100%;
            height: 30px;
            border: none;
            border-radius: 3px;
            padding-left: 8px;
        }

        #log {
            width: 300px;
            height: 30px;
            border: none;
            border-radius: 17px;
            padding-left: 7px;
            color: black;
        }

        span {
            color: white;
            font-size: 17px;
        }

        a {
            float: right;
            background-color: grey;
        }
    </style>
    <title></title>
</head>

<body>
<h2 style="margin: 0 4rem">
    Login Page
</h2>
<div class="login">
    <form id="login" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <label>
            <b>
                Employee SSN
            </b>
            <input type="text" name="ssn" id="ssn" placeholder="SSN" required/>
        </label>
        <br>
        <br>
        <label>
            <b>
                Password
            </b>
            <input type="Password" name="password" id="password" placeholder="Password" required/>
        </label>
        <br><br>
        <button type="submit">Login</button>
        <br><br>
    </form>
</div>
<?php

// User attempting to Login
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $employee = new Employee();
    $ssn = $_POST["ssn"];
    $password = $_POST["password"];
    if ($ssn && $password)
        $employee->login($ssn, $password);
}

?>
</body>

</html>