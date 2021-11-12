<?php

class Project extends DBConnection
{
    protected function getAllProjects(): array
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

    public function getDepartmentName($Dno){
        $sql = "SELECT Dname FROM UW_DEPARTMENT WHERE Dnumber = " . $Dno;
        $result = $this->connect()->query($sql);
        if ($result->num_rows > 0) {
            if($row = $result->fetch_assoc()) {
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

        // remember to add to relational tables.

        $conn = $this->connect();

        $pname = $request["Pname"];
        $plocation = $request["Plocation"];
        $dnum = $request["Dnum"];

        if (!($this->checkDepartmentExistence($dnum))) {
            echo "<h2 style='color: #bb0a0a;text-align: center; '>Please Enter A valid Department Number.</h2>";
        } else {

            $sql = "INSERT INTO UW_PROJECT (Pname, Plocation, Dnum)
                    VALUES('$pname', '$plocation', '$dnum')";

            $result = $conn->query($sql);
            $pno = mysqli_insert_id($conn);
            //successfully added to projects
            if ($result) {
                //now need to add to works_on table

                $sql = "SELECT * FROM UW_EMPLOYEE_DEPARTMENT WHERE Dnno = ". $dnum;
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $employees[] = $row;
                    }
                    $this->addToWorksOn($employees, $pno);
                }
            } else {
                echo "<h2 style='color: #bb0a0a;text-align: center; 'Error:".  $sql . " " .$this->connect()->error."</h2>";
            }
        }

    }

    /**
     * @param $dnum
     * @return bool
     */
    public function checkDepartmentExistence($dnum): bool
    {
        $sql = "SELECT * FROM UW_DEPARTMENT WHERE Dnumber = $dnum";
        $result = $this->connect()->query($sql);
        if ($result->num_rows > 0) {
            return true;
        }
        return false;
    }

    /**
     * adds the employees of the assigned department and the project number to the works_on table.
     * @param $employees
     * @param $pno
     */
    public function addToWorksOn($employees, $pno){
        foreach ($employees as $employee){
            $Essn = $employee["Ssn"];

            $sql = "INSERT INTO UW_WORKS_ON (Essn, Pno)
                            VALUES('$Essn', '$pno')";
            $this->connect()->query($sql);
        }

    }

}