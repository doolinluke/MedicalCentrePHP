<?php

class PatientTableGateway {

    private $connection;

    public function __construct($c) {
        $this->connection = $c;
    }

    public function getPatients($sortOrder, $filterName) {
        // execute a query to get all patients and sort by first name and to display the ward name instead of wardId by using a join where wardId in patients = wardId in ward
        $sqlQuery = "SELECT p.*, w.wardName AS wardName
                    FROM patient p
                    LEFT JOIN ward w ON w.wardID = p.wardID " .
                    (($filterName == NULL) ? "" : "WHERE p.fName LIKE :filterName") .
                    " ORDER BY " . $sortOrder;

        $statement = $this->connection->prepare($sqlQuery);
        if($filterName != NULL) {
            $params = array(
                "filterName" => "%" . $filterName . "%"
            );
            $status = $statement->execute($params);
        }
        else {
            $status = $statement->execute();
        }

        if (!$status) {
            die("Could not retrieve patients");
        }

        return $statement;
    }

    public function getPatientsByWardId($wardID) {
        // execute a query to get all users assigned to a specific ward by using a join where wardId in patients = wardId in ward
        $sqlQuery = "SELECT p.*, w.wardName AS wardName
                    FROM patient p 
                    LEFT JOIN ward w ON w.wardID = p.wardID
                    WHERE w.wardID = :wardID";

        $params = array(
            "wardID" => $wardID
        );
        $statement = $this->connection->prepare($sqlQuery);
        $status = $statement->execute($params);

        if (!$status) {
            die("Could not retrieve Ward");
        }

        return $statement;
    }

    public function getPatientById($patientID) {
        // execute a query to get the user with the specified id
        $sqlQuery = "SELECT * FROM patient WHERE patientID = :id";

        $statement = $this->connection->prepare($sqlQuery);
        $params = array(
            "id" => $patientID
        );

        $status = $statement->execute($params);

        if (!$status) {
            die("Could not retrieve user");
        }

        return $statement;
    }

    public function insertPatient($fN, $lN, $a, $pN, $e, $d, $dA, $wID) {
        $sqlQuery = "INSERT INTO patient " .
                "(fName, lName, address, phoneNumber, email, dob, dateAdmitted, wardID) " .
                "VALUES (:fName, :lName, :address, :phoneNumber, :email, :dob, :dateAdmitted, :wardID)";

        if ($wID == -1) {
            $wID = NULL;
        }

        $statement = $this->connection->prepare($sqlQuery);
        $params = array(
            "fName" => $fN,
            "lName" => $lN,
            "address" => $a,
            "phoneNumber" => $pN,
            "email" => $e,
            "dob" => $d,
            "dateAdmitted" => $dA,
            "wardID" => $wID
        );
        echo '<pre>';
        print_r($sqlQuery);
        print_r($params);
        print_r($_POST);
        echo '</pre>';

        $status = $statement->execute($params);

        if (!$status) {
            die("Could not create patient");
        }

        $id = $this->connection->lastInsertId();

        return $id;
    }

    public function deletePatient($id) {
        $sqlQuery = "DELETE FROM patient WHERE patientID = :patientID";

        $statement = $this->connection->prepare($sqlQuery);
        $params = array(
            "patientID" => $id
        );

        $status = $statement->execute($params);

        if (!$status) {
            die("Could not delete patient");
        }

        return ($statement->rowCount() == 1);
    }

    public function updatePatient($pID, $fN, $lN, $a, $pN, $e, $d, $dA, $wID) {
        $sqlQuery = "UPDATE patient SET " .
                "fName = :firstName, " .
                "lName = :lastName, " .
                "address = :address, " .
                "phoneNumber = :phoneNumber, " .
                "email = :email, " .
                "dob = :dateOfBirth, " .
                "dateAdmitted = :dateAdmitted, " .
                "wardID = :wardID " .
                "WHERE patientID = :patientID";

        echo '<pre>';
        print_r($sqlQuery);
        echo '</pre>';

        $statement = $this->connection->prepare($sqlQuery);
        $params = array(
            "patientID" => $pID,
            "firstName" => $fN,
            "lastName" => $lN,
            "address" => $a,
            "phoneNumber" => $pN,
            "email" => $e,
            "dateOfBirth" => $d,
            "dateAdmitted" => $dA,
            "wardID" => $wID
        );

        $status = $statement->execute($params);

        return ($statement->rowCount() == 1);
    }

}
