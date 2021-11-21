<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class Department extends DBConnection
{
    /**
     * @param $Dno the Department we are looking for
     * @return array|string|null $row object containing all data for that Department
     */
    public function getDepartment($Dno)
    {
        $sql = "SELECT * FROM UW_DEPARTMENT WHERE Dnumber = ". $Dno;
        $result = $this->connect()->query($sql);

        if ($result->num_rows > 0) {
            if ($row = $result->fetch_assoc()) {
                return $row;
            }
        }
        return "N/A";
    }

    /**
     * @return array|bool|mysqli_result
     */
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
    public function getAllDepartments()
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
        $conn = $this->connect();

        $dname = $request["Dname"];
        $dlocation = $request["Dlocation"];

        $sql = "INSERT INTO UW_DEPARTMENT (Dname) VALUES ('$dname')";
        $result = $conn->query($sql);

        if(strlen($request["Dlocation"]) > 0){
            $dnum = $conn->insert_id;
            $sql = "INSERT INTO UW_DEPT_LOCATIONS (Dnumber, Dlocation) VALUES('$dnum', '$dlocation')";
            $conn->query($sql);
        }

        if ($result) {
            echo "<h2 style='color: #0abb0a;text-align: center; '>New Department created successfully!</h2>";
        } else {
            echo "<h2 style='color: #bb0a0a;text-align: center; '>Could not Create Department.</h2>";
        }
    }

    /**
     * @param $mgr_ssn
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
        return "";
    }

    /**
     * @return array
     */
    public function getAllManagersWithNoDepartment(): array
    {
        $sql = "select Fname, Minit, Lname, Ssn, Bdate, Address, Sex, Salary, super_ssn from UW_DEPARTMENT RIGHT JOIN UW_EMPLOYEE ON Ssn = Mgr_ssn WHERE Mgr_ssn IS NOT NULL";
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
     * @param $dno department to be deleted
     *
     * a bucnh of fk constraints need to be deleted first
     */
    public function removeDepartment($dno){


        if(isset($dno)){
            $sql = "delete from UW_DEPT_LOCATIONS where Dnumber =" . $dno;
            if($this->connect()->query($sql)){
                $sql = "delete from UW_EMPLOYEE_DEPARTMENT where Dnno = " . $dno;
                if($this->connect()->query($sql)){
                    $sql = "select * from UW_PROJECT where Dnum = ". $dno;
                    $projects = $this->connect()->query($sql);
                    foreach ($projects as $project){
                        $sql = "delete from UW_WORKS_ON where Pno = ". $project["Pnumber"];
                        if($this->connect()->query($sql)){
                        }else{
                            echo "f3";
                        }
                    }

                    $sql = "delete from UW_PROJECT where Dnum = " . $dno;
                    if($this->connect()->query($sql)){
                        $sql = "delete from UW_DEPARTMENT where Dnumber = " . $dno;
                        if($this->connect()->query($sql)){
                            echo "<h2 style='color: #0abb0a;text-align: center; '>Deleted</h2>";
                            Header('Location: '.$_SERVER['PHP_SELF']);
                            Exit();
                        }else{
                            echo "f5";
                        }
                    }else{
                        echo "f4";
                    }
                }else{
                    echo "f2";
                }
            }else{
                echo "f1";
                // echo "<h2 style='color: #bb0a0a;text-align: center; '>".$this->connect()->error."</h2>";
            }
        }

    }

    /**
     * @return array of the locations
     */
    public function getAllDepartmentLocations(): array
    {
        $sql = "SELECT * FROM UW_DEPT_LOCATIONS";

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
     * @param $dno
     * @return array
     */
    public function getDepartmentEmployees($dno): array
    {

        $sql = "SELECT * FROM UW_EMPLOYEE_DEPARTMENT WHERE Dnno = " . $dno;

        $result = $this->connect()->query($sql);

        if(!$result){
            return [];
        }

        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            return $data;
        } else {
            return [];
        }
    }

    /**
     * @param $dno
     * @return array
     */
    public function getDepartmentLocations($dno): array
    {

        $sql = "SELECT * FROM UW_DEPT_LOCATIONS WHERE Dnumber = " . $dno;
        $result = $this->connect()->query($sql);

        if(!$result){
            return [];
        }

        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            return $data;
        } else {
            return [];
        }
    }


    /**
     * @param $request
     */
    public function removeLocationFromDepartment($request){
        $conn = $this->connect();
        $dno = $request['Dnum'];
        $dlocation = $request['Dlocation'];

        $sql = "DELETE FROM UW_DEPT_LOCATIONS WHERE Dnumber = '$dno' AND Dlocation = '$dlocation'";

        if($conn->query($sql)){
            echo("success");
        }else{
            echo("Error: " . $conn -> error);
        }
    }

    /**
     * @param $request
     */
    public function addLocationToDepartment($request){

        $conn = $this->connect();

        $dno = $request["Dnum"];
        $dlocation = $request["Dlocation"];

        $sql = "INSERT INTO UW_DEPT_LOCATIONS(Dnumber, Dlocation) VALUES('$dno', '$dlocation')";

        if($conn->query($sql)){
            echo "success";
        }else{
            echo("Error: " . $conn -> error);
        }
    }

}