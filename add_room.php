<?php
include('header.php');
if(isset($_SESSION['admin_login'])){
    $hotelID = $_GET['id'];
}else{
    $hotelID = $_SESSION['hotelID'];
}
if(isset($_POST['submitted'])){
    $roomName = $_POST['name'];
    $roomSize = $_POST['size'];
    $roomDescription = $_POST['desc'];
    $total = $_POST['total'];
    $price = $_POST['price'];

    $error = array();
    $success = array();
    $add = true;
    if(empty($roomName)){
		array_push($error, "Room Name is required!");
		$add = false;
	}

    if(empty($roomSize)){
		array_push($error, "Room Size is required!");
		$add = false;
	}else if(!is_numeric($roomSize)){
        array_push($error, "Only number allowed in Room Size");
		$add = false;
    }else if($roomSize<1){
        array_push($error, "Please enter correct room size.");
		$add = false;
    }

    if(empty($total)){
		array_push($error, "Total Room Provided is required!");
		$add = false;
	}else if(!is_numeric($total)){
        array_push($error, "Only number allowed in Total Room Provided");
		$add = false;
    }else if($total<0){
        array_push($error, "Please enter correct number of rooms provided.");
		$add = false;
    }

    if(empty($price)){
		array_push($error, "Price per Night is required!");
		$add = false;
	}else if(!is_numeric($price)){
        array_push($error, "Only number allowed in Price per Night");
		$add = false;
    }else if($price<1){
        array_push($error, "Please enter correct number of price per night.");
		$add = false;
    }

    if(empty($_FILES['image']['tmp_name'])){
        array_push($error, "Image for room is required");
		$add = false;
    }

    if($add){
        $price = number_format($price,2);
        $roomSize = number_format($roomSize,2);
        $image = file_get_contents($_FILES['image']['tmp_name']);
        $image = mysqli_real_escape_string($dbc,$image);
        $insert = "INSERT INTO room (roomID,roomName,roomSize,roomDescription,price,image,roomAvailable,hotelID) 
                    VALUES ('','$roomName','$roomSize','$roomDescription','$price','$image','$total','$hotelID')";
        mysqli_query($dbc, $insert);
        array_push($success, "Room Added!");
        mysqli_close($dbc);
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

	<title>Add Room</title>

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
                        
					<?php
                        if(isset($_SESSION['admin_login'])){
                            echo '<form action="add_room.php?id='.$hotelID.'" method="POST" enctype="multipart/form-data">';
                        }else{
                            echo '<form action="add_room.php" method="POST" enctype="multipart/form-data">';
                        }
                         ?>							
						 <div class="form-group">
                            <h3>Add Room </h3>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<span class="form-label">Room Name</span>
                                        <input class="form-control" type="text" name="name" value="">
                                    </div>
 								</div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <span class="form-label">Room Size (ft)</span>
                                        <input class="form-control" type="number" min="1" step=".01" name="size" >							
                                    </div>
								</div>
                            </div>
                            <div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<span class="form-label">Total Room Provided</span>
                                        <input class="form-control" type="number" min="1" name="total"  value="">							
                                    </div>
								</div>
                                
                                <div class="col-md-4">
									<div class="form-group">
										<span class="form-label">Price per Night (RM)</span>
                                        <input class="form-control" type="number" min="1.00" step="0.01" name="price" value="">							
                                    </div>
								</div>
                                <div class="col-md-4">
									<div class="form-group">
										<span class="form-label">Image</span>
                                        <input class="form-control" type="file" accept="image/*" name="image" maxlength="15" >							
                                    </div>
								</div>
							</div>
                            <div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<span class="form-label">Room Description</span>
                                        <input class="form-control" name="desc" type="text" placeholder="eg: 1 extra large bed" value=""/>					
                                    </div>
								</div>
							</div>

                          
							<div class="row">
								<div class="col-md-3">
									<div class="form-btn">
										<button class="submit-btn">Submit</button>
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