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
                            <li><a class="btn btn-primary btn-large" href="toolbar.php">Log Out</a></li>
                            <li></li>
                        </ul> 
                    </div>
                </div>
            </nav> 
        </div>        
        <form action="createPatient.php" method="POST" id="createPatientForm">
            <div class="container">
                <table class="table table-bordered">                
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
                                    <input type="submit" class="btn btn-info" value="Submit">
                                </td>
                            </tr>
                        </tbody>
                </table>
            </div>
        </form>
       
        <div class = "row">
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
