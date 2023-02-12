<?php
session_start();
include 'validation.php';
require_once '../inc/db.php';



if(isset($_POST['submit'])){
    $name = filter_var($_POST['name'],FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
    $password = filter_var($_POST['password'],FILTER_SANITIZE_STRING);
    $repeatPassword = filter_var($_POST['rep_password'],FILTER_SANITIZE_STRING);

        if(requireInput($name)){
            $_SESSION['error'] = 'Name is Require';
            header('location:../register.php');
            die();
        }
        if(requireInput($email)){
            $_SESSION['error'] = 'Email is Require';
            header('location:../register.php');
            die();
        }
        if(requireInput($password)){
            $_SESSION['error'] = 'password is Require';
            header('location:../register.php');
            die();
        }
        if(requireInput($repeatPassword)){
            $_SESSION['error'] = 'Repeat password is Require';
            header('location:../register.php');
            die();
        }
        if(!validEmail($email)){
            $_SESSION['error'] = 'Please enter a Valid Email';
            header('location:../register.php');
            die();
        }
        if(minLenght($name , 3)){
            $_SESSION['error'] = 'Please enter name more than 3 char';
            header('location:../register.php');
            die();
        }
        if(maxLenght($name , 20)){
            $_SESSION['error'] = 'Please enter name less than 20 char';
            header('location:../register.php');
            die();
        }

        // search if email is exists or not
        $query = "SELECT email from users WHERE email = ?";
        $stmt = $connection->prepare($query);
        $stmt->execute([$email]);
        $data = $stmt->fetchObject();

        if($data){
            $_SESSION['error'] = 'Email is already exist, please login';
            header('location:../register.php');
            die();
        }

        //check if password equal repeated password and insert data into database
        if($password === $repeatPassword){

            $encPassword = enc_password($password);
            $query = "INSERT INTO users (name,email,password) values (?,?,?)";
            $stmt = $connection->prepare($query);
            $stmt->execute([$name,$email,$encPassword]);
            $_SESSION['success'] = 'You Are Register successfully';
        }
        else{
            $_SESSION['error'] = 'The repeated password not correct, try again';
            header('location:../register.php');
            die();
        }
}

header('location:../register.php');