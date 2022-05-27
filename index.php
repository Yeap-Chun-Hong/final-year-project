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

$query2 = "SELECT * FROM hotel ORDER BY rating DESC LIMIT 3";
$result2 = mysqli_query($dbc,$query2);
?>
<!DOCTYPE html>
<html>

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
								$checkInTime = $row['checkInTime'];
								$checkOutTime = $row['checkOutTime'];
								$address = $row['address'];
								$rating = number_format($row['rating'],1);
								$totalRating = $row['totalRating'];
								$hotelBanner = $row['image1'];
				
							
								echo '<div class="box-wrap" itemprop="event" itemscope itemtype=" http://schema.org/Course">';
								echo '<div class="img-wrap" itemprop="image">'.'<img src="data:image;base64,'.base64_encode($hotelBanner).'" alt="courses picture"></div>';
								echo '<div class="box-body" itemprop="description">';
								echo '<p>'.$name.' '.'⭐'.$rating.' '.'('.$totalRating.')'.'</p>';
								echo '<section itemprop="time">';
								echo '<p><span>Address: </span>'.$address.'</p>';
								echo '<p><span> Check-In  Time: </span>'.$checkInTime.'</p>';
								echo '<p><span> Check-Out Time: </span>'.$checkOutTime.'</p>';
								echo '</section>';
								echo '<a href="#" class="view-hotel-btn">View hotel</a>';
								echo '</div>';
								echo '</div>';

							}
						}
						?>
					</div>
					<center>
					<div>
						<a href="#" class="view-more-btn">View more hotel></a>
					</div>
					</center>
				</div>
			</div>
		</div>
		<!-- Learn courses End -->
		

		
		<section class="page-heading">
			<div class="container">
				<h2>upcomming events</h2>
			</div>
		</section>
		<section class="events-section" itemprop="event" itemscope itemtype=" http://schema.org/Event">
			<div class="container">
				<div class="event-wrap">
					<div class="img-wrap" itemprop="image">
						<img src="images/events.jpg" alt="event images">
					</div>
					<div class="details">
						<a href=""><h3 itemprop="name">Orientation Programme for new Students.</h3></a>
						<p itemprop="description">Orientation Programme for new sffs Students. Orientation Programme for new sffs Students. Orientation Programme for new sffs Students.</p>

						<h5 itemprop="startDate"><i class="far fa-clock"></i> Dec 30,2018 | 11am</h5>
						<h5 itemprop="location"><i class="fas fa-map-marker-alt"></i> Hotel Malla, Lainchaur</h5>
					</div>
				</div>

				<div class="event-wrap">
					<div class="img-wrap" itemprop="image">
						<img src="images/events.jpg" alt="event images">
					</div>
					<div class="details">
						<a href=""><h3 itemprop="name">Orientation Programme for new Students.</h3></a>
						<p itemprop="description">Orientation Programme for new sffs Students. Orientation Programme for new sffs Students. Orientation Programme for new sffs Students.</p>

						<h5 itemprop="startDate"><i class="far fa-clock"></i> Dec 30,2018 | 11am</h5>
						<h5 itemprop="location"><i class="fas fa-map-marker-alt"></i> Hotel Malla, Lainchaur</h5>
					</div>
				</div>
			</div>
		</section>
		<!-- End of Events section -->
		<section class="what-other-say">
			<div class="container">
				<h4 class="article-subtitle">Get to Know</h4>
				<h2 class="head">what our customer say</h2>
				<div class="three owl-carousel owl-theme">
					<div class="customer-item" itemscope itemtype="http://schema.org/Rating">
						<div class="border">
							<div class="customer">
								<figure>
									<img class="customer-img" src="images/kimberly1.jpg" alt="Person image">
									<figcaption>
										<span itemprop="author">SAGAR KUMAR SAPKOTA</span>
										<div class="rateYo" itemprop="ratingValue"></div>
									</figcaption>
								</figure>
							</div>
							<div class="customer-review">
								<p itemprop="description">
									"Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
									tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
									quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
									consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
									cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non"
								</p>
							</div>
						</div>
					</div>
					<div class="customer-item" itemscope itemtype="http://schema.org/Rating">
						<div class="border">
							<div class="customer">
								<figure>
									<img class="customer-img" src="images/customer-img.jpg" alt="Person image">
									<figcaption>
										<span itemprop="author">SAGAR KUMAR SAPKOTA</span>
										<div class="rateYo" itemprop="ratingValue"></div>
									</figcaption>
								</figure>
							</div>
							<div class="customer-review">
								<p itemprop="description">
									"22222Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
									tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
									quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
									consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
									cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non"
								</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- End of Others talk -->
		<section class="page-heading">
			<div class="container">
				<h2>latest news</h2>
			</div>
		</section>
		<section class="latest-news">
			<div class="container" itemprop="event" itemscope itemtype=" http://schema.org/Event">
				<div class="owl-two owl-carousel">
					<div class="news-wrap" itemprop="event">
						<div class="news-img-wrap" itemprop="image">
							<img src="images/latest-new-img.jpg" alt="Latest News Images">
						</div>
						<div class="news-detail" itemprop="description">
							<a href=""><h1>Orientation Programme for new Students.</h1></a>
							<h2 itemprop="startDate">By Admin | 20 Dec. 2018</h2>

							<p>Orientation Programme for new sffs Students. Orientatin Programmes for new Students.. Orientatin Programmes for new Students</p>
						</div>
					</div>

					<div class="news-wrap" itemprop="event">
						<div class="news-img-wrap" itemprop="image">
							<img src="images/latest-new-img.jpg" alt="Latest News Images">
						</div>
						<div class="news-detail" itemprop="description">
							<a href=""><h1>Orientation Programme for new Students.</h1></a>
							<h2 itemprop="startDate">By Admin | 20 Dec. 2018</h2>

							<p>Orientation Programme for new sffs Students. Orientatin Programmes for new Students.. Orientatin Programmes for new Students</p>
						</div>
					</div>

					<div class="news-wrap" itemprop="event">
						<div class="news-img-wrap" itemprop="image">
							<img src="images/latest-new-img.jpg" alt="Latest News Images">
						</div>
						<div class="news-detail" itemprop="description">
							<a href=""><h1>Orientation Programme for new Students.</h1></a>
							<h2 itemprop="startDate">By Admin | 20 Dec. 2018</h2>

							<p>Orientation Programme for new sffs Students. Orientatin Programmes for new Students.. Orientatin Programmes for new Students</p>
						</div>
					</div>
				</div>
			</div>
		</section>
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
</body>
</html>