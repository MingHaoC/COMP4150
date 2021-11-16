<?php

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
        $dname = $request["Dname"];
        $super_ssn = $request["manager"];
       // echo $request["manager"];
        if(strlen($request["manager"]) > 0){
            $sql = "INSERT INTO UW_DEPT_LOCATIONS (Dname, Mgr_ssn, Mgr_start_date)
                    VALUES('$dname', '$super_ssn' , date(y-m-d))";
        }else{
            $sql = "INSERT INTO UW_DEPARTMENT (Dname) VALUES ('$dname')";
        }



        $result = $this->connect()->query($sql);

        echo $result;

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
     * @param $super_ssn
     * @return array
     */
    public function getManager($super_ssn): array
    {
        $sql = "SELECT * FROM UW_EMPLOYEE WHERE Ssn = ". $super_ssn;
        $result = $this->connect()->query($sql);
        if ($result) {
            return $result->fetch_assoc();
        }
        return [];
    }

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
     */
    public function removeDepartment($dno){

        echo $dno;

        if(isset($dno)){
            $sql = "delete from UW_DEPT_LOCATIONS where Dnumber =" . $dno;
            if($this->connect()->query($sql)){
                echo "s1";
                $sql = "delete from UW_EMPLOYEE_DEPARTMENT where Dnno = " . $dno;
                if($this->connect()->query($sql)){
                    echo "s2";

                    $sql = "select * from UW_PROJECT where Dnum = ". $dno;
                    $projects = $this->connect()->query($sql);

                    foreach ($projects as $project){
                        $sql = "delete from UW_WORKS_ON where Pno = ". $project["Pnumber"];
                        if($this->connect()->query($sql)){
                            echo "s3";
                        }else{
                            echo "f3";
                        }
                    }

                    $sql = "delete from UW_PROJECT where Dnum = " . $dno;
                    if($this->connect()->query($sql)){
                        echo "s4";
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

    public function getAllDepartmentLocations(){

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

}