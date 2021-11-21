<?php

class Dependent extends DBConnection
{
    protected function getUserDependents($ssn)
    {
        $sql = "SELECT * FROM UW_DEPENDENT WHERE Ssn = $ssn";
        return $this->getStarQuery($sql);
    }

    protected function executeAddDependent($ssn, $dependentName, $sex, $birthday, $relationship): bool
    {
        $sql = "INSERT INTO UW_DEPENDENT (Dependent_name, Sex, Bdate, Relationship, Ssn) VALUES (?, ?, ?, ?, ?)";

        $db = $this->connect();
        if (!($stmt = $db->prepare($sql)))
            echo "Prepare failed: ";
        if (!($stmt->bind_param("sssss", $dependentName, $sex, $birthday, $relationship, $ssn)))
            echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
        if (!$stmt->execute()) {
            echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            return false;
        }
        $stmt->close();
        $db->close();
        return true;
    }

    protected function executeDeleteDependent($dependent_id): bool
    {
        $sql = "Delete FROM UW_DEPENDENT WHERE Dependent_id = ?";
        $db = $this->connect();
        if (!($stmt = $db->prepare($sql)))
            echo "Prepare failed: ";
        if (!($stmt->bind_param("i", $dependent_id)))
            echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
        if (!$stmt->execute()) {
            echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            return false;
        }
        $stmt->close();
        $db->close();

        return true;
    }

}