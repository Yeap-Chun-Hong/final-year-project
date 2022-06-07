<?php
session_start();
require_once 'config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta name="viewport" content="width=device-width">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="css/all.css">
	<link rel="stylesheet" type="text/css" href="css/all.min.css">

	<link rel="stylesheet" type="text/css" href="css/jquery.rateyo.css"/>
	<link rel="stylesheet" type="text/css" href="inner-page-style.css">
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="fontawesome-free-6.1.1-web/css/all.css">
	<link rel="stylesheet" href="fontawesome-free-6.1.1-web/css/font-awesome.min.css">
	<link href="https://fonts.googleapis.com/css?family=Raleway:400,500,600,700" rel="stylesheet">
	
</head>
<body>
	<div id="page" class="site" >
		<header class="site-header">
			<!-- Top header Close -->
			<div class="main-header">
				<div class="container">
					<div class="logo-wrap" itemprop="logo">
						<img src="images/site-logo.png" alt="Logo Image" style="width:115px;height56px;">
					</div>
					<div class="nav-wrap">
						<nav class="nav-desktop">
							<ul class="menu-list">
								<li><a href="index.php">Home</a></li>
								<li><a href="all_hotel.php">Hotel</a></li>
								<li><a href="">About Us</a></li>
								<li><a href="">Contact</a></li>
								<?php if (isset($_SESSION['login'])) {
									echo'<li><a href="view_fav.php"><i class="fa fa-heart-o"></i></a></li>';
									echo'<li class="menu-parent">';
									$username = $_SESSION['username'];
									echo $username;
									echo 	'<ul class="sub-menu">
												<li><a href="booking_history.php?id='.$_SESSION['custID'].'">View Booking History</a></li>
												<li><a href="edit_profile.php">Edit Profile</a></li>
												<li><a href="logout.php">Log Out</a></li>
											</ul>
								</li>';			
									}else{echo '<li><a href="login.php">Login / Register</a></li>';}
								?>	
							</ul>
						</nav>
					</div>
				</div>
			</div>
		</header>
		<!-- Header Close -->