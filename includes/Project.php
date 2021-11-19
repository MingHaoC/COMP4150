<?php

class Project extends DBConnection
{
    public function getAllProjects(): array
    {
        $sql = "SELECT * FROM UW_PROJECT";
        $result = $this->connect()->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            return $data;
        }
        return [];

    }

    public function getDepartmentName($Dno)
    {
        $sql = "SELECT Dname FROM UW_DEPARTMENT WHERE Dnumber = " . $Dno;
        $result = $this->connect()->query($sql);
        if ($result->num_rows > 0) {
            if ($row = $result->fetch_assoc()) {
                return $row["Dname"];
            }
        }
        return "N/A";
    }

    /**
     * @param $request
     */
    public function addProject($request)
    {
        $conn = $this->connect();

        $pname = $request["Pname"];
        $plocation = $request["Plocation"];
        $dnum = $request["Dnum"];

        $sql = "INSERT INTO UW_PROJECT (Pname, Plocation, Dnum)
                    VALUES('$pname', '$plocation', '$dnum')";
        $result = $conn->query($sql);
        if ($result) {
            echo "<h2 style='color: #0abb0a;text-align: center; '>New Project created successfully!</h2>";
        } else {
            echo "<h2 style='color: #bb0a0a;text-align: center; '>Could not Create Project.</h2>";
        }


    }

    public function removeProject($pno){

        $conn = $this->connect();

        if(isset($pno)){

            $sql = "delete from UW_WORKS_ON WHERE Pno = " . $pno;
                if($conn->query($sql)){
                    $sql = "delete from UW_PROJECT WHERE Pnumber = " . $pno;
                    if($conn->query($sql)){
                        echo "<h2 style='color: #0abb0a;text-align: center; '>Deleted</h2>";
                        Header('Location: '.$_SERVER['PHP_SELF']);
                        Exit();
                    }else{
                        echo("Error description: " . $conn -> error);
                        echo "<h2 style='color: #bb0a0a;text-align: center; '>Not Deleted</h2>";
                    }
                }
        }

    }


    /**
     * adds the employees of the assigned department and the project number to the works_on table.
     * @param $employees
     * @param $pno
     */
    public
    function addToWorksOn($employees, $pno)
    {
        foreach ($employees as $employee) {
            $Essn = $employee["Ssn"];

            $sql = "INSERT INTO UW_WORKS_ON (Essn, Pno)
                            VALUES('$Essn', '$pno')";
            $this->connect()->query($sql);
        }
    }

    public
    function getProject($pno)
    {

        $sql = "SELECT * FROM UW_PROJECT WHERE Pnumber = " . $pno;
        $result = $this->connect()->query($sql);

        if ($result->num_rows > 0) {
            if ($row = $result->fetch_assoc()) {
                return $row;
            }
        }
        return "N/A";

    }

    /**
     * returns an array of all the locations, no duplicates
     */
    public
    function getAllLocations(): array
    {
        $sql = "SELECT DISTINCT Dlocation FROM UW_DEPT_LOCATIONS";
        $result = $this->connect()->query($sql);

        if (!$result) {
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

}