<?php

class Manager extends DBConnection
{
    protected function getAllManager()
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



}