<?php
require './includes/Department.php';
require './includes/Manager.php';
require './includes/Project.php';

class EmployeeView extends Employee
{

    public function ShowAllEmployee()
    {
        $datas = $this->getAllEmployees();

        echo "<form id='promoteUserForm' action='PromoteEmployee.php' method='GET'></form>";
        echo "<form id='deleteUserForm' method='POST'></form>";
        echo "<form id='editManagerForm' action='Employee_edit.php' method='GET'>";
        echo "<table id='manager' style='margin: 0 auto;'><tr><th>FName</th><th>M.Init</th><th>LName</th><th>SSN</th>
              <th>Bdate</th><th>Address</th><th>Sex</th><th>Salary</th><th>Manager</th><th>Action</th></tr>";

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
                    <button type='submit' form='deleteUserForm' name='delete' value=" . $data["Ssn"] . " style='background-color: lightcoral'>Delete</button>
                    </form>
                </td>";
            echo "</tr>";
        }
        echo "</table> </form>";
    }

    public function showAddEmployee()
    {
        // get all department
        $department = new Department();
        $departments = $department->getAllDepartments();

        // get all manager
        $manager = new Manager();
        $managers = $manager->getAllManager();

        // get all project
        $project = new Project();
        $projects = $project->getAllProjects();

        echo "<form id='addDepartmentForm' method='POST'>
            <input type='text' name='Fname' placeholder='First name' required/>
            <input type='text' name='Minit' placeholder='Middle initials' required/>
            <input type='text' name='Lname' placeholder='Last Name' required/>
            <input type='text' name='SSN' placeholder='SSN' required/>
            <input type='text' name='Password' placeholder='Password' required/>
            <input type='text' name='Bdate' placeholder='Birthday' required/>
            <input type='text' name='Address' placeholder='Address' required/>
            <input type='text' name='Sex' placeholder='Sex' required/>
            <input type='text' name='Salary' placeholder='Salary' required/><br>";
        echo "<Lable>Supervisor <select style='margin: 4px auto' name='Super_ssn' id='Super_ssn'>";
        foreach ($managers as $mgr)
            echo "<option value='" . $mgr['Ssn'] . "'>" . $mgr["Fname"] . " " . $mgr["Lname"] . "</option>";
        echo "</select></Lable><br>";
        echo "<Lable>Department <select style='margin: 4px auto' name='Department' id='Department'>";
        foreach ($departments as $dep)
            echo "<option value='" . $dep['Dnumber'] . "'>" . $dep["Dname"] . "</option>";
        echo "</select></Lable><br>";
        echo "<Lable>Project <select style='margin: 4px auto' name='Pno' id='Pno'>";
        foreach ($projects as $proj)
            echo "<option value='" . $proj['Pnumber'] . "'>" . $proj["Pname"] . "</option>";
        echo "</select></Lable>";
        echo "</form>
              <button form='addDepartmentForm' name='submit' type='submit'>Submit</button>";
    }

    public function addEmployee($fname, $minit, $lname, $ssn, $password, $bdate, $address, $sex, $salary, $super_ssn, $department, $pno)
    {
        if(!$this->executeAddEmployee($fname, $minit, $lname, $ssn, $password, $bdate, $address, $sex, $salary, $super_ssn)) {
            echo "<h3>Failed to add a new employee</h3>";
            return;
        }

        if(!$this->assignDepartmentToEmployee($ssn, $department)) {
            echo "<h3>Employee was added successfully, but no department and project has been assigned as an error has occurred</h3>";
            return;
        }

        if(!$this->assignProjectToEmployee($ssn, $pno)) {
            echo "<h3>Employee was added successfully and was assigned a department, but no project has been assigned as an error has occurred</h3>";
            return;
        }

        echo '<script type="text/javascript">';
        echo "alert('A new Employee was added successfully');";
        echo 'window.location.href = "Employee.php";';
        echo '</script>';
    }

    public function deleteEmployee($ssn)
    {
        if ($this->executeDeleteEmployee($ssn)) {
            echo '<script type="text/javascript">';
            echo "alert('Employee with $ssn has been successfully deleted');";
            echo 'window.location.href = "Employee.php";';
            echo '</script>';
        } else
            echo "<h3>Failed to delete employee with ssn: $ssn</h3>";
    }

    public function showEditableEmployeeFields($ssn)
    {
        $data = $this->getEmployee($ssn);
        $managers = $this->getAllManager();
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
        echo "<Lable>Super_ssn: <select name='edit_super_ssn' id='department'>";
        foreach ($managers as $manager)
            if ($data['super_ssn'] == $manager["Mgr_ssn"])
                echo "<option selected='selected' value='" . $manager['Mgr_ssn'] . "'>" . $manager["Name"] . "</option>";
            else
                echo "<option value='" . $manager['Mgr_ssn'] . "'>" . $manager["Name"] . "</option>";
        echo "</select></Lable>";
    }

}