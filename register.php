<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>My Website</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Bootstrap -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/custom.css" rel="stylesheet">
        <script src="js/respond.js"></script>
        <link href='http://fonts.googleapis.com/css?family=Lato:400,700,900' rel='stylesheet' type='text/css'>
    </head>
    <body>
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
        <div class="row">
            <div class="container">
                <div class ="register">
                    <h1>Please Register</h1>
                </div>
            </div>
        </div>
        <form id="registerForm" action="checkRegister.php" method="POST" onsubmit="return validateRegistration(this);">
            <div class="container">           
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td>Username</td>
                            <td>
                                    <input type="text" name="username" value="<?php
                                        if (isset($_POST) && isset($_POST['username'])) {
                                            echo $_POST['username'];
                                        }
                                    ?>" />
                                <span id="usernameError" class="error">
                                    <?php
                                    if (isset($errorMessage) && isset($errorMessage['username'])) {
                                        echo $errorMessage['username'];
                                    }
                                    ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>Password</td>
                            <td>
                                <input type="password" name="password" value="<?php
                                    if (isset($_POST) && isset($_POST['password'])) {
                                        echo $_POST['password'];
                                    }
                                ?>" />
                                <span id="passwordError" class="error">
                                    <?php
                                    if (isset($errorMessage) && isset($errorMessage['password'])) {
                                        echo $errorMessage['password'];
                                    }
                                    ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>Confirm Password</td>
                            <td>
                                <input type="password" name="password2" value="<?php
                                    if (isset($_POST) && isset($_POST['password2'])) {
                                        echo $_POST['password2'];
                                    }
                                ?>" />
                                <span id="password2Error" class="error">
                                    <?php
                                    if (isset($errorMessage) && isset($errorMessage['password2'])) {
                                        echo $errorMessage['password2'];
                                    }
                                    ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <input type="submit" value="Register" name="register" />
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

