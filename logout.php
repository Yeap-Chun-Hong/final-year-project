<?php
session_start();

//delete session variable
unset($_SESSION);

//destroy session data
session_destroy();

//redirect user to login page
header("Location:index.php");
?>