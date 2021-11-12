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



}