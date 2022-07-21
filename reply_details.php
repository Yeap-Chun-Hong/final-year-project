<?php
	require_once ("config.php");
	include('header.php');
    $feedbackID = $_GET['id'];


    $query = "SELECT * FROM feedback WHERE feedbackID = '$feedbackID' ";
    $result = mysqli_query($dbc, $query);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $name = $row['custName'];
            $email = $row['email'];
            $subject = $row['subject'];
        }
    }

	if(isset($_POST['submitted'])){
		$subject = $_POST['subject'];
		$message = $_POST['message'];
		$error = array();
		$success = array();
		$send = true;

		//data validation
		if(empty($subject)){
			array_push($error, "Subject is required!");
			$send = false;
		}
		if(empty($message)){
			array_push($error, "Message is required!");
			$send = false;
		}

		if($send){
			//send email to customer
			array_push($success, "Reply Successful.");
			$to_email = $email;
			$subject = $subject;
			$body = $message;
			$headers = "From: Kuro Hotel Booking Website";
			mail($to_email, $subject, $body,$headers);  

		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Reply</title>
	<meta name="viewport" content="width=device-width">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
	<section class="contact-page-section">
		<div class="container">
			<div class="people-info-wrap">
				<h2>Reply to customer's feedback</h2>
				<p>Note: Please reply in a manner attitude.</p>

				<form action="<?php echo "reply_details.php?id=".$feedbackID ?>" method="post">
					<span>
					<input type="name" placeholder="Customer Name" name="name" value="<?php echo $name ?>" class="input- name" disabled>
					<input type="email" placeholder="Customer Email*" name="email" value="<?php echo $email?>" class="input- email" disabled>
					</span>
					<input type="subject" placeholder="Reply Subject*" name="subject" value="RE: <?php echo $subject?>" class="input- subject">
					<textarea placeholder="Reply Messages*" rows="4" cols="50" name="message" class="input-" required></textarea>
					<input type="submit" value="reply">
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