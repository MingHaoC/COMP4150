<?php

class Employee extends DBConnection
{
    protected function getAllEmployees() {
        $sql = "SELECT * FROM UW_EMPLOYEE LEFT JOIN UW_MANAGER ON Ssn != Mgr_ssn";
        $result = $this->connect()->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            return $data;
        }
        return [];
    }

    protected function getEmployee($ssn)
    {
        $sql = "SELECT * FROM UW_EMPLOYEE WHERE Ssn = $ssn";
        $result = $this->connect()->query($sql);
        if ($result->num_rows > 0)
            return $result->fetch_assoc();
        return null;
    }

    public function updatedEmployee($ssn, $fname, $minit, $lname, $bdate, $address, $sex, $salary)
    {
        $sql = "UPDATE UW_EMPLOYEE SET Fname = '$fname', Minit = '$minit', Lname = '$lname', Bdate = '$bdate', Address = '$address', Sex='$sex', Salary='$salary' WHERE Ssn = $ssn";
        $conn = $this->connect();
        if ($conn->query($sql) === TRUE)
            echo "<br>Employee: " . $ssn . " was successfully updated!";
        else
            echo "<br>Error: <br>" . $sql . "<br>" . $conn->error;
    }

    public function login($ssn, $password)
    {
        $sql = "Select * from UW_EMPLOYEE WHERE Ssn = '$ssn' AND Password = '$password'";
        $result = $this->connect()->query($sql);
        if($result->num_rows > 0)
            header("Location:index.php");
         else
            echo "<h2 style='color: #bb0a0a;text-align: center;'> Error: You have enter an invalid credentials </h2>";
    }

}
