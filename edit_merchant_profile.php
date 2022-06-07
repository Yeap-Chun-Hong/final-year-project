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

    if(isset($_POST['submitted'])){
        $name = $_POST['name'];
        $address = $_POST['address'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $desc = $_POST['desc'];
        $checkInTime = $_POST['check-in'];
        $checkOutTime = $_POST['check-out'];

        $error = array();
        $success = array();
        $update = true;

        if($update){
            $query1 = "UPDATE hotel SET 
                    hotelName ='$name' ,
                    checkInTime ='$checkInTime' ,
                    checkOutTime ='$checkOutTime' ,
                    address ='$address' ,
                    email ='$email' ,
                    phoneNo ='$phone' ,
                    description ='$desc' 
                   
            WHERE hotelID = '{$_SESSION['hotelID']}'";
            mysqli_query($dbc, $query1);
            if(isset($_POST['facilities'])){
                if(in_array('Free Wi-Fi', $_POST['facilities'])){
                    $query = "UPDATE hotel SET hv_wifi =true WHERE hotelID = '{$_SESSION['hotelID']}'";
                    mysqli_query($dbc, $query);
                }else{
                    $query = "UPDATE hotel SET hv_wifi =false WHERE hotelID = '{$_SESSION['hotelID']}'";
                    mysqli_query($dbc, $query);
                }
    
                if(in_array('Swimming Pool', $_POST['facilities'])){
                    $query = "UPDATE hotel SET hv_pool =true WHERE hotelID = '{$_SESSION['hotelID']}'";
                    mysqli_query($dbc, $query);
                }else{
                    $query = "UPDATE hotel SET hv_pool =false WHERE hotelID = '{$_SESSION['hotelID']}'";
                    mysqli_query($dbc, $query);
                }
    
                if(in_array('Non-Smoking Room', $_POST['facilities'])){
                    $query = "UPDATE hotel SET hv_nsr =true WHERE hotelID = '{$_SESSION['hotelID']}'";
                    mysqli_query($dbc, $query);
                }else{
                    $query = "UPDATE hotel SET hv_nsr =false WHERE hotelID = '{$_SESSION['hotelID']}'";
                    mysqli_query($dbc, $query);
                }
    
                if(in_array('Parking', $_POST['facilities'])){
                    $query = "UPDATE hotel SET hv_parking =true WHERE hotelID = '{$_SESSION['hotelID']}'";
                    mysqli_query($dbc, $query);
                }else{
                    $query = "UPDATE hotel SET hv_parking =false WHERE hotelID = '{$_SESSION['hotelID']}'";
                    mysqli_query($dbc, $query);
                }
    
                if(in_array('Air Conditioning', $_POST['facilities'])){
                    $query = "UPDATE hotel SET hv_ac =true WHERE hotelID = '{$_SESSION['hotelID']}'";
                    mysqli_query($dbc, $query);
                }else{
                    $query = "UPDATE hotel SET hv_ac =false WHERE hotelID = '{$_SESSION['hotelID']}'";
                    mysqli_query($dbc, $query);
                }
    
                if(in_array('Lift', $_POST['facilities'])){
                    $query = "UPDATE hotel SET hv_lift =true WHERE hotelID = '{$_SESSION['hotelID']}'";
                    mysqli_query($dbc, $query);
                }else{
                    $query = "UPDATE hotel SET hv_lift =false WHERE hotelID = '{$_SESSION['hotelID']}'";
                    mysqli_query($dbc, $query);
                }
            }else{
                $query = "UPDATE hotel SET 
                        hv_lift =false,
                        hv_ac =false,
                        hv_parking =false,
                        hv_nsr =false,
                        hv_pool =false,
                        hv_wifi =false
                        WHERE hotelID = '{$_SESSION['hotelID']}'";
                mysqli_query($dbc, $query);
            }

            
            
            if(!empty($_FILES['image']['tmp_name'])){
                $cover = file_get_contents($_FILES['image']['tmp_name']);
                $cover = mysqli_real_escape_string($dbc,$cover);
                $query = "UPDATE hotel SET image1='$cover'WHERE hotelID = '{$_SESSION['hotelID']}'";
                mysqli_query($dbc, $query);
            }
            if(!empty($_FILES['img2']['tmp_name'])){
                $img2 = file_get_contents($_FILES['img2']['tmp_name']);
                $img2 = mysqli_real_escape_string($dbc,$img2);
                $query = "UPDATE hotel SET image2='$img2'WHERE hotelID = '{$_SESSION['hotelID']}'";
                mysqli_query($dbc, $query);
            }
            if(!empty($_FILES['img3']['tmp_name'])){
                $img3 = file_get_contents($_FILES['img3']['tmp_name']);
                $img3 = mysqli_real_escape_string($dbc,$img3);
                $query = "UPDATE hotel SET image3='$img3'WHERE hotelID = '{$_SESSION['hotelID']}'";
                mysqli_query($dbc, $query);
            }
            array_push($success,"Profile Updated!");   

        }


           
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

	<title>Edit Profile</title>

	<!-- Google font -->
	<link href="https://fonts.googleapis.com/css?family=PT+Sans:400" rel="stylesheet">

	<!-- Bootstrap -->
	<link type="text/css" rel="stylesheet" href="css/booking.min.css" />

	<!-- Custom stlylesheet -->
	<link type="text/css" rel="stylesheet" href="css/booking.css" />

</head>

<body>
	<div id="booking" class="section">
		<div class="section-center">
			<div class="container">
				<div class="row">
                    
					<div class="booking-form">
                        
						<form action="edit_merchant_profile.php" method="POST" enctype="multipart/form-data">
							<div class="form-group">
                            <h3>Edit Hotel Profile </h3>
							</div>
							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<span class="form-label">Hotel Name</span>
                                        <input class="form-control" type="text" name="name" value="<?php echo $name ?>">
                                    </div>
 								</div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <span class="form-label">Address</span>
                                        <input class="form-control" type="text" name="address"  value="<?php echo $address ?>">							
                                    </div>
								</div>
                            </div>
                            <div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<span class="form-label">Email</span>
                                        <input class="form-control" type="email" name="email"  value="<?php echo $email ?>">							
                                    </div>
								</div>
                                <div class="col-md-6">
									<div class="form-group">
										<span class="form-label">Contact Number</span>
                                        <input class="form-control" type="text" name="phone" maxlength="15" value="<?php echo $phone ?>">							
                                    </div>
								</div>
							</div>
                            <div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<span class="form-label">Introduciton</span>
                                        <textarea class="form-control" name="desc" type="text"><?php echo $desc ?></textarea>							
                                    </div>
								</div>
							</div>
                            <div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<span class="form-label">Facilities Provided</span>
                                        <div class="form-checkbox">
                                            <label for="Free Wi-Fi">
                                            <input type="checkbox" id="Free Wi-Fi" name="facilities[]" value="Free Wi-Fi" <?php echo ($hv_wifi)?'checked':'' ?>>
                                            <span></span>Free Wi-Fi
                                            </label>
                                            <label for="Swimming Pool">
                                            <input type="checkbox" id="Swimming Pool" name="facilities[]" value="Swimming Pool" <?php echo ($hv_pool)?'checked':'' ?>>
                                            <span></span>Swimming Pool
                                            </label>
                                            <label for="Non-Smoking Room">
                                            <input type="checkbox" id="Non-Smoking Room" name="facilities[]" value="Non-Smoking Room" <?php echo ($hv_nsr)?'checked':'' ?>>
                                            <span></span>Non-Smoking Room
                                            </label>
                                            <label for="Parking">
                                            <input type="checkbox" id="Parking" name="facilities[]" value="Parking" <?php echo ($hv_parking)?'checked':'' ?>>
                                            <span></span>Parking
                                            </label>
                                            <label for="Air Conditioning">
                                            <input type="checkbox" id="Air Conditioning" name="facilities[]" value="Air Conditioning" <?php echo ($hv_ac)?'checked':'' ?>>
                                            <span></span>Air Conditioning
                                            </label>
                                            <label for="Lift">
                                            <input type="checkbox" id="Lift" name="facilities[]" value="Lift" <?php echo ($hv_lift)?'checked':'' ?>>
                                            <span></span>Lift
                                            </label>
								        </div>
                                    </div>
                                    
								</div>
							</div>
                            <div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<span class="form-label">Check-In Time</span>
                                        <input class="form-control" type="time" name="check-in"  value="<?php echo $checkInTime ?>">							
                                    </div>
								</div>
                                <div class="col-md-6">
									<div class="form-group">
										<span class="form-label">Check-Out Time</span>
                                        <input class="form-control" type="time" name="check-out"  value="<?php echo $checkOutTime ?>">							
                                    </div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<span class="form-label">Cover Image</span>
                                        <input type="file" class="form-control" name="image" accept="image/*" value="">
									</div>
								</div>
                                <div class="col-md-4">
									<div class="form-group">
										<span class="form-label">Hotel Image 1</span>
										<input class="form-control" type="file" accept="image/*" name="img2" >
									</div>
								</div>
                                <div class="col-md-4">
									<div class="form-group">
										<span class="form-label">Hotel Image 2</span>
										<input class="form-control" type="file" accept="image/*" name="img3" >
									</div>
								</div>
							<div class="row">
								<div class="col-md-3">
									<div class="form-btn">
										<button class="submit-btn">Update</button>
									</div>
									
									</div>
								</div>
								<?php
											if (isset($_POST['submitted'])) {
												for ($i = 0; $i < count($error); $i++) {
													echo "<p style='color:red;font-size:16px;'>$error[$i]</p>"; //prompt user the error
												}
                                                for ($i = 0; $i < count($success); $i++) {
                                                    echo "<p style='color:green;font-size:15px;text-align:center;'>$success[$i]</p>"; //prompt user the success message
                                                }
											}
										?>
							</div>
							<input type="hidden" name="submitted" value="true"/>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>

</html>
<?php
include('footer.php');
?>