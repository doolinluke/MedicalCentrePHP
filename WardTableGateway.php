<?php

class WardTableGateway {

    private $connection;

    public function __construct($c) {
        $this->connection = $c;
    }

    public function getWards() {
        // execute a query to get all managers
        $sqlQuery = "SELECT * FROM ward";

        $statement = $this->connection->prepare($sqlQuery);
        $status = $statement->execute();

        if (!$status) {
            die("Could not retrieve wards");
        }

        return $statement;
    }
    
    /*public function getWards($sortOrder) {
        // execute a query to get all patients
        $sqlQuery = "SELECT p.*, w.wardName AS wardName
                    FROM patient p
                    LEFT JOIN ward w ON w.wardID = p.wardID
                    ORDER BY " . $sortOrder;

        $statement = $this->connection->prepare($sqlQuery);
        
        $status = $statement->execute($params);

        if (!$status) {
            die("Could not retrieve patients");
        }

        return $statement;
    }*/

    public function getWardById($wardID) {
        // execute a query to get the manager with the specified id
        $sqlQuery = "SELECT * FROM ward WHERE wardID = :wardID";

        $statement = $this->connection->prepare($sqlQuery);
        $params = array(
            "wardID" => $wardID
        );

        $status = $statement->execute($params);

        if (!$status) {
            die("Could not retrieve ward");
        }

        return $statement;
    }

    public function insertWard($n, $nb, $hn) {
        // execute a query to insert values into the ward table
        $sqlQuery = "INSERT INTO ward " .
                "(wardName, numberBeds, headNurse) " .
                "VALUES (:wardName, :numberBeds, :headNurse)";

        $statement = $this->connection->prepare($sqlQuery);
        $params = array(
            "wardName" => $n,
            "numberBeds" => $nb,
            "headNurse" => $hn
        );

        $status = $statement->execute($params);

        if (!$status) {
            die("Could not insert ward");
        }

        $id = $this->connection->lastInsertId();

        return $id;
    }

    public function deleteWard($wardID) {
        // execute a query to delete row from ward where wardId = value entered
        $sqlQuery = "DELETE FROM ward WHERE wardID = :wardID";

        $statement = $this->connection->prepare($sqlQuery);
        $params = array(
            "wardID" => $wardID
        );

        $status = $statement->execute($params);

        if (!$status) {
            die("Could not delete ward");
        }

        return ($statement->rowCount() == 1);
    }

    public function updateWard($wardID, $n, $nb, $hn) {
        // execute a query to update ward
        $sqlQuery = "UPDATE ward SET " .
                "wardName = :wardName, " .
                "numberBeds = :numberBeds, " .
                "headNurse = :headNurse " .
                "WHERE wardID = :wardID";

        $statement = $this->connection->prepare($sqlQuery);
        $params = array(
            "wardID" => $wardID,
            "wardName" => $n,
            "numberBeds" => $nb,
            "headNurse" => $hn
        );

        $status = $statement->execute($params);
        
        if (!$status) {
            die("Could not update ward");
        }

        return ($statement->rowCount() == 1);
    }

}
