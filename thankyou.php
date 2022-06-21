<?php
    include ('header.php');
?>
<link type="text/css" rel="stylesheet" href="css/thankyou.css" />
<title>Thank You for booking with us!</title>
<center>
  <img src = "images/thankyou.gif">
<center>
<div class="thankyou-container" >
  <h1>Thank you for booking with us!  <i class="fa fa-check-square-o" aria-hidden="true"></i></h1>
  <h1>You may view your <a href="<?php echo 'booking_history.php?id='.$_SESSION['custID'] ?>">booking history here</a>.</h1>
</div>
<?php
    include ('footer.php');
?>