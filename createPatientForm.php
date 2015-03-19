<?php
require_once 'connection.php';
require_once 'WardTableGateway.php';
require_once 'PatientTableGateway.php';

$id = session_id();
if ($id == "") {
    session_start();
}

require 'ensureUserLoggedIn.php';

$conn = Connection::getInstance();
$wardGateway = new WardTableGateway($conn);

$wards = $wardGateway->getWards();
?>
<!DOCTYPE html>
<html>
    <head>
        <link href='http://fonts.googleapis.com/css?family=Josefin+Sans:400,600,400italic' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" type="text/css" href=CSS/style.css>
        <meta charset="UTF-8">
        <title>Medical Centre</title>
        <script type="text/javascript" src="Javascript/patient.js"></script>
    </head>
    <body>
        <div id ="header">
            <h1>Create Patient Form</h1>
            <ul class ="menu">
                <li><?php require 'toolbar.php' ?>
                    <?php require 'mainMenu.php' ?>
                    <?php
                    if (isset($errorMessage)) {
                        echo '<p>Error: ' . $errorMessage . '</p>';
                    }
                    ?> 
                </li>
                <li><a href="home.php">Home </a></li>            
            </ul>
        </div>
        <div id ="body">
            <form action="createPatient.php" method="POST" id="createPatientForm">
                <table border="0">
                    <tbody>
                        <tr>
                            <td>First Name</td>
                            <td>
                                <input type="text" name="fName" value="<?php
                                    if (isset($_POST) && isset($_POST['fName'])) {
                                        echo $_POST['fName'];
                                    }
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
                                ?>" />
                                <span id="fNameError" class="error">
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
                            <td>Date of Birth (YYYY-MM-DD)</td>
                            <td>
                                <input type="text" name="dob" value="<?php
                                    if (isset($_POST) && isset($_POST['dob'])) {
                                        echo $_POST['dob'];
                                    }
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
                            <td>Date Admitted (YYYY-MM-DD)</td>
                            <td>
                                <input type="text" name="dateAdmitted" value="<?php
                                    if (isset($_POST) && isset($_POST['dateAdmitted'])) {
                                        echo $_POST['dateAdmitted'];
                                    }
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
                            <td>Ward ID (1 - 5)</td>
                            <td>
                                <select name="wardID">
                                    <option value="-1">No Ward</option>
                                    <?php
                                    $w = $wards->fetch(PDO::FETCH_ASSOC);
                                    while ($w) {
                                        echo '<option value="' . $w['wardID'] .'">' . $w['wardName'] . '</option>';
                                        $w = $wards->fetch(PDO::FETCH_ASSOC);
                                    }
                                    ?>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <input type="submit" value="Create Patient" name="createPatient" />
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>
        </div>
    </body>
</html>
