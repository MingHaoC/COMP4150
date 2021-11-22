<?php

class Employee extends DBConnection
{
    /**
     * Get all employee (not including manager)
     *
     * @return array
     */
    protected function getAllEmployees(): array
    {
        $sql = "select Fname, Minit, Lname, UW_EMPLOYEE.Ssn, Bdate, Address, Sex, Salary, super_ssn, Dnno from UW_DEPARTMENT RIGHT JOIN UW_EMPLOYEE ON Ssn = Mgr_ssn LEFT JOIN UW_EMPLOYEE_DEPARTMENT ON UW_EMPLOYEE.Ssn = UW_EMPLOYEE_DEPARTMENT.Ssn WHERE Mgr_ssn IS NULL";
        $result = $this->connect()->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            return $data;
        }
        return [];
    }

    /**
     * get a specific employee information
     *
     * @param $ssn employee information to be fetch
     * @return array|null
     */
    public function getEmployee($ssn)
    {
        $sql = "SELECT * FROM UW_EMPLOYEE LEFT JOIN UW_EMPLOYEE_DEPARTMENT ON UW_EMPLOYEE.Ssn = UW_EMPLOYEE_DEPARTMENT.Ssn WHERE UW_EMPLOYEE.Ssn = $ssn";
        $result = $this->connect()->query($sql);
        if ($result->num_rows > 0)
            return $result->fetch_assoc();
        return null;
    }

    /**
     * Used to get all manager assigned to a department
     * @return array
     */
    public function getAllManager(): array
    {
        $sql = "select Mgr_ssn, CONCAT(Fname, CONCAT(' ', Lname)) as Name from UW_DEPARTMENT LEFT JOIN UW_EMPLOYEE ON Mgr_ssn = Ssn WHERE Mgr_ssn IS NOT NULL";
        $result = $this->connect()->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            return $data;
        }
        return [];
    }


    // Following three method is used to add a brand-new employee
    protected function executeAddEmployee($fname, $minit, $lname, $ssn, $password, $bdate, $address, $sex, $salary, $super_ssn): bool
    {
        $sql = "INSERT INTO UW_EMPLOYEE (Fname, Minit, Lname, Ssn, Password, Bdate, Address, Sex, Salary, Super_ssn) VALUES('$fname', '$minit', '$lname', $ssn, '$password', '$bdate', '$address', '$sex', $salary, $super_ssn)";
        return $this->connect()->query($sql);
    }

    protected function assignDepartmentToEmployee($ssn, $dno): bool
    {
        $sql = "INSERT INTO UW_EMPLOYEE_DEPARTMENT (Dnno, Ssn) VALUES($dno, $ssn)";
        return $this->connect()->query($sql);
    }

    protected function assignProjectToEmployee($ssn, $pno): bool
    {
        $sql = "INSERT INTO UW_WORKS_ON (Essn, Pno, hours) VALUES($ssn, $pno, 0)";
        return $this->connect()->query($sql);

    }

    // following method will update basic employee information (info in UW_EMPLOYEE table)
    public function updatedEmployee($ssn, $fname, $minit, $lname, $bdate, $address, $sex, $salary, $super_ssn, $department)
    {
        $sql = "UPDATE UW_EMPLOYEE SET Fname = '$fname', Minit = '$minit', Lname = '$lname', Bdate = '$bdate', Address = '$address', Sex='$sex', Salary='$salary', Super_ssn = $super_ssn WHERE Ssn = $ssn";
        if (!$this->connect()->query($sql)) {
            echo "<br>Error: <br>" . $sql . "<br>";
            return;
        }

        $sql = "UPDATE UW_EMPLOYEE_DEPARTMENT SET Dnno = $department WHERE Ssn = $ssn";
        if (!$this->connect()->query($sql)) {
            echo "<br>Error: <br>" . $sql . "<br>";
            return;
        }

        echo '<script type="text/javascript">';
        echo "alert('Employee with $ssn has been successfully updated');";
        echo 'window.location.href = "Manager.php";';
        echo '</script>';

    }

    /**
     * Following method will delete employee (including all foreign key constraint)
     *
     * @param $ssn employee ssn of the employee to be deleted
     * @return bool
     */
    public function executeDeleteEmployee($ssn): bool
    {
        // delete from work on table
        $sql = "DELETE FROM UW_WORKS_ON WHERE Essn = $ssn";
        if (!$this->connect()->query($sql))
            return false;

        // delete from employee_department table
        $sql = "DELETE FROM UW_EMPLOYEE_DEPARTMENT WHERE Ssn = $ssn";
        if (!$this->connect()->query($sql))
            return false;

        // delete from employee table
        $sql = "DELETE FROM UW_EMPLOYEE WHERE Ssn = $ssn";
        if (!$this->connect()->query($sql))
            return false;

        return true;
    }

    /**
     * Following method check the user inputted ssn and password to log an user in
     *
     * @param $ssn employee inputted ssn
     * @param $password employee inputted password
     */
    public function login($ssn, $password)
    {
        $sql = "Select * from UW_EMPLOYEE WHERE Ssn = '$ssn' AND Password = '$password'";
        $result = $this->connect()->query($sql);
        if ($result->num_rows > 0) {
            return true;
        } else {
            echo "<h2 style='color: #bb0a0a;text-align: center;'> Error: You have enter an invalid credentials </h2>";
            return false;
        }
    }

    /**
     * Get name of a manager
     *
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

    protected function getDepartmentName($dnno)
    {
        if ($dnno) {
            $sql = "SELECT Dname FROM UW_DEPARTMENT WHERE Dnumber = $dnno";
            $result = $this->connect()->query($sql);
            if ($result) {
                $row = $result->fetch_assoc();
                return $row["Dname"];
            }
            return "N/A";
        } else return "N/A";
    }

}
