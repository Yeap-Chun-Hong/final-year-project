<?php
require_once ("config.php");
include('header.php');
if(isset($_POST['submitted'])){
    $hotelName = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
	$address = $_POST['address'];
	$register = true;
	$error = array();
	$success = array();
    if(empty($email)){
		array_push($error, "Email address is required!");
		$register = false;
	}else if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
		array_push($error, "Invalid email format!");
		$register = false;
	}

	if(empty($hotelName)){
		array_push($error, "Hotel Name is required!");
		$register = false;
	}
	
	if(empty($phone)){
		array_push($error, "Phone Number is required!");
		$register = false;
	}elseif (!ctype_digit($phone)){
		array_push($error, "Only numbers are allowed in phone!");
		$register = false;
	}
    if(empty($address)){
		array_push($error, "Address is required!");
		$register = false;
	}

	//if no error
    if ($register){
		$insert = "INSERT INTO hotel (hotelName,address,email,phoneNo) VALUES ('$hotelName','$address','$email','$phone')";
		$selectQuery = "SELECT * FROM hotel WHERE email='$email'";
		$check_username = mysqli_query($dbc, $selectQuery);

		if(mysqli_num_rows($check_username)>0){
			array_push($error, "Email that you have enter already exist!");
		}else{
			if (mysqli_query($dbc, $insert)) {
				array_push($success, "Congratulations, you have registered successfully. We will contact you soon.");
                $to_email = $email;
                $subject = "Thank you for registering as merchant";
                $body = "Hi,".$hotelName.". Thank you for joining us in Kuro Hotel Booking Website. We will verified your application soon.";
                $headers = "From: Kuro Hotel Booking Website";
                mail($to_email, $subject, $body,$headers);       
			} else {
				array_push($error, "Database error. Please try again later");
			}
		}
			mysqli_close($dbc);
	}else{
		array_push($error, "Please check again the field.");
	}
	
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Register</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic" >
					<img src="images/merchant.png" alt="IMG">
				</div>

				<form class="login100-form validate-form" action="merchant_register.php" method="post">
					<span class="login100-form-title">
						 Merchant Register
					</span>
                    <div class="wrap-input100 validate-input">
						<input class="input100" type="text" name="email" placeholder="Email">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>
					<div class="wrap-input100 validate-input" >
						<input class="input100" type="text" name="name" placeholder="Hotel Name">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-user-o" aria-hidden="true"></i>
						</span>
					</div>


                    
                    <div class="wrap-input100 validate-input">
						<input class="input100" type="text" name="phone" placeholder="Phone Number">
						<span class="focus-input100"></span>
                        <p style="color:#A9A9A9;font-weight:500;font-size: 14px;">eg: 0123456789</p>
						<span class="symbol-input100"style="padding-bottom:20px;">
							<i class="fa fa-phone" aria-hidden="true"></i>
						</span>
					</div>
                    <div class="wrap-input100 validate-input">
						<input class="input100" type="text" name="address" placeholder="Address">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-address-card-o" aria-hidden="true"></i>
						</span>
					</div>
					
					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Register
						</button>
						<?php
							if (isset($_POST['submitted'])) {
								for ($i = 0; $i < count($error); $i++) {
									echo "<p style='color:red;font-size:15px;text-align:center;'>$error[$i]</p>"; //prompt user the error
								}
								for ($i = 0; $i < count($success); $i++) {
									echo "<p style='color:green;font-size:15px;text-align:center;'>$success[$i]</p>"; //prompt user the success message
								}
							}
						?>
					</div>

                    <div class="text-center p-t-12">
						<a class="txt2" href="merchant_login.php">
							Merchant Login
                            <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
						</a>
					</div>
					<input type="hidden" name="submitted" value="true"/>
				</form>
			</div>
		</div>
	</div>
	
<?php include("footer.php");?>

	
<!--===============================================================================================-->	
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
<!--===============================================================================================-->


