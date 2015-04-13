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

$id = filter_input(INPUT_POST, 'patientID', FILTER_SANITIZE_NUMBER_INT);
$fName = filter_input(INPUT_POST, 'fName', FILTER_SANITIZE_STRING);
$lName = filter_input(INPUT_POST, 'lName', FILTER_SANITIZE_STRING);
$address = filter_input(INPUT_POST, 'address', FILTER_SANITIZE_STRING);
$phoneNumber = filter_input(INPUT_POST, 'phoneNumber', FILTER_SANITIZE_NUMBER_INT);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$emailValid = filter_var($email, FILTER_VALIDATE_EMAIL);
$dob = filter_input(INPUT_POST, 'dob', FILTER_SANITIZE_STRING);
$dateAdmitted = filter_input(INPUT_POST, 'dateAdmitted', FILTER_SANITIZE_STRING);
$wardID = filter_input(INPUT_POST, 'wardID', FILTER_SANITIZE_NUMBER_INT);

$gateway->updatePatient($id, $fName, $lName, $address, $phoneNumber, $email, $dob, $dateAdmitted, $wardID);

header('Location: home.php');

