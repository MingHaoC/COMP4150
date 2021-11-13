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

protected function executeDemoteManager($ssn)
    {
        // get managerID from UW_MANAGER table
        $sql = "SELECT * FROM UW_MANAGER WHERE Mgr_ssn = $ssn";
        $result = $this->connect()->query($sql);
        $row = $result->fetch_assoc();
        $managerID = $row["ManagerID"];

        // remove manager from department
        $success = $this->removeManagerFromDepartment($managerID);
        echo("<script>console.log('PHP: " . $success . "');</script>");
        if (!$success) {
            echo 'alert("Something went wrong with demoting a manager. (Function: removeManagerFromDepartment)")';
            return;
        }

        // remove manager from manager_employee
        if(!$this->removeManagerFromManagerEmployee($managerID)) {
            echo 'alert("Something went wrong with demoting a manager.  (Function: removeManagerFromManagerEmployee)")';
            return;
        }
        // remove manager from manager table
        if(!$this->removeManagerFromManager($managerID)) {
            echo 'alert("Something went wrong with demoting a manager")';
            return;
        }

        echo "<h3>Successfully demoted manager with ". $managerID ."</h3>";
    }

    private function removeManagerFromDepartment($managerID): bool
    {
        $sql = "UPDATE UW_DEPARTMENT SET ManagerID = null WHERE ManagerID = $managerID";
        if ($this->connect()->query($sql))
            return true;
        else
            return false;
    }

    private function removeManagerFromManagerEmployee($managerID): bool
    {
        $sql = "UPDATE UW_MANAGER_EMPLOYEE SET ManagerID = null WHERE ManagerID = $managerID";
        if ($this->connect()->query($sql))
            return true;
        else
            return false;
    }

    private function removeManagerFromManager($managerID): bool
    {
        $sql = "DELETE FROM UW_MANAGER WHERE ManagerID = $managerID";
        if ($this->connect()->query($sql))
            return true;
        else
            return false;
    }


}