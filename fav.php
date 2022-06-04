<?php
require_once ("config.php");
$custID=$_POST['custID']; 
  $hotelID=$_POST['hotelID']; 
  $insert = "INSERT INTO favourite (custID,hotelID) VALUES ('$custID','$hotelID')";
  mysqli_query($dbc, $insert);

?>