<?php
include('merchant_header.php');
    $hotelID = $_SESSION['hotelID'];
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
    if(isset($_SESSION['login'])){
        $custID = $_SESSION['custID'];
   
    $query2 = "SELECT * FROM favourite WHERE custID='$custID' && hotelID='$id'";
    $result2 =  mysqli_query($dbc,$query2);

    if(mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result2)) {
            $favID = $row['favID'];
            $hotelID = $row['hotelID'];
        }
    }
}

if($hv_wifi){
	$query = "SELECT * FROM facilities WHERE facID='1' ";
    $result =  mysqli_query($dbc,$query);
    if(mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $facID1 = $row['facID'];
			$facName1 = $row['facName'];
        }
    }
}

if($hv_pool){
	$query = "SELECT * FROM facilities WHERE facID='2' ";
    $result =  mysqli_query($dbc,$query);
    if(mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $facID2 = $row['facID'];
			$facName2 = $row['facName'];
        }
    }
}

if($hv_nsr){
	$query = "SELECT * FROM facilities WHERE facID='3' ";
    $result =  mysqli_query($dbc,$query);
    if(mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $facID3 = $row['facID'];
			$facName3 = $row['facName'];
        }
    }
}

if($hv_parking){
	$query = "SELECT * FROM facilities WHERE facID='4' ";
    $result =  mysqli_query($dbc,$query);
    if(mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $facID4 = $row['facID'];
			$facName4 = $row['facName'];
        }
    }
}

if($hv_ac){
	$query = "SELECT * FROM facilities WHERE facID='5' ";
    $result =  mysqli_query($dbc,$query);
    if(mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $facID5 = $row['facID'];
			$facName5 = $row['facName'];
        }
    }
}

if($hv_lift){
	$query = "SELECT * FROM facilities WHERE facID='6' ";
    $result =  mysqli_query($dbc,$query);
    if(mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $facID5 = $row['facID'];
			$facName6 = $row['facName'];
        }
    }
}
$total=0;
$number_fav = "SELECT * FROM favourite WHERE hotelID='$hotelID' ";
$result1 =  mysqli_query($dbc,$number_fav);
if(mysqli_num_rows($result1) > 0) {
    while ($row = mysqli_fetch_array($result1)) {
        $total ++;
    }
}


?>
<!DOCTYPE html>
	<link rel="stylesheet" type="text/css" href="css/owl.carousel.css">
	<link rel="stylesheet" type="text/css" href="css/owl.theme.default.css">
    <link rel="stylesheet" type="text/css" href="css/lightbox.css">
    <link rel="stylesheet" href="css/love.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	
	<script type="text/javascript" src="js/favourite.js"></script>
	<title><?php echo $name?></title>
<section class="page-content" id="course-page">
			<div class="container">
				<main class="course-detail">
					<h2><?php echo $name .' '.'⭐'.$rating.' '.'('.$totalRating.')'?></h2>
                    <div id="main-content">
                        <div>
                            <p>Favourite by <?php echo $total;?> customer<?php echo ($total>1)? 's':''?></p> 
                           
                            </div>
                            </div>      
					<header>
					<div class="course-box">
                            <a href="<?php echo 'data:image;base64,'.base64_encode($image1)?>" data-lightbox="example-set">
                                <img src=" <?php echo 'data:image;base64,'.base64_encode($image1)  ?>" style="height:175px;">
                            </a>
                            <a href="<?php echo 'data:image;base64,'.base64_encode($image2)?>" data-lightbox="example-set">
                                <img src=" <?php echo 'data:image;base64,'.base64_encode($image2)  ?>" style="height:175px;">
                            </a>
						</div>
                        
						<div class="course-box">
						<a href="<?php echo 'data:image;base64,'.base64_encode($image3)?>" data-lightbox="example-set">
							<img src=" <?php echo 'data:image;base64,'.base64_encode($image3)  ?>"style="height:350px;" >
						</a>
					    </div>

						
					
					</header>
					<article>
						<section class="course-intro">
							<h3>Introduction <a href="edit_merchant_profile.php">Edit Introduction</a></h3>
							<p><?php echo $desc ?></p>
							<h3>Information <a href="edit_merchant_profile.php">Edit Information</a></h3>
							<p>Address: <?php echo $address ?></p>
							<p>Email: <?php echo $email ?></p>
							<p>Contact Number: <?php echo $phone ?></p>
							<p>Check Out Time: <?php echo $checkOutTime ?></p>
							<p>Check In Time: <?php echo $checkInTime ?></p>

						</section>

						<section class="course-objective">
							<h3>Facilities <a href="edit_merchant_profile.php">Edit Facilities</a></h3>
							<ul>
								<?php echo ($hv_wifi)?'<li>'.$facName1.' '.'<i class="fa fa-wifi" aria-hidden="true"></i></li>':'' ?> 
								<?php echo ($hv_pool)?'<li>'.$facName2.' '.'<i class="fas fa-swimming-pool" aria-hidden="true"></i></li>':'' ?> 
								<?php echo ($hv_nsr)?'<li>'.$facName3.' '.'<i class="fa-solid fa-ban-smoking" aria-hidden="true"></i></li>':'' ?> 
								<?php echo ($hv_parking)?'<li>'.$facName4.' '.'<i class="fa-solid fa-car"></i></li>':'' ?> 
								<?php echo ($hv_ac)?'<li>'.$facName5.' '.'<i class="fa fa-snowflake-o"></i></li>':'' ?> 
								<?php echo ($hv_lift)?'<li>'.$facName6.' '.'<i class="fa fa-caret-square-o-up"></i></li>':'' ?> 
								<?php echo ((!$hv_wifi &&!$hv_pool &&!$hv_nsr &&!$hv_parking &&!$hv_ac &&!$hv_lift))?'<li>No facilities provided.</li>':'' ?> 
							</ul>
							<h3>Room <a href="add_room.php">Add Room</a></h3>
							<section class="ftco-section">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="table-wrap">
						<table class="table">
						  <thead class="thead-primary">
						    <tr>
						    	<th></th>
						    	<th>Room Type</th>
								<th>Room Size (ft)</th>
								<th>Price (RM)</th>
								<th>Room Left</th>
								<th>&nbsp;</th>
						    </tr>
						  </thead>
						  <tbody>
								<?php 
								$query3 = "SELECT * FROM room WHERE hotelID='$id'";
								$result3 = mysqli_query($dbc,$query3);
								if(mysqli_num_rows($result3) > 0) {
									while ($row = mysqli_fetch_array($result3)) {
										$roomID = $row['roomID'];
										$roomName = $row['roomName'];
										$roomSize = $row['roomSize'];
										$roomDesc = $row['roomDescription'];
										$price = $row['price'];
										$room_image = $row['image'];
										$roomAvailable = $row['roomAvailable'];
										echo'
										<tr class="alert" role="alert"> <td>	<a href="data:image;base64,'.base64_encode($room_image).'" data-lightbox="example-set">
										<img class="img" src="data:image;base64,'.base64_encode($room_image).'">									
										</a></td>';
										echo'<td>
										<div class="email">
											<span>'.$roomName.' </span>
											<span>'.$roomDesc.' </span>
										</div>
									</td>
									<td>'.$roomSize.'</td>
								<td>'.$price.'</td>
								<td>'.$roomAvailable.'</td>
								<td><a href="edit_room.php?id='.$roomID.'">Edit</a></td></tr>';
									}
								}
								?>
						  </tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</section>

							<h3>Review <a href="merchant_rating.php" class="button">Show More Review</a></h3> 
							</main>		
							<?php 
							$query4 = "SELECT * FROM rating WHERE hotelID='$id' ORDER BY ratingID DESC LIMIT 3 ";
							$result4 = mysqli_query($dbc,$query4);
							if(mysqli_num_rows($result4) > 0) {
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
									echo'<section class="testimonial-page">
									<div class="container">
										<main class="customer-review">
											<div class="row">
												<div class="img" style="width:150px;">';
												if(!empty($custPic)){echo'<img src="data:image;base64,'.base64_encode($custPic).'" alt="Customer Picture">';}
												else{echo'<img src="images/default_profile_picture.png">';}
												echo'</div>
												<div class="rewiew-content">
													<header>
														<h3>'.$title.'</h3>
														<p>'.$message.'</p>
													</header>
													<footer>
														<span><h4>'.$custName.'</h4><br><h4>'; 
														for($i=0;$i<$rate;$i++){echo '⭐';}
													echo'</h4></span></footer>
												</div>
											</div>					
										</main>
										
									</div>
								</section>';
								}
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
							
									
	</div>
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
</body>
</html>

<?php
include('footer.php');
?>