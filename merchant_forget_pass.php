<?php
require_once ("config.php");
include('header.php');
if(isset($_POST['submitted'])){
	$email = $_POST['email'];
	$forget = true;
	$error = array();
    $success = array();

	if(empty($email)){
		array_push($error, "Email is required.");
		$forget = false;
	}
	

	if($forget){
		$query = "SELECT * FROM hotel WHERE email = '$email'";
		$result = mysqli_query($dbc,$query);

		if(mysqli_num_rows($result) > 0){
			while ($row = mysqli_fetch_array($result)){
                $id = $row['hotelID'];
				$name = $row['hotelName'];
				$email = $row['email'];
			}
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $password = '';
            for ($i = 0; $i < 10; $i++) {
                $password .= $characters[rand(0, $charactersLength - 1)];
            }
            $encrypted_pw=base64_encode($password);
            array_push($success, "we have sent an email with the instruction to reset your password.");
            $to_email = $email;
            $subject = "Reset Password";
            $body = "Hi,".$name.". Please use the following OTP to login and reset your password
                    \n".$password.
                    "\n\nReminder: Please do not give the password to anyone.";
            $headers = "From: Kuro Hotel Booking Website";
            mail($to_email, $subject, $body,$headers); 
            
            $otp = "UPDATE hotel SET password ='$encrypted_pw' WHERE hotelID = '$id'";
            mysqli_query($dbc, $otp);
		} else{
			array_push($error, "Invalid credentials.");
		}
		mysqli_close($dbc);
	}
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Forget Password</title>
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

				<form class="login100-form validate-form" action="merchant_forget_pass.php" method="post">
					<span class="login100-form-title">
						 Forget Password
					</span>

                    <div class="wrap-input100 validate-input">
						<input class="input100" type="email" name="email" placeholder="Email">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>
					
					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Submit
						</button>
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

					<div class="text-center p-t-10">
						<a class="txt2" href="merchant_register.php">
							Join Us Now
							<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
						</a>
					</div>
					<div class="text-center p-t-10">
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


