<?php

require_once 'Ward.php';
require_once 'Connection.php';
require_once 'WardTableGateway.php';

$id = session_id();
if ($id == "") {
    session_start();
}

require 'ensureUserLoggedIn.php';

$connection = Connection::getInstance();
$gateway = new WardTableGateway($connection);

//Validates form data, removes harmful input
$wardID = filter_input(INPUT_POST, 'wardID', FILTER_SANITIZE_NUMBER_INT);
$wardName = filter_input(INPUT_POST, 'wardName', FILTER_SANITIZE_STRING);
$numberBeds = filter_input(INPUT_POST, 'numberBeds', FILTER_SANITIZE_STRING);
$headNurse = filter_input(INPUT_POST, 'headNurse', FILTER_SANITIZE_STRING);
if ($wardID == -1) {
    $wardID = NULL;
}

//if statements to validate form, works with createWard.php
$errorMessage = array();
if ($wardName === FALSE || $fName === '') {
    $errorMessage['wardNameError'] = 'Ward Name must not be blank<br/>';
}

if ($numberBeds === FALSE || $lName === '') {
    $errorMessage['numberBedsError'] = 'Number of Beds must not be blank<br/>';
}

if ($headNurse === FALSE || $address === '') {
    $errorMessage['headNurseError'] = 'Head Nurse must not be blank<br/>';
}

$wardID = $gateway->insertWard($wardName, $numberBeds, $headNurse);
$message = "New Ward Created";
header("Location: viewWards.php");






