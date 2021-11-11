<?php

class EmployeeView extends Employee
{
    public function showEditableEmployeeFields($ssn)
    {
        $data = $this->getEmployee($ssn);

        echo "<H4> You are editing User: <input name='ssn'
                                              readonly='readonly'
                                              style='border: 0; background-color: white; font-weight: bold; margin-bottom: 0'
                                              value='". $data["Ssn"] ."' /></H4>
            <Label>First Name: <input type='text' name='edit_fname' value='". $data["Fname"] ."' required /></Label>
            <Label>Minit: <input type='text' name='edit_minit' value='". $data["Minit"] ."' /></Label>
            <Label>Last Name: <input type='text' name='edit_lname' value='". $data["Lname"] ."' required /></Label>
            <Label>Birthdate: <input type='tate' name='edit_bdate' value='". $data["Bdate"] ."' /></Label>
            <Label>Address: <input type='text' name='edit_address' value='". $data["Address"] ."' /></Label>
            <Label> Sex: <input type='text' name='edit_sex' value='". $data["Sex"] ."' maxlength='1'/></Label>
            <Label> Salary <input type='number' name='edit_salary' value='". $data["Salary"] ."' step='0.01' required/></Label>";
    }
}