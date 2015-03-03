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
if ($statement->rowCount() !== 1) {
    die("Illegal request");
}
$row = $statement->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
    <head>
        <link href='http://fonts.googleapis.com/css?family=Josefin+Sans:400,600,400italic' rel='stylesheet' type='text/css'>
        <meta charset="UTF-8">
        <title></title>
        <script type="text/javascript" src="Javascript/patient.js"></script>
        <link rel="stylesheet" type="text/css" href=CSS/style.css>
    </head>
    <body>
        <div id="body">
            <div id="header">
                <h1>Edit Patient Form</h1>
                <?php require 'toolbar.php' ?>
                <?php
                if (isset($errorMessage)) {
                    echo '<p>Error: ' . $errorMessage . '</p>';
                }
                ?>                
            </div>
            <div id="body">
                <a href="home.php">Home </a>
                <form id="editPatientForm" name="editPatientForm" action="editPatient.php" method="POST">
                    <table id ="table" border="0">
                        <tbody>
                            <tr>
                            <td>First Name</td>
                                <td>
                                    <input type="text" name="fName" value="<?php
                                        if (isset($_POST) && isset($_POST['fName'])) {
                                            echo $_POST['fName'];
                                        }
                                        else echo $row['fName']
                                    ?>" />
                                       <span id="fNameError" class="error">
                                        <?php
                                        if (isset($errorMessage) && isset($errorMessage['fName'])) {
                                            echo $errorMessage['fName'];
                                        }
                                        ?>
                                    </span>
                                </td>
                            </tr>
                            <tr>
                            <td>Second Name</td>
                                <td>
                                    <input type="text" name="lName" value="<?php
                                        if (isset($_POST) && isset($_POST['lName'])) {
                                            echo $_POST['lName'];
                                        }
                                        else echo $row['lName']
                                    ?>" />
                                       <span id="lNameError" class="error">
                                        <?php
                                        if (isset($errorMessage) && isset($errorMessage['lName'])) {
                                            echo $errorMessage['lName'];
                                        }
                                        ?>
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td>Address</td>
                                <td>
                                    <input type="text" name="address" value="<?php
                                        if (isset($_POST) && isset($_POST['address'])) {
                                            echo $_POST['address'];
                                        }
                                        else echo $row['address']
                                    ?>" />
                                    <span id="addressError" class="error">
                                        <?php
                                        if (isset($errorMessage) && isset($errorMessage['address'])) {
                                            echo $errorMessage['address'];
                                        }
                                        ?>
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td>Phone Number</td>
                                <td>
                                    <input type="text" name="phoneNumber" value="<?php
                                        if (isset($_POST) && isset($_POST['phoneNumber'])) {
                                            echo $_POST['phoneNumber'];
                                        }
                                        else echo $row['phoneNumber']
                                    ?>" />
                                    <span id="phoneNumberError" class="error">
                                        <?php
                                        if (isset($errorMessage) && isset($errorMessage['phoneNumber'])) {
                                            echo $errorMessage['phoneNumber'];
                                        }
                                        ?>
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>
                                    <input type="text" name="email" value="<?php
                                        if (isset($_POST) && isset($_POST['email'])) {
                                            echo $_POST['email'];
                                        }
                                        else echo $row['email']
                                    ?>" />
                                    <span id="emailError" class="error">
                                        <?php
                                        if (isset($errorMessage) && isset($errorMessage['email'])) {
                                            echo $errorMessage['email'];
                                        }
                                        ?>
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td>Date of Birth</td>
                                <td>
                                    <input type="text" name="dob" value="<?php
                                        if (isset($_POST) && isset($_POST['dob'])) {
                                            echo $_POST['dob'];
                                        }
                                        else echo $row['dob']
                                    ?>" />
                                    <span id="dobError" class="error">
                                        <?php
                                        if (isset($errorMessage) && isset($errorMessage['dob'])) {
                                            echo $errorMessage['dob'];
                                        }
                                        ?>
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td>Date Admitted</td>
                                <td>
                                    <input type="text" name="dateAdmitted" value="<?php
                                        if (isset($_POST) && isset($_POST['dateAdmitted'])) {
                                            echo $_POST['dateAdmitted'];
                                        }
                                        else echo $row['dateAdmitted']
                                    ?>" />
                                    <span id="dateAdmittedError" class="error">
                                        <?php
                                        if (isset($errorMessage) && isset($errorMessage['dateAdmitted'])) {
                                            echo $errorMessage['dateAdmitted'];
                                        }
                                        ?>
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td>Ward ID</td>
                                <td>
                                    <input type="text" name="wardID" value="<?php
                                        if (isset($_POST) && isset($_POST['wardID'])) {
                                            echo $_POST['wardID'];
                                        }
                                        else echo $row['wardID']
                                    ?>" />
                                    <span id="wardIDError" class="error">
                                        <?php
                                        if (isset($errorMessage) && isset($errorMessage['wardID'])) {
                                            echo $errorMessage['wardID'];
                                        }
                                        ?>
                                    </span>
                                </td>
                            </tr>
                            <tr>
                            <tr>
                                <td></td>
                                <td>
                                    <input type="submit" value="Update Patient" name="updatePatient" />
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </body>
</html>
