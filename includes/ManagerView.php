<?php

class ManagerView extends Manager
{
    public function showAllManagers()
    {
        $datas = $this->getAllManager();
        echo "<form id='demoteUserForm' method='POST'></form>";
        echo "<form id='editManagerForm' action='edit/Manager_edit.php' method='GET'><table id='manager' style='margin: 0 auto;'><tr><th>FName</th><th>M.Init</th><th>LName</th><th>SSN</th><th>Bdate</th><th>Address</th><th>Sex</th><th>Salary</th><th>Action</th></tr>";
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
                "<td>
                    <button type='submit' form='editManagerForm' name='key' value=" . $data["Ssn"] . ">Edit</button>
                     <button type='submit' form='demoteUserForm' name='demote' value=" . $data["Ssn"] . " style='background-color: red'>Demote</button>
                    </form>
                </td>";
            echo "</tr>";
        }
        echo "</table> </form>";
    }

    public function demoteManager($ssn) {

    }


}