<?php
require_once ("config.php");

//retrieve booking id
$bookingID=$_GET['id']; 

//delete from database
$delete = "DELETE FROM booking where bookingID='$bookingID'";
mysqli_query($dbc, $delete);
header("Location:admin_view_booking.php");
?>