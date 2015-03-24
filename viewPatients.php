<?php
require_once 'Connection.php';
require_once 'PatientTableGateway.php';

require 'ensureUserLoggedIn.php';

$connection = Connection::getInstance();
$gateway = new PatientTableGateway($connection);

$statement = $gateway->getPatients();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <script type="text/javascript" src="js/patient.js"></script>
        <?php require "styles.php" ?>
        <title></title>
    </head>
    <body>
        <?php require 'toolbar.php' ?>
        <?php require 'header.php' ?>
        <?php require 'mainMenu.php' ?>
        <div class="container">
            <h2>View Patients</h2>
            <?php
            if (isset($message)) {
                echo '<p>' . $message . '</p>';
            }
            ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>Staff Number</th>
                        <th>Skills</th>
                        <th>Salary</th>
                        <th>Manager</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $row = $statement->fetch(PDO::FETCH_ASSOC);
                    while ($row) {


                        echo '<td>' . $row['name'] . '</td>';
                        echo '<td>' . $row['email'] . '</td>';
                        echo '<td>' . $row['mobile'] . '</td>';
                        echo '<td>' . $row['staffNumber'] . '</td>';
                        echo '<td>' . $row['skills'] . '</td>';
                        echo '<td>' . $row['salary'] . '</td>';
                        echo '<td>' . $row['managerName'] . '</td>';
                        echo '<td>'
                        . '<a href="viewPatient.php?id=' . $row['id'] . '">View</a> '
                        . '<a href="editPatientForm.php?id=' . $row['id'] . '">Edit</a> '
                        . '<a class="deletePatient" href="deletePatient.php?id=' . $row['id'] . '">Delete</a> '
                        . '</td>';
                        echo '</tr>';

                        $row = $statement->fetch(PDO::FETCH_ASSOC);
                    }
                    ?>
                </tbody>
            </table>
            <p><a href="createPatientForm.php">Create Patient</a></p>
        </div>
        <?php require 'footer.php'; ?>
        <?php require 'scripts.php'; ?>
    </body>
</html>
