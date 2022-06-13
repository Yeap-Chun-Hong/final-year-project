<?php
    date_default_timezone_set("Asia/Kuala_Lumpur");

    include ('header.php');
    $hotelID = $_GET['hotelid'];
    $roomID = $_GET['roomid'];
	if(!$_SESSION['login']){
        header('Location: login.php');
		exit();	
	}

    $query1 = "SELECT * FROM hotel WHERE hotelID='$hotelID'";
    $result =  mysqli_query($dbc,$query1);
    if(mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
			$hotelName = $row['hotelName'];
        }
    }

    $query2 = "SELECT * FROM room WHERE roomID='$roomID'";
    $result2 =  mysqli_query($dbc,$query2);
    if(mysqli_num_rows($result2) > 0) {
        while ($row = mysqli_fetch_array($result2)) {
			$roomName = $row['roomName'];
            $roomPrice =$row['price'];
			$roomAvailable = $row['roomAvailable'];
        }
    }

    if(isset($_POST['submitted'])){
        $bookingDate = date("Y-m-d");
        $bookingTime = date("H:i:s");
        $custID = $_SESSION['custID'];
        $checkInDate = $_POST['checkin'];
		$checkOutDate = $_POST['checkout'];
        $adult = $_POST['adult'];
        $children = $_POST['children'];
        $numRoom = $_POST['num_room'];
		$error = array();
		$booking = true;
		if($checkInDate < $bookingDate || $checkOutDate < $bookingDate){
			array_push($error, "Check-In/Out date should not be earlier than today.");
			$booking = false;
		}
		if($checkOutDate < $checkInDate){
			array_push($error, "Check-out date should not be earlier than check-in date.");
			$booking = false;
		}
		if($adult <= 0){
			array_push($error, "Please enter proper number of adults.");
			$booking = false;
		}
		if($children < 0){
			array_push($error, "Please enter proper number of children.");
			$booking = false;
		}
		if($numRoom < 1){
			array_push($error, "Please enter proper number of room.");
			$booking = false;
		}else if($numRoom > $roomAvailable){
			array_push($error, "Please enter proper number of room.");
			$booking = false;
		}
		if($booking){
			$insert = "INSERT INTO booking (bookingID,bookingDate,checkInDate,checkOutDate,time,room,adult,children,price,payment,status,custID,hotelID,roomID) 
			VALUES ('','$bookingDate','$checkInDate','$checkOutDate','$bookingTime','$numRoom','$adult','$children','','-','New','$custID','$hotelID','$roomID')";
			mysqli_query($dbc, $insert);

			$getBookingID = "SELECT * FROM booking WHERE hotelID='$hotelID' &&custID='$custID' && roomID='$roomID' ORDER BY bookingID DESC LIMIT 1  ";
			$result =  mysqli_query($dbc,$getBookingID);
			if(mysqli_num_rows($result) > 0) {
			while ($row = mysqli_fetch_array($result)) {
				$bookingID = $row['bookingID'];
			}
			header('Location: checkout.php?id='.$bookingID);
				exit();
			}
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

	<title>Booking Form HTML Template</title>

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
						<form action="<?php echo 'booking.php?hotelid='.$hotelID.'&roomid='.$roomID ?>" method="POST">
							<div class="form-group">
                            <h3>Confirm Booking </h3>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<span class="form-label">Hotel Name</span>
                                        <input class="form-control" type="text" disabled value="<?php echo $hotelName ?>">
						
                                    </div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<span class="form-label">Room Type</span>
                                        <input class="form-control" type="text" disabled value="<?php echo $roomName ?>">							
                                    </div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-3">
									<div class="form-group">
										<span class="form-label">Check-In Date</span>
										<input class="form-control" type="date" name="checkin" min="<?= date('Y-m-d'); ?>" required>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<span class="form-label">Check-Out Date</span>
										<input class="form-control" type="date" name="checkout" min="<?= date('Y-m-d'); ?>" required>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<span class="form-label">Adults (18+)</span>
                                        <input type="number" name="adult" class="quantity form-control input-number"  value="1" min="1" max="100" step="1">
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<span class="form-label">Children (0-17)</span>
                                        <input type="number" name="children" class="quantity form-control input-number"  value="0" min="0" max="100" step="1">
									</div>
								</div>
                                <div class="col-md-2">
									<div class="form-group">
										<span class="form-label">Number of Room</span>
                                        <input type="number" name="num_room" class="quantity form-control input-number"  value="1" min="1" max="<?php echo $roomAvailable?>" step="1">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-3">
									<div class="form-btn">
										<button class="submit-btn">Check Out</button>
									</div>
									
									</div>
								</div>
								<?php
											if (isset($_POST['submitted'])) {
												for ($i = 0; $i < count($error); $i++) {
													echo "<p style='color:red;font-size:16px;text-align:center;'>$error[$i]</p>"; //prompt user the error
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
    include ('footer.php');
?>