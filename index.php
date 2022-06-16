<?php
require_once ("config.php");
include('header.php');
$query = "SELECT * FROM banner ORDER BY bannerID DESC LIMIT 1 ";
$result = mysqli_query($dbc,$query);

if(mysqli_num_rows($result) > 0) {
	while ($row = mysqli_fetch_array($result)) {
		$banner_image1 = $row['bannerImage1'];
		$banner_image2 = $row['bannerImage2'];
		$banner_image3 = $row['bannerImage3'];
		$title = $row['title'];
		$subject = $row['subject'];
	}
}

$query2 = "SELECT * FROM hotel WHERE active='1' ORDER BY rating DESC,totalRating DESC LIMIT 3";
$result2 = mysqli_query($dbc,$query2);
?>
<!DOCTYPE html>
	<link rel="stylesheet" type="text/css" href="css/owl.carousel.css">
	<link rel="stylesheet" type="text/css" href="css/owl.theme.default.css">
	<title>Kuro Hotel Booking Website</title>
		<div class="banner">
			<div class="owl-four owl-carousel" itemprop="image">
				<?php
					if (!empty ($banner_image1)){
						echo '<img src="data:image;base64,'.base64_encode($banner_image1).'" alt="Image of Bannner" style="height: 600px; width: 100%; object-fit: owl-four owl-carousel;filter: brightness(50%);">';
					} else {
						echo '<img src="images/hotel1.jpg" alt="Image of Bannner" style="height: 600px; width: 100%; object-fit: owl-four owl-carousel;filter: brightness(50%);">';
					}
					if (!empty ($banner_image2)){
						echo '<img src="data:image;base64,'.base64_encode($banner_image2).'" alt="Image of Bannner" style="height: 600px; width: 100%; object-fit: owl-four owl-carousel;filter: brightness(50%);">';
					} else {
						echo '<img src="images/hotel2.jpg" alt="Image of Bannner" style="height: 600px; width: 100%; object-fit: owl-four owl-carousel;filter: brightness(50%);">';
					}
					if (!empty ($banner_image3)){
						echo '<img src="data:image;base64,'.base64_encode($banner_image3).'" alt="Image of Bannner" style="height: 600px; width: 100%; object-fit: owl-four owl-carousel;filter: brightness(50%);">';
					} else {
						echo '<img src="images/hotel3.jpg" alt="Image of Bannner" style="height: 600px; width: 100%; object-fit: owl-four owl-carousel;filter: brightness(50%);">';
					}
				?>
			</div>
			<div class="container" itemprop="description" >
				<h1 style="background: rgba(255, 255, 255, .5); color:black;"><?php echo $title ?></h1>
				<h3 style="background: rgba(255, 255, 255, .5); color:black;"><?php echo $subject ?></h3>
			</div>
			 <div id="owl-four-nav" class="owl-nav"></div>
		</div>
		<!-- Banner Close -->
		<div class="page-heading">
			<div class="container">
				<h2>POPULAR HOTELS</h2>
			</div>
		</div>
		<!-- Popular courses End -->
		<div class="learn-courses">
			<div class="container">
				<div class="courses">
					<div class="owl-one owl-carousel">
						<?php 
						if(mysqli_num_rows($result2) > 0) {
							while ($row = mysqli_fetch_array($result2)) {
								$id = $row['hotelID'];
								$name = $row['hotelName'];
								$email = $row['email'];
								$phone = $row['phoneNo'];
								$address = $row['address'];
								$rating = number_format($row['rating'],1);
								$totalRating = $row['totalRating'];
								$hotelBanner = $row['image1'];
				
							
								echo '<div class="box-wrap" itemprop="event" itemscope itemtype=" http://schema.org/Course">';
								echo '<div class="img-wrap" itemprop="image">'.'<img style="height: 200px; width:400px;" src="data:image;base64,'.base64_encode($hotelBanner).'" alt="courses picture"></div>';
								echo '<div class="box-body" itemprop="description">';
								echo '<p>'.$name.' '.'⭐'.$rating.' '.'('.$totalRating.')'.'</p>';
								echo '<section itemprop="time">';
								echo '<p><span>Address: </span>'.$address.'</p>';
								echo '<p><span> Email: </span>'.$email.'</p>';
								echo '<p><span> Phone Number: </span>'.$phone.'</p>';
								echo '</section>';
								echo '<a href="single_hotel.php?id='.$id.'" class="view-hotel-btn">View hotel</a>';
								echo '</div>';
								echo '</div>';

							}
						}
						?>
					</div>
					<center>
					<div>
						<a href="all_hotel.php" class="view-more-btn">View more hotel></a>
					</div>
					</center>
				</div>
			</div>
		</div>
		<!-- Learn courses End -->
		

		
		
		<!-- Latest News CLosed -->
		<?php include("footer.php");?>
		
	<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
	<script type="text/javascript" src="js/lightbox.js"></script>
	<script type="text/javascript" src="js/all.js"></script>
	<script type="text/javascript" src="js/isotope.pkgd.min.js"></script>
	<script type="text/javascript" src="js/owl.carousel.js"></script>
	<script type="text/javascript" src="js/jquery.flexslider.js"></script>
	<script type="text/javascript" src="js/jquery.rateyo.js"></script>
	<!-- <script type="text/javascript" src="js/jquery.mmenu.all.js"></script> -->
	<!-- <script type="text/javascript" src="js/jquery.meanmenu.min.js"></script> -->
	<script type="text/javascript" src="js/custom.js"></script>
