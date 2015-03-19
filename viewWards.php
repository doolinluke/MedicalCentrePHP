<?php
require_once 'Connection.php';
require_once 'WardTableGateway.php';

require 'ensureUserLoggedIn.php';

$connection = Connection::getInstance();
$wardGateway = new WardTableGateway($connection);

$wards = $wardGateway->getWards();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <script type="text/javascript" src="js/programmer.js"></script>
        
        <title></title>
    </head>
    <body>
        <?php require 'toolbar.php' ?>
        <?php require 'header.php' ?>
        <?php require 'mainMenu.php' ?>
        <div class="container">
            <h2>View Wards</h2>
            <?php
            if (isset($message)) {
                echo '<p>'.$message.'</p>';
            }
            ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>ward name</th>
                        <th>number of beds</th>
                        <th>head nurse</th>                        
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $row = $wards->fetch(PDO::FETCH_ASSOC);
                    while ($row) {


                        echo '<td>' . $row['wardName'] . '</td>';
                        echo '<td>' . $row['numberBeds'] . '</td>';
                        echo '<td>' . $row['headNurse'] . '</td>';
                        echo '<td>'
                        . '<a href="viewWard.php?id='.$row['wID'].'">View</a> '
                        . '<a href="editWardForm.php?id='.$row['wID'].'">Edit</a> '
                        . '<a class="deleteWard" href="deleteWard.php?id='.$row['wID'].'">Delete</a> '
                        . '</td>';
                        echo '</tr>';

                        $row = $wards->fetch(PDO::FETCH_ASSOC);
                    }
                    ?>
                </tbody>
            </table>
            <p><a href="createWardForm.php">Create Ward</a></p>
        </div>
        
        
    </body>
</html>
