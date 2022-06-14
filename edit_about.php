<?php
include('header.php');
$adminID = $_SESSION['adminID'];

$details = "SELECT * FROM aboutus ";
$result =  mysqli_query($dbc,$details);
if(mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_array($result)) {
        $desc = $row['description'];
    }
}

if(isset($_POST['submitted'])){
    $desc = $_POST['desc'];

    $error = array();
    $success = array();
    $update = true;

    if(empty($desc)){
        array_push($error,'Introduction is needed!');
        $update = false;
    }

    if($update){
        $query1 = "UPDATE aboutus SET 
        description ='$desc' ,
        adminID ='$adminID' ";

        mysqli_query($dbc, $query1);
        array_push($success,'Introduction Updated!');
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

	<title>Edit About Us</title>

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
                        
						<form action="edit_about.php" method="POST" enctype="multipart/form-data">
							<div class="form-group">
                            <h3>Edit About Us </h3>
							</div>
                            <div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<span class="form-label">Introduciton</span>
                                        <textarea class="form-control" rows="4" cols="50" name="desc" type="text" style="width: 1115px; height: 119px;"><?php echo $desc?></textarea>							
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