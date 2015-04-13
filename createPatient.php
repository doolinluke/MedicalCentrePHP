<?php

require_once 'Patient.php';
require_once 'Connection.php';
require_once 'PatientTableGateway.php';

$id = session_id();
if ($id == "") {
    session_start();
}

require 'ensureUserLoggedIn.php';

$connection = Connection::getInstance();
$gateway = new PatientTableGateway($connection);

//Validates form data, removes harmful input
$patientID = filter_input(INPUT_POST, 'patientID', FILTER_SANITIZE_NUMBER_INT);
$fName = filter_input(INPUT_POST, 'fName', FILTER_SANITIZE_STRING);
$lName = filter_input(INPUT_POST, 'lName', FILTER_SANITIZE_STRING);
$address = filter_input(INPUT_POST, 'address', FILTER_SANITIZE_STRING);
$phoneNumber = filter_input(INPUT_POST, 'phoneNumber', FILTER_SANITIZE_NUMBER_INT);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$emailValid = filter_var($email, FILTER_VALIDATE_EMAIL);
$dob = filter_input(INPUT_POST, 'dob', FILTER_SANITIZE_STRING);
$dateAdmitted = filter_input(INPUT_POST, 'dateAdmitted', FILTER_SANITIZE_STRING);
$wardID = filter_input(INPUT_POST, 'wardID', FILTER_SANITIZE_NUMBER_INT);
if ($wardID == -1) {
    $wardID = NULL;
}

//if statements to validate form, works with createEvent.php
$errorMessage = array();
if ($fName === FALSE || $fName === '') {
    $errorMessage['fName'] = 'First Name must not be blank<br/>';
}

if ($lName === FALSE || $lName === '') {
    $errorMessage['lName'] = 'Second Name must not be blank<br/>';
}

if ($address === FALSE || $address === '') {
    $errorMessage['address'] = 'Address must not be blank<br/>';
}

if ($phoneNumber === FALSE || $phoneNumber === '') {
    $errorMessage['phoneNumber'] = 'Phone Number must not be blank<br/>';
}

if ($email === FALSE || $email === '') {
    $errorMessage['email'] = 'Email must not be blank<br/>';
}

if ($dob === FALSE || $dob === '') {
    $errorMessage['dob'] = 'Date of birth must not be blank<br/>';
}

if ($dateAdmitted === FALSE || $dateAdmitted === '') {
    $errorMessage['dateAdmitted'] = 'Date Admitted must not be blank<br/>';
}

if ($wardID === FALSE || $wardID === '') {
    $errorMessage['wardID'] = 'Ward ID must not be blank<br/>';
}

//uses gateway to call insertPatient method and passes in variables
$patientID = $gateway->insertPatient($fName, $lName, $address, $phoneNumber, $email, $dob, $dateAdmitted, $wardID);
$message = "New Patient Created";
header("Location: home.php");






