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
        $locations = $this->getAllLocations();

        echo "<form id='addProjectForm' method='post'>
            <input type='text' name='Pname' placeholder='Project Name' required/>";

        echo "<br/><Lable>Location: <select style='margin: 4px auto' name='Plocation' id='location'>";
        foreach ($locations as $location)
            echo "<option value='" . $location['Dlocation'] . "'>" . $location['Dlocation'] . "</option>";
        echo "</select></Lable><br>";

            echo "<Lable>Department: <select style='margin: 4px auto' name='add_department'>";

        foreach ($departments as $dep)
            echo "<option value='" . $dep['Dnumber'] . "'>#" . $dep["Dnumber"] . " - " . $dep["Dname"] . "</option>";

        echo "</select></Lable><br/>";
        echo "</form><button form='addProjectForm' name='submit' type='submit'>Submit</button>";

    }

    public function showEditableProjectFields($pno)
    {
        $department = new Department();
        $departments = $department->getAllDepartments();

        $project = $this->getProject($pno);
        $locations = $this->getAllLocations();

        echo "<H4> You are editing Project: #". $project["Pnumber"] . " " . $project["Pname"]
            . "<span style='float: right;'>
                <form id='editProjectEmployeesForm' action='Project_Employees_Edit.php' method='GET'></form>
                <form id='editProjectEmployeesForm' action='Project_Employees_Edit.php' method='GET'></form>  
                    <button form='editProjectEmployeesForm' name='edit_ProjectEmployeesForm' type='submit' value=$pno >Project Employees</button>    
            </span></H4>";

        echo "<form id='editProjectForm' method='POST'>";

        //
        echo "<Label>Project Name: <input type='text' name='edit_Pname' value='" . $project["Pname"] . "' required /></Label>";

        echo "<Lable>Location: <select style='margin: 4px auto' name='edit_Plocation' id='location'>";
        foreach ($locations as $location)
            echo "<option value='" . $location['Dlocation'] . "'>" . $location['Dlocation'] . "</option>";
        echo "</select></Lable><br>";

        echo "<Lable>Department: <select style='margin: 4px auto' name='edit_department'>";
        foreach ($departments as $dep)
            echo "<option value='" . $dep['Dnumber'] . "'>#" . $dep["Dnumber"] . " - " . $dep["Dname"] . "</option>";
        echo "</select></Lable><br/>";
        //

        echo "</form>
                <button form='editProjectForm' name='key' type='submit'>Submit</button>
                <button type='button' onclick='document.location.href=\"Project.php\"'>Cancel</button>";




    }

    public function showEmployeesNotWorkingOnProject($pno){

        $datas = $this->getEmployeesNotWorkingOnProject($pno);

        echo "<h3>Employees Not Working On This Project</h3><form id='addToProject' method='POST'></form>";
        echo "<table style='margin: 0 auto;'>" .
            "<tr><th>Employee Name</th><th>Employee SSN</th><th>Action</th>";
        foreach ($datas as $data) {
            // output data of each row
            echo "<tr>";
            echo "<td>" . $data["Fname"] . " " . $data["Minit"] . " " . $data["Lname"] ."</td>" .
                "<td>" . $data["Ssn"] . "</td>" .
                "<td>
                    <button type='submit' form='addToProject' name='add_ToProject' value=" . $data["Ssn"] . "-" . $pno . ">Add</button>
                </td>";
            echo "</tr>";
        }
        echo "</table>";

    }

    public function showEmployeesWorkingOnProject($pno){

        $datas = $this->getEmployeesWorkingOnProject($pno);

        echo "<h3>Employees Working On This Project</h3><form id='removeFromProject'' method='POST'></form>";
        echo "<table style='margin: 0 auto;'>" .
            "<tr><th>Employee Name</th><th>Employee SSN</th><th>Action</th>";
        foreach ($datas as $data) {
            // output data of each row
            echo "<tr>";
            echo "<td>" . $data["Fname"] . " " . $data["Minit"] . " " . $data["Lname"] ."</td>" .
                "<td>" . $data["Ssn"] . "</td>" .
                "<td>
                    <button type='submit' form='removeFromProject' name='remove_FromProject' value=" . $data["Ssn"] . "-" . $pno . ">Remove</button>
                </td>";
            echo "</tr>";
        }
        echo "</table>";
    }

}