<?php

class DepartmentView extends Department
{

    public function showAllDepartments(){
        $datas = $this->getAllDepartments();

        echo "<form id='editDepartmentForm' action='edit/Department_edit.php' method='GET'><table id='manager' style='margin: 0 auto;'>".
            "<tr><th>Department Name</th><th>Department No.</th><th>Location</th><th>Manager Name</th><th>Manager ID</th>".
            "<th>Action</th></tr>";
        foreach ($datas as $data) {
            // output data of each row
            echo "<tr>";
            echo "<td>" .$data["Dname"] . "</td>".
                "<td>" . $data["Dnumber"]. "</td>".
                "<td>" . $this->getDepartmentLocation($data["Dnumber"]) . "</td>".
                "<td>" . $data["Dname"]. "</td>".
                "<td>" . $data["Dname"]. "</td>".
                "<td>
                    <button type='submit' form='editDepartmentForm' name='key' value=" . $data["Dnumber"] . ">Edit</button></form>
                </td>";
            echo "</tr>";
        }
        echo "</table>";
    }

    public function showEditableDepartmentFields($Dnumber){

        $department = $this->getDepartment($Dnumber);

        echo "<H4> You are editing Department: <input name='Dnumber'
//                                              readonly='readonly'
//                                              style='border: 0; background-color: white; font-weight: bold; margin-bottom: 0'
//                                              value='". $department["Dnumber"] ."' /></H4>";

        echo "test";

//        echo "<H4> You are editing Department: <input name='Dnumber'
//                                              readonly='readonly'
//                                              style='border: 0; background-color: white; font-weight: bold; margin-bottom: 0'
//                                              value='". $department["Dnumber"] ."' /></H4>
//
//            <Label>Department Name: <input type='text' name='edit_dname' value='". $department["Dname"] ."' required /></Label>
//            <Label>Department Location: <input type='text' name='edit_dlocation' value='". $this->getDepartmentLocation($Dnumber) . "' required /></Label>
//            <Label>Department Manager: <input type='text' readonly='readonly' name='edit_dmanager' value='". $this->getDepartmentManager() ."' required /></Label>";

    }



}