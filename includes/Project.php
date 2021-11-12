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

}