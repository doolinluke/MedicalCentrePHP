<?php
require_once 'Patient.php';
require_once 'Connection.php';
require_once 'PatientTableGateway.php';

$id = session_id();
if ($id == "") {
    session_start();
}
if (!isset($username)) {
    $username = '';
}

$connection = Connection::getInstance();
$gateway = new PatientTableGateway($connection);

$statement = $gateway->getPatients();
?>
<!DOCTYPE html>
<html>
    <head>
        <link href='http://fonts.googleapis.com/css?family=Josefin+Sans:400,600,400italic' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" type="text/css" href=CSS/style.css>
        <meta charset="UTF-8">
        <title>Medical Centre</title>
    </head>
    <body>

        <div id ="header">
            <h1>Login</h1>
            </div>
            <div id ="body">
                <script>
                function myFunction() {
                    var user = prompt("please enter your username", "Example");
                    var user1 = prompt("please enter your email", "Example");
                    var security = prompt("what is your mothers maiden name?", "Example");

                    if (user !== null && user1 !== null) {
                        alert("An email has been sent to User " + (user) + " with your password.");
                    }
                }
                </script>
                <form action="checkLogin.php" method="POST">
                <table border="0">
                    <tbody>
                        <tr>
                            <td class="FieldEnlarge">Username</td>
                            <td>
                                <input type="text"
                                       name="username"
                                       value="<?php echo $username; ?>" />
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
                                <input type="password" name="password" value="" />
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
                            <td></td>
                            <td >
                                <input type="submit" class="FieldEnlarge" value="Login" name="login" />
                                <input type="button" class="FieldEnlargeByHalf alpha" value="Forgot Password" name="forgot" onclick="myFunction()" />
                                <input type="button" class="FieldEnlargeByHalf alpha" value="Register" name="register" onclick="document.location.href = 'register.php'"/>

                                <p id="demo"></p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>            
        </div>
    </body>
</html>
