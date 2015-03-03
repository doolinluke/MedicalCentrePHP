 <?php
require_once 'Patient.php';
require_once 'Connection.php';
require_once 'PatientTableGateway.php';

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
$gateway = new PatientTableGateway($connection);

$statement = $gateway->getPatientById($id);
?>
<!DOCTYPE html>
<html>
    <head>
        <link href='http://fonts.googleapis.com/css?family=Josefin+Sans:400,600,400italic' rel='stylesheet' type='text/css'>
        <meta charset="UTF-8">
        <script type="text/javascript" src="Javascript/patient.js"></script>
        <title></title>
        <link rel="stylesheet" type="text/css" href=CSS/style.css>
    </head>
    <body>
        <div id="body">
        <?php require 'toolbar.php' ?>
        <?php 
        if (isset($message)) {
            echo '<p>'.$message.'</p>';
        }
        ?>
        <table id="table" border="1">
            <tbody>
                <a href="home.php">Home </a>
                    <?php
                    $row = $statement->fetch(PDO::FETCH_ASSOC);
                        echo '<tr>';
                        echo '<th>Patient ID</th>'
                        . '<td>' . $row['patientID'] . '</td>';
                        echo '</tr>';
                        echo '<tr>';
                        echo '<th>First Name</th>'
                        . '<td>' . $row['fName'] . '</td>';
                        echo '</tr>';
                        echo '<tr>';
                        echo '<th>Last Name</th>'
                        . '<td>' . $row['lName'] . '</td>';
                        echo '</tr>';
                        echo '<tr>';
                        echo '<th>Address</th>'
                        . '<td>' . $row['address'] . '</td>';
                        echo '</tr>';
                        echo '<tr>';
                        echo '<th>Phone Number</th>'
                        . '<td>' . $row['phoneNumber'] . '</td>';
                        echo '</tr>';
                        echo '<tr>';
                        echo '<th>Email</th>'
                        . '<td>' . $row['email'] . '</td>';
                        echo '</tr>';
                        echo '<tr>';
                        echo '<th>Date of Birth</th>'
                        . '<td>' . $row['dob'] . '</td>';
                        echo '</tr>';
                        echo '<tr>';
                        echo '<th>Date Admitted</th>'
                        . '<td>' . $row['dateAdmitted'] . '</td>';
                        echo '</tr>';
                        echo '<tr>';
                        echo '<th>Ward ID</th>'
                        . '<td>' . $row['wardID'] . '</td>';
                        echo '</tr>';
                    ?>
            </tbody>
        </table>
        <p>
            <a class="editPatient"  href="editPatientForm.php?id=<?php echo $row['patientID'];?>">Edit </a>
            <a class="deletePatient" href="deletePatient.php?id=<?php echo $row['patientID']; ?>"> Delete </a>
        </p>
        </div>
    </body>
</html>
