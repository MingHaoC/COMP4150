<?php

class DependentView extends Dependent
{
    public function showAllDependents(){
        $datas = $this->getAllDependents();

        echo "<form id='editDepartmentForm' action='edit/Dependent_edit.php' method='GET'><table id='manager' style='margin: 0 auto;'>".
            "<tr><th>DependentID</th><th>Dependent Name</th><th>Sex</th><th>Bdate</th><th>Relationship</th><th>Dependee</th>".
            "<th>Action</th></tr>";
        foreach ($datas as $data) {
            // output data of each row
            echo "<tr>";
            echo "<td>" . $data["DependentID"] . "</td>".
                "<td>" . $data["Dependent_name"] . "</td>".
                "<td>" . $data["Sex"] . "</td>".
                "<td>" . $data["Bdate"] . "</td>".
                "<td>" . $data["Relationship"] . "</td>".
                "<td>" . $this->getDependee($data["DependentID"]) . "</td>".

                "<td>
                    <button type='submit' form='editDepartmentForm' name='key' value=" . $data["Dnumber"] . ">Edit</button></form>
                </td>";
            echo "</tr>";
        }
        echo "</table>";
    }


}