<?php
require_once ("config.php");
include('header.php');
if(isset($_POST['submitted'])){
    $name = $_POST['name'];
	$username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
	$password = $_POST['password'];
    $confirm = $_POST['re-password'];
	$register = true;
	$error = array();
	$success = array();

	$name=str_replace(" ", "", $name);
	if(empty($name)){
		array_push($error, "Name is required.");
		$register = false;
	}else if (!ctype_alpha($name)){
        array_push($error, "Only alphabets are allowed in name.");
		$register = false;
    }
	
	if(empty($username)){
		array_push($error, "Username is required.");
		$register = false;
	}

    if(empty($email)){
		array_push($error, "Email address is required.");
		$register = false;
	}else if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
		array_push($error, "Invalid email format.");
		$register = false;
	}
	
	if(empty($phone)){
		array_push($error, "Phone Number is required.");
		$register = false;
	}elseif (!ctype_digit($phone)){
		array_push($error, "Only numbers are allowed in phone.");
		$register = false;
	}

    if(empty($password)){
		array_push($error, "Password is required.");
		$register = false;
	}else if(strlen($password)<8){
		array_push($error, "Your password must contain at least 8 characters!");
		$register = false;
	}elseif(!preg_match("#[0-9]+#",$password)) {
		array_push($error, "Your password must contain at least 1 number!");
		$register = false;
    }
    elseif(!preg_match("#[A-Z]+#",$password)) {
		array_push($error, "Your password must contain at least 1 capital letter!");
		$register = false;
    }
    elseif(!preg_match("#[a-z]+#",$password)) {
		array_push($error, "Your password must contain at least 1 lowercase letter!");
		$register = false;
    }
	
	if(empty($confirm)){
		array_push($error, "Confirm Password is required.");
		$register = false;
	}else if($confirm != $password){
		array_push($error, "Confirm Password not matched!");
		$register = false;
	}

	//if no error
	if ($register){
		$insert = "INSERT INTO customer (username,password,custName,email,hpNo) VALUES ('$username','$password','$name','$email','$phone')";
		$selectQuery = "SELECT * FROM customer WHERE username='$username'";
		$check_username = mysqli_query($dbc, $selectQuery);

		if(mysqli_num_rows($check_username)>0){
			array_push($error, "Username that you have enter already exist!");
		}else{
			if (mysqli_query($dbc, $insert)) {
				array_push($success, "Congratulations, you have registrated successfully.");
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
	<title>Login V1</title>
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
					<img src="images/img-01.png" alt="IMG">
				</div>

				<form class="login100-form validate-form" action="customer_register.php" method="post">
					<span class="login100-form-title">
						 Register
					</span>

					<div class="wrap-input100 validate-input" >
						<input class="input100" type="text" name="name" placeholder="Full Name">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-user-o" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input">
						<input class="input100" type="text" name="username" placeholder="Username" >
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-user-circle-o" aria-hidden="true"></i>
						</span>
					</div>
                    <div class="wrap-input100 validate-input">
						<input class="input100" type="text" name="email" placeholder="Email">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>
                    <div class="wrap-input100 validate-input">
						<input class="input100" type="text" name="phone" placeholder="Phone Number">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-phone" aria-hidden="true"></i>
						</span>
					</div>
                    <div class="wrap-input100 validate-input">
						<input class="input100" type="password" name="password" placeholder="Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100" style="padding-bottom:50px;">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
						<p style="color:#A9A9A9;font-weight:500;font-size: 11px;">Passwords must contain at least eight characters, including at least 1 capital, 1 lowercase letter and 1 number.</p>
					</div>
					<div></div>
                    <div class="wrap-input100 validate-input">
						<input class="input100" type="password" name="re-password" placeholder="Confirm Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
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

					<div class="text-center p-t-10">
						<a class="txt2" href="#">
							Already Signed Up? Log In Here
							<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
						</a>
					</div>

                    <div class="text-center p-t-12">
						<a class="txt2" href="#">
							Merchant Register
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


