<?php
include('header.php');

$roomID = $_GET['id'];
$get_room_details = "SELECT * FROM room WHERE roomID='$roomID'";
$result =  mysqli_query($dbc,$get_room_details);
if(mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_array($result)) {
        $roomName = $row['roomName'];
        $roomSize = $row['roomSize'];
        $roomDescription = $row['roomDescription'];
        $price = number_format($row['price'],2);
        $image = $row['image'];
        $roomAvailable =$row['roomAvailable'];
    }
}

if(isset($_POST['submitted'])){
    $roomName = $_POST['name'];
    $roomSize = $_POST['size'];
    $roomDescription = $_POST['desc'];
    $total = $_POST['total'];
    $price = $_POST['price'];

    $error = array();
    $success = array();
    $update = true;

    if(!is_numeric($roomSize)){
        array_push($error, "Only number allowed in Room Size");
		$update = false;
    }else if($roomSize<1){
        array_push($error, "Please enter correct room size.");
		$update = false;
    }

    if(!is_numeric($total)){
        array_push($error, "Only number allowed in Total Room Provided");
		$update = false;
    }else if($total<0){
        array_push($error, "Please enter correct number of rooms provided.");
		$update = false;
    }

    if(!is_numeric($price)){
        array_push($error, "Only number allowed in Price per Night");
		$update = false;
    }else if($price<1){
        array_push($error, "Please enter correct number of price per night.");
		$update = false;
    }

    if($update){
        $price = number_format($_POST['price'],2);
        $query1 = "UPDATE room SET 
        roomName ='$roomName' ,
        roomSize ='$roomSize' ,
        roomDescription ='$roomDescription' ,
        price ='$price' ,
        roomAvailable='$total'
        WHERE roomID = '$roomID'";

        mysqli_query($dbc, $query1);
        if(!empty($_FILES['image']['tmp_name'])){
            $cover = file_get_contents($_FILES['image']['tmp_name']);
            $cover = mysqli_real_escape_string($dbc,$cover);
            $query = "UPDATE room SET image='$cover'WHERE  roomID = '$roomID'";
            mysqli_query($dbc, $query);
        }


        array_push($success,'Room Updated!');
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

	<title>Edit Room</title>

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
                        
						<form action="<?php echo 'edit_room.php?id='.$roomID?>" method="POST" enctype="multipart/form-data">
							<div class="form-group">
                            <h3>Edit Room </h3>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<span class="form-label">Room Name</span>
                                        <input class="form-control" type="text" name="name" value="<?php echo $roomName ?>">
                                    </div>
 								</div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <span class="form-label">Room Size (ft)</span>
                                        <input class="form-control" type="number" min="1" step=".01" name="size"  value="<?php echo $roomSize ?>">							
                                    </div>
								</div>
                            </div>
                            <div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<span class="form-label">Total Room Available</span>
                                        <input class="form-control" type="number" min="0" name="total"  value="<?php echo $roomAvailable ?>">							
                                    </div>
								</div>
                                
                                <div class="col-md-4">
									<div class="form-group">
										<span class="form-label">Price per Night (RM)</span>
                                        <input class="form-control" type="number" min="1.00" step="0.01" name="price" value="<?php echo $price ?>">							
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
                                        <input class="form-control" name="desc" type="text" value="<?php echo $roomDescription ?>"/>					
                                    </div>
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
													echo "<p style='color:red;font-size:16px;text-align:center;'>$error[$i]</p>"; //prompt user the error
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