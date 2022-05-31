<?php
require_once ("config.php");
include('header.php');
$query2 = "SELECT * FROM hotel ORDER BY rating DESC";
$result2 = mysqli_query($dbc,$query2);
?>
		<title>Kuro Hotel Booking Website</title>
		<section class="course-listing-page">
			<div class="container">
				<div class="page-heading">
					<div class="container">
						<h2>HOTELS</h2>
					</div>
				</div>
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
				
							
								echo'<div class="grid" id="cGrid">';
                                echo'<div class="grid-item" >';
                                echo'<div class="img-wrap">';
                                echo'<img style="height: 200px; width:400px;" src="data:image;base64,'.base64_encode($hotelBanner).'">';
                                echo'</div>';
                                echo'<div class="box-body">';
                                echo'<p>'.$name.' '.'⭐'.$rating.' '.'('.$totalRating.')'.'</p>';;
                                echo'<section>';
                                echo'<p><span>Address: </span>'.$address.'</p>';
                                echo'<p><span> Check-In  Time: </span>'.$email.'</p>';
                                echo'<p><span> Check-Out Time: </span>'.$phone.'</p>';
                                echo'</section>';
                                echo'<a href="#" class="view-hotel-btn">View hotel</a>';
                                echo'</div>';
                                echo'</div>';
							}
						}
						?>
            </section>
					

		
	<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
	<script type="text/javascript" src="js/lightbox.js"></script>
	<script type="text/javascript" src="js/all.js"></script>
	<script type="text/javascript" src="js/isotope.pkgd.min.js"></script>
	<script type="text/javascript" src="js/owl.carousel.js"></script>
	<script type="text/javascript" src="js/jquery.flexslider.js"></script>
	<script type="text/javascript" src="js/jquery.rateyo.js"></script>
	<script type="text/javascript" src="js/jquery.mmenu.all.js"></script>
	<script type="text/javascript" src="js/custom.js"></script>
<?php
    include('footer.php');
?>