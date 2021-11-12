<?php
class Department extends DBConnection
{
    /**
     * @param $Dno the Department we are looking for
     * @return array|string|null $row object containing all data for that Department
     */
    public function getDepartment($Dno){
        $sql = "SELECT * FROM UW_DEPARTMENTS WHERE Dnumber = ". $Dno;
        $result = $this->connect()->query($sql);
        if ($result->num_rows > 0) {
            if($row = $result->fetch_assoc()) {
                return $row;
            }
        }
        return "N/A";
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
     * @return string
     */
    protected function getDepartmentManager(){

        //need query to get the manager's name & id of each department
       // $sql = "SELECT ManagerID, Manage"
        return "- N/A -";
    }

    /**
     * returns location of specified department
     */
    protected function getDepartmentLocation($Dno){

        $sql = "SELECT * FROM UW_DEPT_LOCATIONS WHERE Dnumber = $Dno";
        $result = $this->connect()->query($sql);
        if ($result->num_rows > 0) {
            if($row = $result->fetch_assoc()) {
                return $row["Dlocation"];
            }
        }
        return "N/A";
    }

    /**
     * @param $request
     */
    public function addDepartment($request){

        $dname = $request["Dname"];
        $dlocation = $request["Dlocation"];
        $managerID = $request["ManagerID"];

        echo $dname;
        echo $dlocation;
        echo $managerID;

        if(!$dname){
            echo "Please Enter a Proper Department Name";
        }else if(!$dlocation){
            echo "Please Enter a Proper Location Name";
        }else if(!($this->checkManagerExistence($managerID))){
            echo "Please Enter a valid ManagerID";
        }else{

            echo "passed all tests";

            $sql = "INSERT INTO UW_DEPARTMENT (Dname, ManagerID, Dlocation)
                    VALUES('$dname', '$managerID', $dlocation)";
            if($this->connect()->query($sql) === TRUE){
                echo "<h2 style='color: #0abb0a;text-align: center; '>New Department created successfully!</h2>";
            }else{

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
    public function getManagerName($managerid):string
    {
        $sql = "SELECT * FROM UW_EMPLOYEE WHERE Ssn = (SELECT Mgr_ssn FROM UW_MANAGER
                WHERE ManagerID = ". $managerid .")";
        $result = $this->connect()->query($sql);
        if ($result->num_rows > 0) {
            if($row = $result->fetch_assoc()) {
                return $row["Fname"] . " " . $row["Lname"];
            }
        }
        return "N/A";
    }

}