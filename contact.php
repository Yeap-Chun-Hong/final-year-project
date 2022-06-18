<?php
	require_once ("config.php");
	include('header.php');

	if (isset($_SESSION['login'])) {
		$custID = $_SESSION['custID'];
		//fetch user details from customer table
		$query = "SELECT * FROM customer WHERE custID = '$custID' ";
		$result = mysqli_query($dbc, $query);

		if (mysqli_num_rows($result) > 0) {
			while ($row = mysqli_fetch_array($result)) {
				$name = $row['custName'];
				$email = $row['email'];
			}
		}
	}

	if(isset($_POST['submitted'])){
		$name = $_POST['name'];
		$email = $_POST['email'];
		$subject = $_POST['subject'];
		$message = $_POST['message'];
		$error = array();
		$success = array();
		$send = true;

		//data validation
		if(empty($name)){
			array_push($error, "Name is required!");
			$send = false;
		}
		if(empty($email)){
			array_push($error, "Email is required!");
			$send = false;
		}else if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
			array_push($error, "Invalid email format!");
			$send = false;
		}
		if(empty($subject)){
			array_push($error, "Subject is required!");
			$send = false;
		}
		if(empty($message)){
			array_push($error, "Message is required!");
			$send = false;
		}

		if($send){
			//insert into database
			$insert = "INSERT INTO feedback (feedbackID,custName,email,subject,message) 
			VALUES ('','$name','$email','$subject','$message')";
			mysqli_query($dbc, $insert);

			//send email to customer
			array_push($success, "Thank you for giving us feedback. We will review it soon.");
			$to_email = $email;
			$subject = "Thank you for Contacting Us!";
			$body = "Hi,".$name.". Thank you for contacting us:
			\n\tTitle: ".$subject."
			\n\tMessage: ".$message.
			"\n\nNote: We will review your feedback soon.";
			$headers = "From: Kuro Hotel Booking Website";
			mail($to_email, $subject, $body,$headers);  

			//close database
			mysqli_close($dbc);
		}

	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Contact Us</title>
	<meta name="viewport" content="width=device-width">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
	<section class="contact-page-section">
		<div class="container">
			<div class="people-info-wrap">
				<h2>leave us your feedback</h2>
				<p>Send the problem that you have face or give us the command that you need to tell us.</p>

				<form action="contact.php" method="post">
					<span>
					<input type="name" placeholder="Enter your name*" name="name" value="<?php echo isset($name)?$name:''?>" class="input- name">
					<input type="email" placeholder="Email*" name="email" value="<?php echo isset($email)?$email:''?>" class="input- email">
					</span>
					<input type="subject" placeholder="Subject*" name="subject" value="" class="input- subject">
					<textarea placeholder="Messages*" rows="4" cols="50" name="message" class="input-">
					</textarea>
					<input type="submit" value="submit now">
					<input type="hidden" name="submitted" value="true"/>
				</form>
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
	</section>

	<section class="contact-page-section">
		<div class="container">
			<div class="people-info-wrap">
				<h2>Find us at Inti International College Penang</h2>
			</div>
	</section>
	
	<section class="map-section">
		<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3972.491988724782!2d100.27968201471244!3d5.3416037961252725!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x304ac048a161f277%3A0x881c46d428b3162c!2sINTI%20International%20College%20Penang!5e0!3m2!1sen!2snp!4v1655137844681!5m2!1sen!2snp" width="100%" height="500" frameborder="0" style="border:0" allowfullscreen></iframe>
	</section>
	</div>
	<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
	<script type="text/javascript" src="js/lightbox.js"></script>
	<script type="text/javascript" src="js/all.js"></script>
	<script type="text/javascript" src="js/isotope.pkgd.min.js"></script>
	<script type="text/javascript" src="js/owl.carousel.js"></script>
	<script type="text/javascript" src="js/jquery.flexslider.js"></script>
	<script type="text/javascript" src="js/jquery.rateyo.js"></script>
	<script type="text/javascript" src="js/jquery.mmenu.all.js"></script>
	<script type="text/javascript" src="js/custom.js"></script>
<?php
include('footer.php');
?>