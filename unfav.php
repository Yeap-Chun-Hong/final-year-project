<?php
  require_once ("config.php");

  //retrieve customer id and hotel id
  $custID=$_POST['custID']; 
  $hotelID=$_POST['hotelID']; 

  //delete data from database
  $insert = "DELETE FROM favourite where custID='$custID' && hotelID='$hotelID'";
  mysqli_query($dbc, $insert);
?>