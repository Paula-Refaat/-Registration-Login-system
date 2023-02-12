<?php
session_start();
include 'validation.php';
include '../inc/db.php';

if(isset($_POST['submit'])){
    $email = filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
    $password = filter_var($_POST['password'],FILTER_SANITIZE_STRING);

    if(requireInput($email)){
        $_SESSION['error'] = 'Email is Require';
    }
    if(requireInput($password)){
        $_SESSION['error'] = 'password is Require';
    }
    if (!validEmail($email)){
        $_SESSION['error'] = 'Please Enter a Valid Email';
    }

    // Check in database if Email is exists or not

    $query = "SELECT * FROM users where email=? ";
    $stmt = $connection->prepare($query);
    $stmt->execute([$email]);
    $data = $stmt->fetchObject();

    if($data){

        $check = password_verify($password,$data->password);

        if($check){
            $_SESSION['user_id'] = $data->id;
            $_SESSION['user_name'] = $data->name;
            $_SESSION['user_email'] = $data->email;

            header('location:../index.php');
            die();
        }
        else
        {
            $_SESSION['error'] = 'Email correct but Password not correct';
        } 
    }
    else
    {
        $_SESSION['error'] = 'Data not correct';
    }
}
header('location:../login.php');