<?php
require_once ("config.php");
$custID=$_POST['custID']; 
  $hotelID=$_POST['hotelID']; 
  $insert = "DELETE FROM favourite where custID='$custID' && hotelID='$hotelID'";
  mysqli_query($dbc, $insert);

?>