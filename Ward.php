<?php
/*Instances for Ward class*/
class Ward {
    private $wardID;
    private $wardName;
    private $numberBeds;
    private $headNurse;

    
    /*Contructor for attributes of the Ward class*/
    public function __construct($wID, $wN, $nB, $hN) {
        $this->wardID = $wID;
        $this->wardName = $wN;
        $this->$numberBeds = $nB;
        $this->$headNurse = $hN;
    }
    
    /*Gets values entered in createWard and returns them to the instances*/
    //public function getWardID() { return $this->wardID; }
    public function getWardName() { return $this->wardName; }
    public function getNumberBeds() { return $this->numberBeds; }
    public function getHeadNurse() { return $this->headNurse; }
}
