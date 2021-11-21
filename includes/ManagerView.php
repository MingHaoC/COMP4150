<?php

class ManagerView extends Manager
{

    public function demoteManager($ssn)
    {
        $this->executeDemoteManager($ssn);
    }

    public function assignNewManager($ssn, $dnumber)
    {
        $this->executeAssignNewManager($ssn, $dnumber);
    }

    public function showAllManagers()
    {
        $datas = $this->getAllManager();

        echo "<form id='demoteUserForm' method='POST'></form>";
        echo "<form id='editManagerForm' action='Manager_edit.php' method='GET'><table id='manager' style='margin: 0 auto;'><tr><th>FName</th><th>M.Init</th><th>LName</th><th>SSN</th><th>Bdate</th><th>Address</th><th>Sex</th><th>Salary</th><th>Department</th><th>Action</th></tr>";
        foreach ($datas as $data) {
            // output data of each row
            echo "<tr>";
            echo
                "<td>" . $data["Fname"] . "</td>" .
                "<td>" . $data["Minit"] . "</td>" .
                "<td>" . $data["Lname"] . "</td>" .
                "<td>" . $data["Ssn"] . "</td>" .
                "<td>" . $data["Bdate"] . "</td>" .
                "<td>" . $data["Address"] . "</td>" .
                "<td>" . $data["Sex"] . "</td>" .
                "<td>" . $data["Salary"] . "</td>" .
                "<td>" . $data["Dname"] . "</td>" .
                "<td>
                    <button type='submit' form='editManagerForm' name='key' value=" . $data["Ssn"] . ">Edit</button>
                     <button type='submit' form='demoteUserForm' name='demote' value=" . $data["Ssn"] . " style='background-color: red'>Demote</button>
                    </form>
                </td>";
            echo "</tr>";
        }
        echo "</table> </form>";
    }

    public function showEditableManagerFields($ssn)
    {
        $employee = new Employee();
        $data = $employee->getEmployee($ssn);
        $managers = $employee->getAllManager();

        echo "<H4> You are editing Manager: <input name='ssn'
                                              readonly='readonly'
                                              style='border: 0; background-color: white; font-weight: bold; margin-bottom: 0'
                                              value='" . $data["Ssn"] . "' /></H4>
            <Label>First Name: <input type='text' name='edit_fname' value='" . $data["Fname"] . "' required /></Label>
            <Label>Minit: <input type='text' name='edit_minit' value='" . $data["Minit"] . "' /></Label>
            <Label>Last Name: <input type='text' name='edit_lname' value='" . $data["Lname"] . "' required /></Label>
            <Label>Birthdate: <input type='tate' name='edit_bdate' value='" . $data["Bdate"] . "' /></Label>
            <Label>Address: <input type='text' name='edit_address' value='" . $data["Address"] . "' /></Label>
            <Label> Sex: <input type='text' name='edit_sex' value='" . $data["Sex"] . "' maxlength='1'/></Label>
            <Label> Salary <input type='number' name='edit_salary' value='" . $data["Salary"] . "' step='0.01' required/></Label>";
        echo "<Lable>Super_ssn: <select name='edit_super_ssn' id='department'>";
        if (is_null($data['super_ssn']))
            echo "<option selected='selected' value='" . NULL . "'> No manager </option>";
        else
            echo "<option value='" . NULL . "'> No manager </option>";
        foreach ($managers as $manager)
            if ($data['Ssn'] !== $manager["Mgr_ssn"]) {
                if ($data['super_ssn'] == $manager["Mgr_ssn"])
                    echo "<option selected='selected' value='" . $manager['Mgr_ssn'] . "'>" . $manager["Name"] . "</option>";
                else
                    echo "<option value='" . $manager['Mgr_ssn'] . "'>" . $manager["Name"] . "</option>";
            }
        echo "</select></Lable><br><br>";
    }

}