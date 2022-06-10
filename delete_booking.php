<?php
require_once ("config.php");
$bookingID=$_GET['id']; 
  $delete = "DELETE FROM booking where bookingID='$bookingID'";
  mysqli_query($dbc, $delete);
  header("Location:admin_view_booking.php");
?>