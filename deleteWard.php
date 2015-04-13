<?php

require_once 'Ward.php';
require_once 'Connection.php';
require_once 'WardTableGateway.php';

$id = session_id();
if ($id == "") {
    session_start();
}

require 'ensureUserLoggedIn.php';

if (!isset($_GET) || !isset($_GET['id'])) {
    die('Invalid request');
}
$id = $_GET['id'];

$connection = Connection::getInstance();
//gateway calls deleteWard method from WardTableGateway
$gateway = new WardTableGateway($connection);

$gateway->deleteWard($id);

header("Location: viewWards.php");
?>
