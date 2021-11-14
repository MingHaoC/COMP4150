<?php

class DepartmentView extends Department
{

    public function showAllDepartments()
    {
        $datas = $this->getAllDepartments();

        echo "<form id='editDepartmentForm' action='edit/Department_edit.php' method='GET'><table id='manager' style='margin: 0 auto;'>" .
            "<tr><th>Department Name</th><th>Department No.</th><th>Manager Name</th><th>Manager ID</th><th>Mgr Start Date</th><th>Action</th>";
        foreach ($datas as $data) {
            // output data of each row
            echo "<tr>";
            echo "<td>" . $data["Dname"] . "</td>" .
                "<td>" . $data["Dnumber"] . "</td>" .
                "<td>" . $this->getManagerName($data["Mgr_ssn"]) . "</td>" .
                "<td>" . $data["Mgr_ssn"] . "</td>" .
                "<td>" . $data["Mgr_start_date"] . "</td>" .
                "<td>
                    <button type='submit' form='editDepartmentForm' name='key' value=" . $data["Dnumber"] . ">Edit</button></form>
                </td>";
            echo "</tr>";
        }
        echo "</table>";
    }

    public function showAllDepartmentWithNoManager()
    {
        $datas = $this->getAllDepartmentWithNoManager();
        echo "<select name='department' id='department'>";
        foreach ($datas as $data)
            echo "<option value='" . $data['Dnumber'] . "'>" . $data["Dname"] . "</option>";
        echo "</select>";
    }

//    public function showEditableDepartmentFields($Dnumber)
//    {
//
//        $department = $this->getDepartment($Dnumber);
//
//        echo "<H4> You are editing Department: <input name='Dnumber'
////                                              readonly='readonly'
////                                              style='border: 0; background-color: white; font-weight: bold; margin-bottom: 0'
////                                              value='" . $department["Dnumber"] . "' /></H4>";
//
//        echo "test";
//
////        echo "<H4> You are editing Department: <input name='Dnumber'
////                                              readonly='readonly'
////                                              style='border: 0; background-color: white; font-weight: bold; margin-bottom: 0'
////                                              value='". $department["Dnumber"] ."' /></H4>
////
////            <Label>Department Name: <input type='text' name='edit_dname' value='". $department["Dname"] ."' required /></Label>
////            <Label>Department Location: <input type='text' name='edit_dlocation' value='". $this->getDepartmentLocation($Dnumber) . "' required /></Label>
////            <Label>Department Manager: <input type='text' readonly='readonly' name='edit_dmanager' value='". $this->getDepartmentManager() ."' required /></Label>";
//
//    }

    public function showAddDepartmentFields()
    {
        echo "<form id='addDepartmentForm' method='post'>
            <input type='text' name='Dname' placeholder='Department Name' required/>
            <input type='text' name='Dlocation' placeholder='Department Location' required/>
            <input type='number' maxlength='2' name='ManagerID' placeholder='ManagerID in Charge of Department' required/>
            </form>
         <button form='addDepartmentForm' name='submit' type='submit'>Submit</button>";

    }

}