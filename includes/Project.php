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
    public function getAllLocations(): array
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

    public function updateProject($request){

        $Pname = $request['Pname'];
        $Plocation = $request['Plocation'];
        $Dnum = $request['Dnum'];
        $Pno = $request['Pnumber'];

        $conn = $this->connect();

        $sql = "UPDATE UW_PROJECT SET Pname = '$Pname', Plocation = '$Plocation', Dnum = '$Dnum' WHERE Pnumber = '$Pno'";
        $result = $conn->query($sql);
        if($result){
            echo '<script type="text/javascript">';
            echo "alert('Project with $Pno has been successfully updated');";
            echo 'window.location.href = "Project.php";';
            echo '</script>';
        }else{
            echo '<script type="text/javascript">';
            echo "alert('Project with $Pno was NOT updated');";
            echo 'window.location.href = "Project.php";';
            echo '</script>';
        }

    }

    public function getEmployeesNotWorkingOnProject($pno): array
    {
        $conn = $this->connect();

        $sql = "SELECT * FROM UW_EMPLOYEE e LEFT JOIN UW_WORKS_ON w ON e.Ssn = w.Essn WHERE Pno != '$pno'";
        $result = $conn->query($sql);
        if($result){
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $data[] = $row;
                }
                return $data;
            }
        }else{
            echo("Error description: " . $conn -> error);
        }
        return [];
    }

    public function getEmployeesWorkingOnProject($pno): array
    {
        $sql = "SELECT * FROM UW_EMPLOYEE e LEFT JOIN UW_WORKS_ON w ON e.Ssn = w.Essn WHERE Pno = '$pno'";
        $result = $this->connect()->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            return $data;
        }
        return [];
    }

    public function addEmployeeToProject($request){

        $conn = $this->connect();

        $Essn = $request["Essn"];
        $Pno = $request["Pnumber"];

        $sql = "INSERT INTO UW_WORKS_ON(Essn, Pno) VALUES('$Essn', '$Pno')";
        $result = $conn->query($sql);

        if($result){
            echo '<script type="text/javascript">';
            echo "alert('Employee #$Essn has been successfully added to Project #$Pno');";
        }else{

            echo '<script type="text/javascript">';
            echo "alert(Error description: " . $conn -> error . ");";
        }
        Header('Location: ' . $_SERVER['PHP_SELF']);
        echo '</script>';

    }

    public function removeEmployeeFromProject($request){

        $conn = $this->connect();

        $Essn = $request["Essn"];
        $Pno = $request["Pnumber"];

        $sql = "DELETE FROM UW_WORKS_ON WHERE Essn = '$Essn' AND Pno = '$Pno'";
            $result = $conn->query($sql);

        echo '<script type="text/javascript">';
        if($result){
            echo "alert('Employee #$Essn has been successfully removed from Project #$Pno');";
        }else{
            echo "alert(Error description: " . $conn -> error . ");";
        }
        echo '</script>';

    }
}