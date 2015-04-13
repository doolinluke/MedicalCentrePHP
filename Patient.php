<?php
/*Instances for Patient class*/
class Patient {
    private $patientID;
    private $fName;
    private $lName;
    private $address;
    private $phoneNumber;
    private $email;
    private $dob;
    private $dateAdmitted;
    private $wardID;
    
    /*Contructor for attributes of the Patient class*/
    public function __construct($pID, $fN, $lN, $a, $pN, $e, $d, $dA, $wID) {
        $this->patientID = $pID;
        $this->fName = $fN;
        $this->lName = $lN;
        $this->address = $a;
        $this->phoneNumber = $pN;
        $this->email = $e;
        $this->dob = $d;
        $this->dateAdmitted = $dA;
        $this->wardID = $wID;
    }
    
    /*Gets values entered in createPatient and returns them to the instances*/
    public function getPatientID() { return $this->patientID; }
    public function getFName() { return $this->fName; }
    public function getLName() { return $this->lName; }
    public function getAddress() { return $this->address; }
    public function getPhoneNumber() { return $this->phoneNumber; }
    public function getEmail() { return $this->email; }
    public function getDOB() { return $this->dob; }
    public function getDateAdmitted() { return $this->dateAdmitted; }
    public function getWardID() { return $this->wardID; }
}
