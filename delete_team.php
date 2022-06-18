<?php
require_once ("config.php");

//retrieve member id
$memberID=$_GET['id']; 

//delete from database
$delete = "DELETE FROM team where id='$memberID'";
mysqli_query($dbc, $delete);

//redirect user to about us page
header('Location: about_us.php');
?>