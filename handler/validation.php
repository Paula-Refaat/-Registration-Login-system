<?php


function requireInput($input){
    if(empty($input)){
        return true;
    }
    return false;
}

function minLenght($input,$lenght){
    if(strlen($input) < $lenght){
        return true;
    }
    return false;
}

function maxLenght($input,$lenght){
    if(strlen($input) > $lenght){
        return true;
    }
    return false;
}

function validEmail($email){
    if(filter_var($email,FILTER_VALIDATE_EMAIL)){
        return true;
    }
    return false;
}


function enc_password($password){
    $encPassword = password_hash($password,PASSWORD_DEFAULT);
    return $encPassword;
}