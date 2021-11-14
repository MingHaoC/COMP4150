<?php

class Department extends DBConnection
{
    /**
     * @param $Dno the Department we are looking for
     * @return array|string|null $row object containing all data for that Department
     */
    public function getDepartment($Dno)
    {
        $sql = "SELECT * FROM UW_DEPARTMENT WHERE Dnumber = $Dno";
        $result = $this->connect()->query($sql);

        if ($result->num_rows > 0) {
            if ($row = $result->fetch_assoc()) {
                return $row;
            }
        }
        return "N/A";
    }

    public function getAllDepartmentWithNoManager()
    {
        $sql = "SELECT * FROM UW_DEPARTMENT WHERE Mgr_ssn IS NULL";
        $result = $this->connect()->query($sql);
        echo "<script>console.log('Debug Objects: num " . $result->num_rows . "' );</script>";
        if ($result)
            return $result;
        return [];
    }

    /**
     * @return array
     */
    protected function getAllDepartments()
    {
        $sql = "SELECT * FROM UW_DEPARTMENT";
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
     * @param $request
     */
    public function addDepartment($request)
    {

        $dname = $request["Dname"];
        $dlocation = $request["Dlocation"];
        $managerID = $request["ManagerID"];

        if (!($this->checkManagerExistence($managerID))) {
            echo "<h2 style='color: #bb0a0a;text-align: center; '>Please Enter A valid ManagerID.</h2>";
        } else {

            $sql = "INSERT INTO UW_DEPARTMENT (Dname, ManagerID, Dlocation)
                    VALUES('$dname', '$managerID', '$dlocation')";

            $result = $this->connect()->query($sql);

            echo $result;

            if ($result) {
                echo "<h2 style='color: #0abb0a;text-align: center; '>New Department created successfully!</h2>";
            } else {
                echo "<h2 style='color: #bb0a0a;text-align: center; '>Could not Create Department.</h2>";
            }
        }
    }

    /**
     * @param $managerid
     * @return bool
     */
    public function checkManagerExistence($managerid): bool
    {
        $sql = "SELECT * FROM UW_MANAGER WHERE ManagerID = $managerid";
        $result = $this->connect()->query($sql);
        if ($result->num_rows > 0) {
            return true;
        }
        return false;
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