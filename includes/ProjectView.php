<?php

class ProjectView extends Project
{

    public function showAllProjects(){
        $datas = $this->getAllProjects();

        echo "<form id='editProjectForm' action='edit/Project_edit.php' method='GET'>
            <table id='project' style='margin: 0 auto;'>".
            "<tr><th>Project Name</th><th>Project No.</th><th>Location</th><th>Department Name</th><th>Department No.</th>".
            "<th>Action</th></tr>";
        foreach ($datas as $data) {
            // output data of each row

            echo "<tr>";
            echo "<td>" .$data["Pname"] . "</td>".
                "<td>" . $data["Pnumber"]. "</td>".
                "<td>" . $data["Plocation"] . "</td>".
                "<td>" . $this->getDepartmentName($data["Dnum"]) . "</td>".
                "<td>" . $data["Dnum"]. "</td>".
                "<td>
                    <button type='submit' form='editProjectForm' name='key' value=" . $data["Pnumber"] . ">Edit</button></form>
                </td>";
            echo "</tr>";
        }
        echo "</table>";

    }

    public function showAddProjectFields()
    {
        echo "<form id='addProjectForm' method='post'>
            <input type='text' name='Pname' placeholder='Project Name' required/>
            <input type='text' name='Plocation' placeholder='Project Location' required/>
            <input type='number' maxlength='2' name='Dnum' placeholder='Assigned Department' required/>
            </form>
         <button form='addProjectForm' name='submit' type='submit'>Submit</button>";

    }

}