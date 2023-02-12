<?php 
include './inc/db.php';

class User{

    public static function getAllUsers(){
        global $connection;
        $query = 'SELECT * FROM users';
        $stmt = $connection->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS);
    }
}