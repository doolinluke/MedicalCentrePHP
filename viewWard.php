<?php
require_once 'Connection.php';
require_once 'WardTableGateway.php';
require_once 'PatientTableGateway.php';

$sessionId = session_id();
if ($sessionId == "") {
    session_start();
}

require 'ensureUserLoggedIn.php';

if (!isset($_GET) || !isset($_GET['id'])) {
    die('Invalid request');
}
$id = $_GET['id'];

$connection = Connection::getInstance();
$wardGateway = new WardTableGateway($connection);
$patientGateway = new PatientTableGateway($connection);

$wards = $wardGateway->getWardById($id);
$patients = $patientGateway->getPatientsByWardId($id);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <script type="text/javascript" src="js/ward.js"></script>
        <title></title>
    </head>
    <body>
        <?php require 'toolbar.php' ?>
        <?php require 'header.php' ?>
        <?php require 'mainMenu.php' ?>
        <h2>View Ward Details</h2>
        <?php
        if (isset($message)) {
            echo '<p>'.$message.'</p>';
        }
        ?>
        <table>
            <tbody>
                <?php
                $ward = $wards->fetch(PDO::FETCH_ASSOC);
                echo '<tr>';
                echo '<td>Ward Name</td>'
                . '<td>' . $ward['wardName'] . '</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td>Number of Beds</td>'
                . '<td>' . $ward['numberBeds'] . '</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td>Head Nurse</td>'
                . '<td>' . $ward['headNurse'] . '</td>';
                echo '</tr>';
                ?>
            </tbody>
        </table>
        <p>
            <a href="editWardForm.php?id=<?php echo $ward['wardID']; ?>">
                Edit Ward</a>
            <a class="deleteWard" href="deleteWard.php?id=<?php echo $ward['wardID']; ?>">
                Delete Ward</a>
        </p>
        <h3>Patients Assigned to <?php echo $ward['wardName']; ?></h3>
        <?php if ($patients->rowCount() !== 0) { ?>
            <table>
                <thead>
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Address</th>
                        <th>Phone Number</th>
                        <th>Email</th>
                        <th>Date of Birth</th>
                        <th>Date Admitted</th>
                        <th>Ward</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $row = $patients->fetch(PDO::FETCH_ASSOC);
                    while ($row) {
                        echo '<td>' . $row['fName'] . '</td>';
                        echo '<td>' . $row['lName'] . '</td>';
                        echo '<td>' . $row['address'] . '</td>';
                        echo '<td>' . $row['phoneNumber'] . '</td>';
                        echo '<td>' . $row['email'] . '</td>';
                        echo '<td>' . $row['dob'] . '</td>';
                        echo '<td>' . $row['dateAdmitted'] . '</td>';
                        echo '<td>'
                        . '<a href="viewPatient.php?id='.$row['patientID'].'">View</a> '
                        . '<a href="editPatientForm.php?id='.$row['patientID'].'">Edit</a> '
                        . '<a class="deletePatient" href="deleteProgrammer.php?id='.$row['patientID'].'">Delete</a> '
                        . '</td>';
                        echo '</tr>';

                        $row = $patients->fetch(PDO::FETCH_ASSOC);
                    }
                    ?>
                </tbody>
            </table>
        <?php } else { ?>
            <p>There are no patients assigned to this ward.</p>
        <?php } ?>
        <?php require 'footer.php'; ?>
    </body>
</html>