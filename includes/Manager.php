<?php

class Manager extends DBConnection
{
    public function getAllManager()
    {
        $sql = "SELECT * FROM UW_EMPLOYEE RIGHT JOIN UW_MANAGER ON Ssn = Mgr_ssn";
        $result = $this->connect()->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            return $data;
        }
        return [];
    }

    public function getManagerID($m_ssn){
        $sql = "SELECT * FROM UW_MANAGER WHERE Mgr_ssn = $m_ssn";
        $result = $this->connect()->query($sql);
        if ($result->num_rows > 0) {
            if($row = $result->fetch_assoc()) {
                return $row["ManagerID"];
            }
        }
        return "N/A";
    }




}