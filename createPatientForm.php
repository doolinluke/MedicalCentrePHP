<?php
require_once 'connection.php';
require_once 'WardTableGateway.php';

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
                    <?php require 'header.php' ?>
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
                                <input type="text" name="fName" value="" />
                                <span id="fNameError" class="error"></span>
                            </td>
                        </tr>
                        <tr>
                            <td>Second Name</td>
                            <td>
                                <input type="text" name="lName" value="" />
                                <span id="lNameError" class="error"></span>
                            </td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td>
                                <input type="text" name="address" value="" />
                                <span id="addressError" class="error"></span>
                            </td>
                        </tr>
                        <tr>
                            <td>Phone Number</td>
                            <td>
                                <input type="text" name="phoneNumber" value="" />
                                <span id="phoneNumberError" class="error"></span>
                            </td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>
                                <input type="text" name="email" value="" />
                                <span id="emailError" class="error"></span>
                            </td>
                        </tr>
                        <tr>
                            <td>Date of Birth (YYYY-MM-DD)</td>
                            <td>
                                <input type="text" name="dob" value="" />
                                <span id="dobError" class="error"></span>
                            </td>
                        </tr>
                        <tr>
                            <td>Date Admitted (YYYY-MM-DD)</td>
                            <td>
                                <input type="text" name="dateAdmitted" value="" />
                                <span id="dateAdmittedError" class="error"></span>
                            </td>
                        </tr>
                        <tr>
                            <td>Ward ID (1 - 5)</td>
                            <td>
                                <input type="text" name="wardID" value="" />
                                <span id="wardIDError" class="error"></span>
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
