<?php

class DepartmentView extends Department
{

    public function showAllDepartments()
    {
        $datas = $this->getAllDepartments();

        echo "<form id='deleteDepartmentForm' action='Department.php' method='GET'></form>";
        echo "<form id='editDepartmentForm' action='Department_edit.php' method='GET'></form>";
        echo "<table id='department' style='margin: 0 auto;'>" .
            "<tr><th>Department Name</th><th>Department No.</th><th>Manager Name</th><th>Manager ID</th><th>Mgr Start Date</th>".
            "<th>Action</th></tr>";

        foreach ($datas as $data) {
            // output data of each row
            echo "<tr>";
            echo "<td>" . $data["Dname"] . "</td>" .
                "<td>" . $data["Dnumber"] . "</td>" .
                "<td>" . $this->getManagerName($data["Mgr_ssn"]) . "</td>" .
                "<td>" . $data["Mgr_ssn"] . "</td>" .
                "<td>" . $data["Mgr_start_date"] . "</td>" .
                "<td>
                    <button type='submit' form='editDepartmentForm' name='key' value=" . $data["Dnumber"] . ">Edit</button>
                    <button type='submit' form='deleteDepartmentForm' name='delete' value=" . $data["Dnumber"] . ">Remove</button>
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

    public function showEditableDepartmentFields($Dnumber)
    {

        $department = $this->getDepartment($Dnumber);

        echo "<form id='editDeptEmployees' action='Dept_Employees_edit.php' method='GET'></form>";
        echo "<form id='editDeptLocations' action='Dept_Location_edit.php' method='GET'></form>";

        echo "<H4> You are editing Department: #". $department["Dnumber"] . " " . $department["Dname"]
            . "<span style='float: right;'>
                <button type='submit' name='edit_deptEmployees' value=$Dnumber form='editDeptEmployees'>Dept_Employees</button>
                <button type='submit' name='edit_deptLocations' value=$Dnumber form='editDeptLocations'>Dept_Locations</button>
            </span>";

        //  <Label>Department Location: <input type='text' name='edit_dlocation' value='". $this->getDepartmentLocation($Dnumber) . "' required /></Label>
        //  <Label>Department Manager: <input type='text' readonly='readonly' name='edit_dmanager' value='". $this->getDepartmentManager() ."' required /></Label>";
        echo "<br/><br/><Label>Department Name: <input type='text' name='edit_dname' value='". $department["Dname"] ."' required /></Label>";


    }

    public function showAddDepartmentFields()
    {
        echo "<form id='addDepartmentForm' method='post'>
                <input type='text' name='Dname' placeholder='Department Name' required/>
                <input type='text' name='Dlocation' placeholder='Department Location'/>
            </form>
            <button style='margin: 1rem auto;' form='addDepartmentForm' name='submit' type='submit'>Submit</button>";
    }



    public function showAllDepartmentLocations(){

        $datas = $this->getAllDepartmentLocations();

        echo "<table id='department' style='margin: 0 auto;'>" .
            "<tr><th>Department No.</th><th>Location</th></tr>";
        foreach ($datas as $data) {
            // output data of each row
            echo "<tr>".
                "<td>" . $data["Dnumber"] . "</td>" .
                "<td>" . $data["Dlocation"] . "</td>";
            echo "</tr>";
        }
        echo "</table>";

    }

    /**
     * PLAN
    show table on left with employees that belong
    show table on rigth with employees that do NOT belong
    have add/remove buttons in the tables
     */
    public function showDepartmentEmployees($dno){

        $datas = $this->getDepartmentEmployees($dno);

        echo "<table id='department' style='margin: 0 auto;'>" .
            "<tr><th>Department No.</th><th>Location</th></tr>
             <th>Action</th>";
        foreach ($datas as $data) {
            // output data of each row
            echo "<tr>";

            echo "</tr>";
        }
        echo "</table>";

    }



    /**
     * PLAN
    show table of locations
    have field to add new location
    have button in table to remove location
     */
    public function showDepartmentLocations($dno){

        $datas = $this->getDepartmentLocations($dno);

        echo "<form id='deleteLocationForm' method='POST'></form>";

        echo "<table id='department' style='margin: 0 auto;'>" .
            "<tr><th>Department No.</th><th>Location</th>
             <th>Action</th></tr>";
        foreach ($datas as $data) {
            // output data of each row
            echo "<tr>".
                "<td>" . $data["Dnumber"] . "</td>" .
                "<td>" . $data["Dlocation"] . "</td>".
                "<td> 
                     <button type='submit' form='deleteLocationForm' name='delete' value=" . $data["Dnumber"] . "-" . $data["Dlocation"]  . ">Remove</button>
                </td>";
            echo "</tr>";
        }
        echo "</table>";

    }

    /**
     *
     */
    public function showAddLocation(){

        echo "<form id='addLocationToDepartmentForm' method='post'>
                    <input style='width: 60%;' type='text' name='Dlocation' placeholder='Department Location' required/>
                    </form>
                    <button form='addLocationToDepartmentForm' name='addLocation' type='submit'>Submit</button>";

    }





}