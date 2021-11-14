<?php

class Manager extends DBConnection
{
    public function getAllManager()
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

    protected function executeDemoteManager($ssn)
    {
        // remove manager from department
        if (!$this->removeManagerFromDepartment($ssn)) {
            echo 'alert("Something went wrong with demoting a manager. (Function: removeManagerFromDepartment)")';
            return;
        }

        // remove manager from employee super_ssn
        if (!$this->removeManagerFromEmployee($ssn)) {
            echo 'alert("Something went wrong with demoting a manager.  (Function: removeManagerFromManagerEmployee)")';
            return;
        }

        echo '<script type="text/javascript">';
        echo "alert('Successfully demoted manager with ssn: $ssn');";
        echo 'window.location.href = "Manager.php";';
        echo '</script>';
    }

    private function removeManagerFromDepartment($mgr_ssn): bool
    {
        $sql = "UPDATE UW_DEPARTMENT SET Mgr_ssn = null, Mgr_start_date = null WHERE Mgr_ssn = $mgr_ssn";
        $db = $this->connect();
        if ($db->query($sql))
            return true;
        else
            echo "<h3>$db->error</h3>";
        return false;
    }

    private function removeManagerFromEmployee($super_ssn): bool
    {
        $sql = "UPDATE UW_EMPLOYEE SET super_ssn = null WHERE super_ssn = $super_ssn";
        if ($this->connect()->query($sql))
            return true;
        else
            return false;
    }

    protected function executeAssignNewManager($ssn, $dnumber)
    {
        // create new manager in the uw_manager table
        $sql = "UPDATE UW_DEPARTMENT SET Mgr_ssn = $ssn, Mgr_start_date = NOW() WHERE Dnumber = $dnumber";
        $db = $this->connect();
        if (!$db->query($sql)) {
            echo '<h3>"Something went wrong with promoting a manager.  (Function: AddManagerToDepartment)"</h3>';
            return;
        }

        // assign the new manager for the department
        if ($this->addManagerToEmployee($ssn, $dnumber)) {
            echo '<script type="text/javascript">';
            echo "alert('Employee with $ssn has been successfully promote to a manager');";
            echo 'window.location.href = "Employee.php";';
            echo '</script>';
        } else {
            echo '<h3>"Something went wrong with promoting a manager.  (Function: updateEmployee)"</h3>';
        }
    }

    public function addManagerToEmployee($super_ssn, $dnumber)
    {
        // get a list of employee in the $dnumber and has null for super_ssn
        $sql = "select GROUP_CONCAT(UW_EMPLOYEE.Ssn) as ssn from UW_EMPLOYEE left join UW_EMPLOYEE_DEPARTMENT ON UW_EMPLOYEE.Ssn = UW_EMPLOYEE_DEPARTMENT.Ssn WHERE super_ssn IS NULL AND Dnno = $dnumber";
        $db = $this->connect();
        $result = $db->query($sql);
        if (!$result)
            return false;

        // get the query result and concat the ssn together, so we only have to commit one update to the database
        $row = $result->fetch_assoc();
        $ssn = $row["ssn"];
        $ssn = str_replace(",", " OR ssn = ", $ssn);

        // create the update string and commit the update
        $sql = "UPDATE UW_EMPLOYEE SET super_ssn = $super_ssn WHERE ssn = $ssn";
        $result = $this->connect()->query($sql);
        if ($result)
            return true;
        else
            echo "<h3>$db->error</h3>";
        return false;
    }

}