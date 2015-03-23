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
        <?php require 'toolbar.php' ?>
        <div class="row"> 
            <nav class="navbar navbar-default navbar-fixed-top navbar-inverse">
                <div class="container">
                    <div class="navbar-brand">
                        <p><img src="img/logo.png" alt="" class="img-responsive"></p>
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
                            <li><a href="#">Home</a></li>                    
                            <li><a href="#">Services</a></li> 
                            <li><a href="#">Book</a></li>
                            <li><a href="#">Contact</a></li>
                            <li><a class="btn btn-primary btn-large" href="login.php">Sign In</a></li>
                            <li></li>
                        </ul> 
                    </div>
                </div>
            </nav> 
        </div>
        <div class = "row">
            <div class="welcome">
                <div class="container">
                    <h1>Home</h1>
                    <!--  Calls in the session $username the prints it out -->
                    <?php
                    $username = $_SESSION['username'];
                    echo '<h3>Welcome ' . $username . '</h3>';
                    ?>
                </div>
            </div>
        </div>
        <?php 
        if (isset($message)) {
            echo '<p>'.$message.'</p>';
        }
        ?>
                            
        <div class="container">
            <table class="table table-striped">           
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

        <div class="row">
            <div class="createButton">
                <div class="container">
                    <a class="btn btn-primary btn-large" href="createPatientForm.php">Create new Patient</a>
                </div>
            </div>
        </div>
        
        <div class = "row">
        <div class = "bottom col-md-3 col-xs-6">
            <ul class="footer navbar-nav">
                <h3>FIND US HERE</h3>
                <li><img src="img/fbicon.png" alt="" class="img-responsive"></li>                    
                <li><img src="img/googleicon.png" alt="" class="img-responsive"></li> 
                <li><img src="img/twittericon.png" alt="" class="img-responsive"></li>
            </ul>
        </div>

        <div class = "bottom col-md-3 col-xs-6">
            <h3>SEE OUR ENDORSEMENTS</h3>
            <p>Click here to read reviews from satisfied members as well as professional endorsements and testimonials from highly regarded medical professionals.</p>
        </div>

        <div class = "bottom col-md-3 col-xs-6">
            <h3>CONTACT US</h3>
            <P>Feel free to get in touch. Either pop into us at our location, phone us, or you can email us.</P>
            <ul class="footer navbar-nav">
                <li><img src="img/locationicon.png" alt="" class="img-responsive"></li>                    
                <li><p>84 Ranelagh Road, Ranelagh, D6</p></li> 
            </ul>
            <ul class="footer navbar-nav">
                <li><img src="img/phoneicon.png" alt="" class="img-responsive"></li>                    
                <li><p>0871234567</p></li> 
            </ul>
            <ul class="footer navbar-nav">
                <li><img src="img/mailicon.png" alt="" class="img-responsive"></li>                    
                <li><p>ranelaghmedcentre@gmail.com</p></li> 
            </ul>
        </div>

        <div class = "bottom col-md-3 col-xs-6">
                <h3>JOIN OUR MAILING LIST</h3>
                <p>Enter you email address to keep up to date with new membership offers.</p>
                <input type="email" id="form_email" name="form[email]" required="required" placeholder="Enter your email address">
                <a class="btn btn-primary btn-large" href="#">Subscribe</a>
        </div>
    </div>
    
    <div class="row">
        <div class = "footerBar col-md-6 col-xs-6">
            <p>© Ranelagh Medical Centre. All rights reserved.</p>
        </div>
   
        <div class = "footerBar col-md-6  col-xs-6">
            <ul class="footerBar navbar-nav">
                <li>Home</li>
                <li>Our Team</li>
                <li>Services</li>
                <li>Book</li>
                <li>Contact</li>
            </ul>
        </div>
    </div>
    </body>
</html>
