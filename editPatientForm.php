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
            <form id="editPatientForm" name="editProgrammerForm" action="editPatient.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $id; ?>" />
                <table class="table table-bordered table-responsive">
                    <tbody>
                        <tr>
                            <td>First Name</td>
                            <td>
                                <input type="text" name="fName" value="<?php
                                if (isset($_POST) && isset($_POST['fName'])) {
                                    echo $_POST['fName'];
                                } else
                                    echo $row['fName']
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
                                } else
                                    echo $row['lName']
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
                                } else
                                    echo $row['address']
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
                                } else
                                    echo $row['phoneNumber']
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
                                } else
                                    echo $row['email']
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
                                } else
                                    echo $row['dob']
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
                                } else
                                    echo $row['dateAdmitted']
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
                                } else
                                    echo $row['wardID']
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
        <div class="footerGroup navbar-fixed-bottom">
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
