<?php
require_once ("config.php");
$memberID=$_GET['id']; 
$delete = "DELETE FROM team where id='$memberID'";
mysqli_query($dbc, $delete);
header('Location: about_us.php');
?>