<?php
session_start();
require '../inc/db.php';

if(isset($_POST['submit'])){

    $old_password = filter_var($_POST['old_password'],FILTER_SANITIZE_STRING);
    $new_password = filter_var($_POST['new_password'],FILTER_SANITIZE_STRING);
    $confirm_password = filter_var($_POST['confirm_password'],FILTER_SANITIZE_STRING);


    // Check if this email exists or not
    $query = "SELECT * from users where email=?";
    $stmt = $connection->prepare($query);
    $stmt->execute([$_SESSION['user_email']]);
    $data = $stmt->fetchObject();

    if($data)
    {
        $check = password_verify($old_password,$data->password);

        if($check)
        {
            if($new_password === $confirm_password)
            {
                $new_password = password_hash($new_password,PASSWORD_DEFAULT);
                $query = "UPDATE users SET password=? where email=?";
                $stmt = $connection->prepare($query);
                $stmt->execute([$new_password,$_SESSION['user_email']]);
                header('location:../show-data.php');
                die();
            }            

        }
        else
        {
            $_SESSION['error'] = 'Password not the same';
        }
    }
    else
    {
        $_SESSION['error'] = 'Data not correct';
    }
}
header('location:../change-password.php');