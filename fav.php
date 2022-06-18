<?php
  require_once ("config.php");

  //retrieve customer id and hotel id
  $custID=$_POST['custID']; 
  $hotelID=$_POST['hotelID']; 

  //insert data into database
  $insert = "INSERT INTO favourite (custID,hotelID) VALUES ('$custID','$hotelID')";
  mysqli_query($dbc, $insert);
?>