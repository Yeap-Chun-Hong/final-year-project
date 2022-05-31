<?php
require_once ("config.php");
include('header.php');
$name = $_POST['Name'];
$email = $_POST['Email'];
$sub = $_POST['Subject'];
$message = $_POST['Message'];
$send = true;
$error = array();

if(empty($name)){
    array_push($error, "Name is required.");
    $register = false;
}else if (!ctype_alpha($name)){
    array_push($error, "Please enter your name before submit");
    $send = false;
}

if(empty($email)){
    array_push($error, "Email address is required.");
    $send = false;
}

if(empty($sub)){
    array_push($error,"Please tell enter the subject");
    $send = false;
}

if(empty($message)){
    array_push($error, "Enter the message to let me know what is the proble");
    $send = false;
}

?>
