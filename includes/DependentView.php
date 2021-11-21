<?php

class DependentView extends Dependent
{

    public function showAllDependents()
    {
        $datas = $this->getAllDependents();


        echo "<form id='editDependentForm' action='Dependent_edit.php' method='GET'>" .
            "<table id='dependent' style='margin: 0 auto;'>" .

            "<tr><th>DependentID</th><th>Dependent Name</th><th>Sex</th><th>Bdate</th><th>Relationship</th><th>Dependee</th>" .
            "<th>Action</th></tr>";
        foreach ($datas as $data) {
            // output data of each row
            echo "<tr>";
            echo "<td>" . $data["DependentID"] . "</td>" .
                "<td>" . $data["Dependent_name"] . "</td>" .
                "<td>" . $data["Sex"] . "</td>" .
                "<td>" . $data["Bdate"] . "</td>" .
                "<td>" . $data["Relationship"] . "</td>" .
                "<td>" . $this->getDependee($data["DependentID"]) . "</td>" .

                "<td>
                    <button type='submit' form='editDependentForm' name='key' value=" . $data["DependentID"] . ">Edit</button></form>
                </td>";
            echo "</tr>";
        }
        echo "</table>";
    }

    public function getUserDependent($ssn)
    {
        $datas = $this->getUserDependents($ssn);

        echo "<form id='DeleteDependentForm' method='POST'>";
        echo "<table id='manager' style='margin: 0 auto;'><tr><th>Dependent Name</th><th>Sex</th><th>Birthday</th><th>Relationship</th><th>Action</th></tr>";
        foreach ($datas as $data) {
            // output data of each row
            echo "<tr>";
            echo
                "<td>" . $data["Dependent_name"] . "</td>" .
                "<td>" . $data["Sex"] . "</td>" .
                "<td>" . $data["Bdate"] . "</td>" .
                "<td>" . $data["Relationship"] . "</td>" .
                "<td>
                    <button type='submit' form='DeleteDependentForm' name='DeleteDependent' value=" . $data["Dependent_id"] . ">Delete</button>
                </td>";
        }
        echo "</tr></table></form > ";
    }

    public function showAddDependent()
    {
        echo "<form id='addDependentForm' method='POST'>
            <input type='text' name='Dependent_name' placeholder='Name' required/>
                <select name='Sex' required style='width: 76%'>
                    <option value='M'>Male</option>
                    <option value='F'>Female</option>
                </select>
            <input type='date' name='Bdate' placeholder='Birthdate' required/>
            <input type='text' name='Relationship' placeholder='Relationship' required/>
            </form>
            <button form='addDependentForm' name='AddDependent' type='submit' value='set'>Submit</button>";

    }

    public function addDependent($ssn, $dependentName, $sex, $birthday, $relationship)
    {
        if ($this->executeAddDependent($ssn, $dependentName, $sex, $birthday, $relationship)) {
            echo '<script type="text/javascript">';
            echo "alert('A new dependent was added for $ssn');";
            echo "window.location.href = 'Dependent.php?submit=$ssn'";
            echo '</script>';
        } else {
            echo "<h3>Failed to add a new dependent</h3>";
        }
    }

    public function deleteDependent($ssn, $dependent_id)
    {
        if ($this->executeDeleteDependent($dependent_id)) {
            echo '<script type="text/javascript">';
            echo "alert('The dependent was successfully deleted');";
            echo "window.location.href = 'Dependent.php?submit=$ssn'";
            echo '</script>';
        } else {
            echo "<h3>Failed to delete the dependent</h3>";
        }
    }

}