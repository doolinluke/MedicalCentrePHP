<?php
require_once 'Patient.php';
require_once 'Connection.php';
require_once 'PatientTableGateway.php';

$id = session_id();
if ($id == "") {
    session_start();
}

require 'ensureUserLoggedIn.php';

if (isset($_GET) && isset($_GET['sortOrder'])) {
    $sortOrder = $_GET['sortOrder'];
    $columnNames = array("patientID", "fName", "lName", "address", "phoneNumber", "email", "dob", "dateAdmitted", "wardName");
    if (!in_array($sortOrder, $columnNames)) {
        $sortOrder = 'patientID';
    }
}
else {
    $sortOrder = 'patientID';
}

if (!isset($_GET) || !isset($_GET['id'])) {
    die('Invalid request');
}
$id = $_GET['id'];

$connection = Connection::getInstance();
$gateway = new PatientTableGateway($connection);


$statement = $gateway->getPatients($sortOrder, $filterName);
?>
<!DOCTYPE html>
<html>
    <head>
        <link href='http://fonts.googleapis.com/css?family=Lato:400,700,900' rel='stylesheet' type='text/css'>
        <meta charset="UTF-8">
        <script type="text/javascript" src="Javascript/patient.js"></script>
        <title>Medical Centre</title>
        <meta charset="utf-8">  
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Bootstrap -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/custom.css" rel="stylesheet">
        <script src="js/respond.js"></script>
    </head>
    <body>
        <!--<?php require 'toolbar.php' ?>-->
        <?php require 'mainMenu.php' ?>
        <?php
        if (isset($errorMessage)) {
            echo '<p>Error: ' . $errorMessage . '</p>';
        }
        ?> 
        <div class="row"> 
            <nav class="navbar navbar-default navbar-fixed-top navbar-inverse">
                <div class="container">
                    <div class="navbar-brand">
                        <p><img src="img/newlogo.png" alt="" class="img-responsive"></p>
                    </div>
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="glyphicon glyphicon-arrow-down"></span>
                            MENU
                        </button>
                    </div>
                    <div class="collapse navbar-collapse" id="collapse">
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="index.php">Home</a></li>                    
                            <li><a href="#">Services</a></li> 
                            <li><a href="#">Book</a></li>
                            <li><a href="#">Contact</a></li>
                            <li class=""><?php require 'toolbar.php' ?></li>
                        </ul> 
                    </div>
                </div>
            </nav> 
        </div>
        <div class = "row">
            <div class="container">
                <div class = "options col-md-3 col-xs-6">
                    <center>
                        <a href="home.php"><img src="img/patient1.png" alt="" class="img-responsive"></a>
                        <h4>Patients</h4>
                    </center>
                </div>

                <div class = "options col-md-3 col-xs-6">
                    <center>
                        <a href="viewWards.php"><img src="img/ward2.png" alt="" class="img-responsive"></a>
                        <h4>Wards</h4>
                    </center>
                </div>

                <div class = "options col-md-3 col-xs-6">
                    <center>
                        <p><img src="img/doctor.png" alt="" class="img-responsive"></p>
                        <h4>Doctors</h4>
                    </center>
                </div>

                <div class = "options col-md-3 col-xs-6">
                    <center>
                        <p><img src="img/madication.png" alt="" class="img-responsive"></p>
                        <h4>Medication</h4>
                    </center>
                </div>
            </div>
        </div>
        <div class="container">
            <table class="table table-bordered table-responsive">
                <tbody>
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
                    echo '<th>Ward</th>'
                    . '<td>' . $row['wardName'] . '</td>';
                    echo '</tr>';
                    echo '<th>Options</th>'
                    . '<td>'
                    . '<a class="btn btn-edit btn-xs" href="editPatientForm.php?id=' . $row['patientID'] . '">Edit</a> '
                    . '<a class="deletePatient" href="deletePatient.php?id=' . $row['patientID'] . '"><button class = "btn btn-delete btn-xs">Delete</button></a> '
                    . '</td>';
                    '</tr>';
                    ?>
                </tbody>
            </table>
        </div>

        <div class="footerGroup navbar">
            <div class = "row">
                <div class="row3">
                    <div class = "bottom col-md-3 col-xs-6">
                        <ul class="footer navbar-nav">
                            <h3>FIND US HERE</h3>
                            <li><img src="img/fbicon.png" alt="" class="img-responsive"></li>                    
                        </ul>
                    </div>

                    <div class = "bottom col-md-3 col-xs-6">
                        <h3>SEE OUR ENDORSEMENTS</h3>
                        <p>Click here to read reviews from satisfied members as well as professional endorsements and testimonials from highly regarded medical professionals.</p>
                    </div>

                    <div class = "bottom col-md-3 col-xs-6">
                        <h3>CONTACT US</h3>
                        <P>Feel free to get in touch. Either pop into us at our location, phone us, or you can email us.</P>
                        <p>84 Ranelagh Road, Ranelagh, D6</p>
                        <p>Phone: 0871234567</p>
                        <p>ranelaghmedcentre@gmail.com</p>
                    </div>

                    <div class = "bottom col-md-3 col-xs-6">
                        <h3>JOIN OUR MAILING LIST</h3>
                        <p>Enter you email address to keep up to date with new membership offers.</p>
                        <input type="email" id="form_email" name="form[email]" required="required" placeholder="Enter your email address">
                        <a class="btn btn-primary btn-large" href="#">Subscribe</a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class = "footerBar col-md-12 col-xs-12">
                    <p>© Ranelagh Medical Centre. All rights reserved.</p>
                </div>
            </div>
        </div>
        <!-- javascript -->
        <script src="http://code.jquery.com/jquery-latest.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script>
            $('a.btn-info').tooltip()
        </script>
    </body>
</html>
