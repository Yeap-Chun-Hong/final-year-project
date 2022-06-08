<?php
require_once ("config.php");
include('header.php');
?>

<!DOCTYPE html>
<html>
<head>
	<title>contact us</title>
	<meta name="viewport" content="width=device-width">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="css/all.css">
	<link rel="stylesheet" type="text/css" href="css/all.min.css">
	<link rel="stylesheet" type="text/css" href="css/owl.carousel.css">
	<link rel="stylesheet" type="text/css" href="css/owl.theme.default.css">
	<link rel="stylesheet" type="text/css" href="css/jquery.mmenu.all.css" />
	<link rel="stylesheet" type="text/css" href="inner-page-style.css">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	
		
		<section class="contact-page-section">
			<div class="container">
				<div class="people-info-wrap">
					<h2>leave us your info</h2>
					<p>Send the problem that you have face or give us the command that you need to tell us.</p>

					<form action="" method="post">
						<span>
						<input type="name" placeholder="Enter your name*" value="<?php echo !empty($_postData['name'])?$_postData['name']:'';?> "class="input- name">
						<input type="email" placeholder="Email*"value="<?php echo !empty($_postData['email'])?$_postData['email']:'';?> "class="input- email">
						</span>
						<input type="subject" placeholder="Subject*"value="<?php echo !empty($_postData['subject'])?$_postData['subject']:'';?> "class="input- subject">
						<textarea placeholder="Messages*"value="<?php echo !empty($_postData['message'])?$_postData['message']:'';?> "class="input-">
							
						</textarea>
						<input type="submit" value="submit now">
					</form>
				</div>

				<div class="contact-info">
					<h2>contact info</h2>
					<ul class="contact-list">
						<li><i class="fas fa-location-arrow"></i> 
							<span>
								<p>George Town, Pulau Penang</p>
							</span>
						</li>
						<li><i class="fas fa-phone"></i>
							<span> 
								<p>Phone: 0123456789, Mobile: 987654321</p>
								<p>Fax:123789456</p>
							</span>
						</li>
						<li><i class="fas fa-envelope"></i>
							<span>
								<p>xxxinfoxxx@labtheme.com</p>
							</span>
						</li>
					</ul>
					<ul class="contact-social">
						<li><a href=""><i class="fab fa-viber"></i></a></li>
						<li><a href=""><i class="fab fa-google-plus-g"></i></a></li>
						<li><a href=""><i class="fab fa-facebook-square"></i></a></li>
						<li><a href=""><i class="fab fa-facebook-messenger"></i></a></li>
						<li><a href=""><i class="fab fa-twitter"></i></a></li>
						<li><a href=""><i class="fab fa-skype"></i></a></li>
						<li><a href=""><i class="fab fa-youtube"></i></a></li>
					</ul>
				</div>
			</div>
		</section>


		<section class="query-section">
			<div class="container">
				<p>Any Question? Ask us a question at<a href="tel:+0123456789"><i class="fas fa-phone"></i> +60123456789</a></p>
			</div>
		</section>
		<!-- End of Query Section -->
		<footer class="page-footer" itemprop="footer" itemscope itemtype="http://schema.org/WPFooter">
			<div class="footer-last-section">
				<div class="container">
                <p>Any Queries? Ask us a question at <a href="tel:+9779813639131"><i class="fas fa-phone"></i> +977 9813639131</a></p>
				</div>
			</div>
			<!-- End of box-Wrap -->
			<div class="footer-second-section">
				<div class="container">
					<hr class="footer-line">
					<ul class="social-list">
						<li><a href=""><i class="fab fa-facebook-square"></i></a></li>
						<li><a href=""><i class="fab fa-twitter"></i></a></li>
						<li><a href=""><i class="fab fa-skype"></i></a></li>
						<li><a href=""><i class="fab fa-youtube"></i></a></li>
						<li><a href=""><i class="fab fa-instagram"></i></a></li>
					</ul>
					<hr class="footer-line">
				</div>
			</div>
			<div class="footer-last-section">
				<div class="container">
					<p>Copyright 2018 &copy; ProHotelBooking  <span> | </span> Theme designed and developed by <a href="https://labtheme.com">Lab Theme</a></p>
				</div>
			</div>
		</footer>
	</div>
	<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
	<script type="text/javascript" src="js/lightbox.js"></script>
	<script type="text/javascript" src="js/all.js"></script>
	<script type="text/javascript" src="js/isotope.pkgd.min.js"></script>
	<script type="text/javascript" src="js/owl.carousel.js"></script>
	<script type="text/javascript" src="js/jquery.flexslider.js"></script>
	<script type="text/javascript" src="js/jquery.rateyo.js"></script>
	<script type="text/javascript" src="js/jquery.mmenu.all.js"></script>
	<script type="text/javascript" src="js/custom.js"></script>
</body>
</html>