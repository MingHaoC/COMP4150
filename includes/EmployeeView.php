<?php

class EmployeeView extends Employee
{

    public function ShowAllEmployee()
    {
        $datas = $this->getAllEmployees();

        echo "<form id='promoteUserForm' action='PromoteEmployee.php' method='GET'></form>";
        echo "<form id='editManagerForm' action='Manager_edit.php' method='GET'><table id='manager' style='margin: 0 auto;'><tr><th>FName</th><th>M.Init</th><th>LName</th><th>SSN</th><th>Bdate</th><th>Address</th><th>Sex</th><th>Salary</th><th>Manager</th><th>Action</th></tr>";
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
                "<td>" . $this->getManagerName($data["super_ssn"]) . "</td>" .
                "<td>
                    <button type='submit' form='editManagerForm' name='key' value=" . $data["Ssn"] . ">Edit</button>
                     <button type='submit' form='promoteUserForm' name='promote' value=" . $data["Ssn"] . " style='background-color: lightgreen'>Promote</button>
                    </form>
                </td>";
            echo "</tr>";
        }
        echo "</table> </form>";
    }



    public function showEditableEmployeeFields($ssn)
    {
        $data = $this->getEmployee($ssn);

        echo "<H4> You are editing User: <input name='ssn'
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
    }
}