<?php

class Dependent extends DBConnection
{

    protected function getAllDependents()
    {
        $sql = "SELECT * FROM UW_DEPENDENT";
        $result = $this->connect()->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            return $data;
        }
        return [];

    }

    public function getDependee($DependentID){
        $sql = "SELECT * FROM UW_EMPLOYEE WHERE Ssn = (SELECT Ssn FROM UW_EMPLOYEE_DEPENDENT 
                WHERE DependentID = ". $DependentID .")";
        $result = $this->connect()->query($sql);
        if ($result->num_rows > 0) {
            if($row = $result->fetch_assoc()) {
                return $row["Fname"] . " " . $row["Lname"];
            }
        }
        return "N/A";
    }

}