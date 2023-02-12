<?php

 $host = 'localhost';
 $user = 'root';
 $pass = '';
 $db_name = 'registration_system';


    try {
        $dsn = "mysql:host=$host;dbname=$db_name";
        $connection = new PDO($dsn,$user,$pass);
    } catch (PDOException $e) {
        echo "This Connection is " . $e->getMessage();
        die;
    }

?>