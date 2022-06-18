<?php
    include ('header.php');

	//retrieve hotel id and fetch the data from database
    $hotelID = $_GET['id'];
    $query1 = "SELECT * FROM hotel WHERE hotelID='$hotelID'";
    $result =  mysqli_query($dbc,$query1);
    if(mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $id = $row['hotelID'];
			$name = $row['hotelName'];
            $checkInTime = $row['checkInTime'];
            $checkOutTime = $row['checkOutTime'];
            $address = $row['address'];
            $email = $row['email'];
            $phone = $row['phoneNo'];
            $desc = $row['description'];
            $image1 = $row['image1'];
            $image2 = $row['image2'];
            $image3 = $row['image3'];
            $rating = number_format($row['rating'],1);
			$totalRating = $row['totalRating'];
            $hv_wifi = $row['hv_wifi'];
			$hv_pool = $row['hv_pool'];
            $hv_nsr = $row['hv_nsr'];
            $hv_parking = $row['hv_parking'];
            $hv_ac = $row['hv_ac'];
            $hv_lift= $row['hv_lift'];
        }
    }


	if(isset($_POST['submitted'])){
		$title = $_POST['title'];
		$message = $_POST['message'];
		$rating = $_POST['rating'];
		$error = array();
		$success = array();
		$review=true;

		//data validation, require user to log in to give review
		if(isset($_SESSION['login'])){
			$custID= $_SESSION['custID'];
			$query = "SELECT * FROM rating WHERE custID='$custID' && hotelID='$hotelID'";
			$result =  mysqli_query($dbc,$query);

			//validate 1 customer can review 1 time only
			if(mysqli_num_rows($result) > 0) {
				array_push($error, "You have reviewed this hotel.");
				$review = false;
			}

			//empty input validation
			if(empty($message)){
				array_push($error, "Message is required.");
				$review = false;
			}
			if(empty($title)){
				array_push($error, "Subject is required.");
				$review = false;
			}
			
			if(empty($rating)){
				array_push($error, "Rating is required.");
				$review = false;
			}

			if ($review){
				//insert data into database
				$insert = "INSERT INTO rating (title,message,rate,hotelID,custID) VALUES ('$title','$message','$rating','$hotelID','$custID')";
				if (mysqli_query($dbc, $insert)) {
					array_push($success, "Thank you for reviewing us!.");

					//calculate the rating marks and total number of rating received
					$query5 = "SELECT * FROM rating WHERE hotelID='$hotelID' ";
					$result5 = mysqli_query($dbc,$query5);
					if(mysqli_num_rows($result5) > 0) {

						//initializing data
						$rate = 0;
						$totalRate = 0;
						$total_rate_marks = 0;

						while ($row = mysqli_fetch_array($result5)) {
							$rate += $row['rate']; //accumulate total rating marks
							$totalRate ++; //accumulate total rating received
						}
						//calculate total rating marks and update to databse
						$total_rate_marks = $rate / $totalRate;
						$rating_query = "UPDATE hotel SET rating ='$total_rate_marks', totalRating='$totalRate' WHERE hotelID = '$hotelID'";
						mysqli_query($dbc, $rating_query);
					}
				} else {
					array_push($error, "Database error. Please try again later");
				}
			}

		}else{
			array_push($error, "Log In is required!");
		}
	}

?>
<!DOCTYPE html>
	<link rel="stylesheet" type="text/css" href="css/owl.carousel.css">
	<link rel="stylesheet" type="text/css" href="css/owl.theme.default.css">
    <link rel="stylesheet" type="text/css" href="css/lightbox.css">
	<link rel="stylesheet" type="text/css" href="css/rating.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	
	<script type="text/javascript" src="js/favourite.js"></script>
	<title><?php echo $name?></title>
		<section class="page-content" id="course-page">
			<div class="container">					
							<section class="contact-page-section">
			<div class="container">
				<div class="people-info-wrap">
					<h2>Guest Review</h2>
			</div>
		</section>
		
				<?php 
					//fetch rating data and display to  hotel page
					$query4 = "SELECT * FROM rating WHERE hotelID='$id' ORDER BY ratingID DESC ";
					$result4 = mysqli_query($dbc,$query4);
					if(mysqli_num_rows($result4) > 0) {
						echo'<section class="what-other-say">
								<div class="container">
									<div class="three owl-carousel owl-theme">';
						while ($row = mysqli_fetch_array($result4)) {
							$ratingID = $row['ratingID'];
							$title = $row['title'];
							$message = $row['message'];
							$rate = $row['rate'];
							$custID = $row['custID'];

							$query5 = "SELECT * FROM customer WHERE custID='$custID' ";
							$result5 = mysqli_query($dbc,$query5);
							if(mysqli_num_rows($result5) > 0) {
								while ($row = mysqli_fetch_array($result5)) {
									$custName = $row['custName'];
									$custPic =$row['picture'];

									
								}
							}
							echo'<div class="customer-item" itemscope itemtype="http://schema.org/Rating">
							<div class="border">
								<div class="customer">
									<figure>';
									if(!empty($custPic)){echo'<img class="customer-img" src="data:image;base64,'.base64_encode($custPic).'" alt="Customer Picture">';}
										else{echo'<img class="customer-img" src="images/default_profile_picture.png">';}
										echo '<figcaption>
											<span itemprop="author">'.$custName.'</span><br>';
											for($i=0;$i<$rate;$i++){echo '⭐';}												
										echo '</figcaption>
									</figure>
								</div>
								<div class="customer-review">
									<h3 itemprop="description">
										'.$title.'
									</h3>
									<p itemprop="description">
										"'.$message.'"
									</p>
								</div>
							</div>
						</div>
						';
						}
						echo'</div>
						</div>
					</section>';
					}else{
						echo'<section class="testimonial-page">
							<div class="container">
								<main class="customer-review">
									<div class="row">
										
										<div class="rewiew-content">
											<header>
												<p>No Review Yet</p>
											</header>
											
										</div>
									</div>					
								</main>
								
							</div>
						</section>';
					}		
				?>

	
	<?php //validate merchant and admin cannot give review
		if(!isset($_SESSION['merchant_login']) && !isset($_SESSION['admin_login'] )){
			echo '<section class="contact-page-section">
					<div class="container">
						<div class="people-info-wrap">
							<h2>Leave Your Review</h2>
							
							<form action="hotel_rating.php?id='.$id.'" method="POST" >
								<span>
								<input type="text" placeholder="Subject*" class="input- name" name="title">

								<label class="rating-label">
								<strong>Rating</strong>
									<input
										class="rating"
										min="1"
										max="5"
										oninput="this.style.setProperty(';echo"'--value'"; echo', this.value)"
										step="1"
										type="range"
										value="1"
										name="rating">
									</label>						
								</span>
								<textarea name="message" class="input- subject" placeholder="Message*" rows="5" cols="40"></textarea>
								<input type="submit" value="submit">';
						if (isset($_POST['submitted'])) {
							for ($i = 0; $i < count($error); $i++) {
								echo "<p style='color:red;font-size:15px;text-align:center;'>$error[$i]</p>"; //prompt user the error
							}
							for ($i = 0; $i < count($success); $i++) {
								echo "<p style='color:green;font-size:15px;text-align:center;'>$success[$i]</p>"; //prompt user the success message
							}
						}
					echo '<input type="hidden" name="submitted" value="true"/>';
					echo '</form></div>';
		}	
	?>		
			</div>
		</section>
		
	</div>
	</section>
	</script>
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


<?php
    include ('footer.php');
?>