<?php

class Connection { //create a class to make the connection
    private static $connection = NULL;
    
    public static function getInstance() {
        /*Creates new connection if connection doesn't already exist*/
        if (Connection::$connection === NULL) {
            $host = 'daneel'; //specify login details to phpmyadmin page
            $database = 'N00134696'; 
            $username = 'N00134696'; 
            $password = 'N00134696'; 
            $dsn = 'mysql:dbname='.$database.";host=".$host;

            Connection::$connection = new PDO($dsn, $username, $password);
            if (!Connection::$connection) { //tests the connection
                die("Could not connect to database!");
            }
        }
        
        return Connection::$connection;
    }
}
