<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Registration</title>
    </head>
    <link href='http://fonts.googleapis.com/css?family=Josefin+Sans:400,600,400italic' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href=CSS/style.css>
    <script type="text/javascript" src="Javascript/register.js"></script>
    <body>
        <div id ="header">
            <h1>Register</h1>
        </div>
        <div id ="body">
            <form id="registerForm" action="checkRegister.php" method="POST" onsubmit="return validateRegistration(this);">
            <table border="0">
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

        </form>
      </div>
    </body>
</html>

