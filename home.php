<?php
require_once 'Patient.php';
require_once 'Connection.php';
require_once 'PatientTableGateway.php';

require 'ensureUserLoggedIn.php';

$connection = Connection::getInstance();
$gateway = new PatientTableGateway($connection);

$statement = $gateway->getPatients();

$id = session_id();
/* checking if there is not already a session and if there is start it */
if ($id == "") {
    session_start();
}
//if events session is set add it to the array
if (!isset($_SESSION['events'])) {
    $events = array();
    //hard coding variables into the array through parameters in another page

    $_SESSION['events'] = $events;
} else {
    //making this session events
    $events = $_SESSION['events'];
}
?>
<!DOCTYPE html>
<html>
    <head>
        <link href='http://fonts.googleapis.com/css?family=Josefin+Sans:400,600,400italic' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" type="text/css" href=CSS/style.css>
        <meta charset="UTF-8">
        <script type="text/javascript" src="Javascript/patient.js"></script>
        <title>Medical Centre</title>
    </head>
    <body>
        <div id="body">
        <?php require 'toolbar.php' ?>
        <div id = "header">
            <h1>Home</h1>
            <!--  Calls in the session $username the prints it out -->
            <?php
            $username = $_SESSION['username'];
            echo '<h3>Welcome: ' . $username . '</h3>';
            ?>
        </div>
        <?php 
        if (isset($message)) {
            echo '<p>'.$message.'</p>';
        }
        ?>
        <div id ="table">
            <table border="1">
                <style>border-collapse</style>
            <thead>
                <tr>
                    <th>Patient ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Address</th>
                    <th>Phone Number</th>
                    <th>Email</th>
                    <th>Date of Birth</th>
                    <th>Date Admitted</th>
                    <th>Ward ID</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $row = $statement->fetch(PDO::FETCH_ASSOC);
                while ($row) {
                    
                    echo '<tr>';
                    echo '<td>' . $row['patientID'] . '</td>';
                    echo '<td>' . $row['fName'] . '</td>';
                    echo '<td>' . $row['lName'] . '</td>';
                    echo '<td>' . $row['address'] . '</td>';
                    echo '<td>' . $row['phoneNumber'] . '</td>';
                    echo '<td>' . $row['email'] . '</td>';
                    echo '<td>' . $row['dob'] . '</td>';
                    echo '<td>' . $row['dateAdmitted'] . '</td>';
                    echo '<td>' . $row['wardID'] . '</td>';
                    echo '<td>'
                    . '<a href="viewPatient.php?id='.$row['patientID'].'">View</a> '
                    . '<a href="editPatientForm.php?id='.$row['patientID'].'">Edit</a> '
                    . '<a class="deletePatient" <a href="deletePatient.php?id='.$row['patientID'].'">Delete</a> '
                    . '</td>';
                    echo '</tr>';
                    
                    $row = $statement->fetch(PDO::FETCH_ASSOC);
                }
                ?>
            </tbody>
            </table>
        </div>
            <p><a href="createPatientForm.php">Create Patient</a></p>        
        </div>
    </body>
</html>
