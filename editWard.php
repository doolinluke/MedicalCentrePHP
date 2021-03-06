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

$wardID = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
$wardName = filter_input(INPUT_POST, 'wardName', FILTER_SANITIZE_STRING);
$numberBeds = filter_input(INPUT_POST, 'numberBeds', FILTER_SANITIZE_STRING);
$headNurse = filter_input(INPUT_POST, 'headNurse', FILTER_SANITIZE_STRING);
if($wardID === -1) {
    $wardID = NULL;
}

$gateway->updateWard($wardID, $wardName, $numberBeds, $headNurse);

header('Location: viewWards.php');

