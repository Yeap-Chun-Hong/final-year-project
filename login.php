<?php
require_once ("config.php");
include('header.php');
if(isset($_POST['submitted'])){
	//retrieve data from input
	$username = $_POST['username'];
	$password = $_POST['password'];

	//encrypt password
	$password = base64_encode($password);
	$login = true; //boolean to allow login
	$error = array(); //error message

	if(empty($username)){ //Prompt error message if username is empty
		array_push($error, "Username is required.");
		$login = false;
	}
	
	if(empty($password)){  //Prompt error message if password is empty
		array_push($error, "Password is required.");
		$login = false;
	}

	if($login){
		//retrieve data from database
		$query = "SELECT * FROM customer WHERE (email= '$username'||username = '$username') && password = '$password'";
		$result = mysqli_query($dbc,$query);

		if(mysqli_num_rows($result) > 0){
			//start session and retrieve data
			session_start();
			$_SESSION['login'] = true;
			while ($row = mysqli_fetch_array($result)){
				$_SESSION['custID'] = $row['custID'];
				$_SESSION['username'] = $row['username'];
				$_SESSION['password'] = $row['password'];
				$_SESSION['name'] = $row['custName'];
				$_SESSION['email'] = $row['email'];
				$_SESSION['phone'] = $row['hpNo'];
			}

			//redirect user to homepage
			header('Location: index.php');
			exit();
		} else{ // if no data , prompt error message
			array_push($error, "Invalid credentials.");
		}
		//close database
		mysqli_close($dbc);
	}
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login</title>
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

				<form class="login100-form validate-form" action="login.php" method="post">
					<span class="login100-form-title">
						 Login
					</span>

					<div class="wrap-input100 validate-input" >
						<input class="input100" type="text" name="username" placeholder="Username">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-user-circle-o" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input">
						<input class="input100" type="password" name="password" placeholder="Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					
					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Login
						</button>
						<?php
							if (isset($_POST['submitted'])) {
								for ($i = 0; $i < count($error); $i++) {
									echo "<p style='color:red;font-size:16px;text-align:center;'>$error[$i]</p>"; //prompt user the error
								}
							}
						?>
					</div>

					<div class="text-center p-t-12">
						<span class="txt1">
							Forgot
						</span>
						<a class="txt2" href="forget_pass.php">
							Password?
						</a>
					</div>

					<div class="text-center p-t-10">
						<a class="txt2" href="customer_register.php">
							Create your Account
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
