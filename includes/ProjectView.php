<?php

class ProjectView extends Project
{

    public function showAllProjects()
    {
        $datas = $this->getAllProjects();

        echo "<form id='deleteProjectForm' action='Project.php' method='GET'></form>";
        echo "<form id='editProjectForm' action='Project_edit.php' method='GET'></form>
            <table id='project'>" .
            "<tr><th>Project Name</th><th>Project No.</th><th>Location</th><th>Department Name</th><th>Department No.</th>" .
            "<th>Action</th></tr>";
        foreach ($datas as $data) {
            // output data of each row
            echo "<tr>";
            echo "<td>" . $data["Pname"] . "</td>" .
                "<td>" . $data["Pnumber"] . "</td>" .
                "<td>" . $data["Plocation"] . "</td>" .
                "<td>" . $this->getDepartmentName($data["Dnum"]) . "</td>" .
                "<td>" . $data["Dnum"] . "</td>" .
                "<td>
                    <button type='submit' form='editProjectForm' name='key' value=" . $data["Pnumber"] . ">Edit</button>
                    <button type='submit' form='deleteProjectForm' name='delete' value=" . $data["Pnumber"] . ">Remove</button>
                </td>";
            echo "</tr>";
        }
        echo "</table>";

    }

    public function showAddProjectFields()
    {
        $department = new Department();
        $departments = $department->getAllDepartments();

        echo "<form id='addProjectForm' method='post'>
            <input type='text' name='Pname' placeholder='Project Name' required/>
            <input type='text' name='Plocation' placeholder='Project Location' required/><br/>
            <Lable>Department: <select style='margin: 4px auto' name='add_department'>";

        foreach ($departments as $dep)
            echo "<option value='" . $dep['Dnumber'] . "'>#" . $dep["Dnumber"] . " - " . $dep["Dname"] . "</option>";

        echo "</select></Lable><br/>";
        echo "</form><button form='addProjectForm' name='submit' type='submit'>Submit</button>";

    }

    public function showEditableProjectFields($pno)
    {

        $project = $this->getProject($pno);
        $locations = $this->getAllLocations();

//        echo "<form id='editDeptEmployees' action='Dept_Employees_edit.php' method='GET'></form>";
//        echo "<form id='editDeptLocations' action='Dept_Location_edit.php' method='GET'></form>";

        echo "<H4> You are editing Project: #" . $project["Pnumber"] . " " . $project["Pname"];

        //<span style='float: right;'>";
        //  <Label>Department Location: <input type='text' name='edit_dlocation' value='". $this->getDepartmentLocation($Dnumber) . "' required /></Label>
        //  <Label>Department Manager: <input type='text' readonly='readonly' name='edit_dmanager' value='". $this->getDepartmentManager() ."' required /></Label>";

        echo "<br/><br/><Label>Project Name: <input type='text' name='edit_dname' value='" . $project["Pname"] . "' required /></Label>";
        echo "<Lable>Location: <select style='margin: 4px auto' name='location' id='location'>";
        foreach ($locations as $location)
            echo "<option value='" . $location['Dlocation'] . "'>" . $location['Dlocation'] . "</option>";
        echo "</select></Lable><br>";

    }

}