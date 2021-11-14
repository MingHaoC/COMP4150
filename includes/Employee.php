<?php

class Employee extends DBConnection
{
    protected function getAllEmployees() {
        $sql = "select Fname, Minit, Lname, Ssn, Bdate, Address, Sex, Salary, super_ssn from UW_DEPARTMENT RIGHT JOIN UW_EMPLOYEE ON Ssn = Mgr_ssn WHERE Mgr_ssn IS NULL";
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

    /**
     * @param $managerid
     * @return string
     */
    public function getManagerName($mgr_ssn): string
    {
        $sql = "SELECT * FROM UW_EMPLOYEE WHERE Ssn = $mgr_ssn";
        $result = $this->connect()->query($sql);
        if ($result) {
            $row = $result->fetch_assoc();
            return $row["Fname"] . " " . $row["Lname"];
        }
        return "N/A";
    }

}
