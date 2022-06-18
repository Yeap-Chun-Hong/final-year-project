<?php
    include('header.php');
    if(isset($_SESSION['admin_login'])){
        $hotelID = $_GET['id']; // if admin login then get hotel id from link
    }else{
        $hotelID = $_SESSION['hotelID']; // if merchant login then get hotel id from session
    }
    
    //fetch hotel data
    $query1 = "SELECT * FROM hotel WHERE hotelID='$hotelID'";
    $result =  mysqli_query($dbc,$query1);
    if(mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $username = $row['username'];
			$active = $row['active'];
        }
    }

    if(isset($_POST['submitted'])){
        $username = $_POST['username'];
        $active_status = $_POST['active_status'];
        $password = $_POST['password'];
        $confirm = $_POST['confirm'];
        //encrypt password
        $encrypted_pw = base64_encode($password);
        
        $error = array();
        $success = array();
        $update = true;

        $query1 = "UPDATE hotel SET username ='$username' WHERE hotelID = '$hotelID'";
        $query2 = "UPDATE hotel SET password ='$encrypted_pw' WHERE hotelID = '$hotelID'";
        $query3 = "UPDATE hotel SET active ='$active_status' WHERE hotelID = '$hotelID'";

        
        //validate data, if not empty then update into database
        if (!empty($username)) {
            mysqli_query($dbc, $query1);
        }

        if (!empty($password)) {
            if (strlen($password) >= 8) {
                if (preg_match("#[0-9]+#",$password) && preg_match("#[A-Z]+#",$password) && preg_match("#[a-z]+#",$password)) {
                    if ($password == $confirm) {
                        mysqli_query($dbc, $query2);
                    } else {
                        array_push($error, "Confirm Password not matched!");
                        $update = false;
                    }
                } else {
                    array_push($error, "Passwords must contain at least eight characters, including at least 1 capital letter, 1 lowercase letter and 1 numberQ");
                    $update = false;
                }
            } else {
                array_push($error, "Your password must contain at least 8 characters!");
                $update = false;
            }
        }

            if(empty($password) && !empty($confirm)){
                $update = false;
                array_push($error, "Password is required!");
            }
            mysqli_query($dbc, $query3);

            if($update){
                array_push($success, "Profile updated!");
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

	<title>Edit Profile</title>

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
                            echo'<form action="edit_merchant_profile.php?id='.$hotelID.'" method="POST" enctype="multipart/form-data">';
                        }else{
                            echo'<form action="edit_merchant_profile.php" method="POST" enctype="multipart/form-data">';                        }
                        ?>
							<div class="form-group">
                            <h3>Edit Merchant Profile </h3>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<span class="form-label">Username</span>
                                        <input class="form-control" type="text" name="username" value="<?php echo $username ?>">
                                    </div>
								</div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
									<div class="form-group">
										<span class="form-label">Status</span>
                                            <div class="form-checkbox">
                                                <label for="active">
                                                    <input type="radio" id="active" name="active_status" value="1" <?php echo $active==1?'checked':''?> >
                                                    <span></span>Active
                                                </label>
                                                <label for="inactive">
                                                    <input type="radio" id="inactive" name="active_status" value="0" <?php echo $active==0?'checked':''?>>
                                                    <span></span>Inactive
                                                </label>
                                            </div>                                    
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <span class="form-label">Password</span>
                                        <input class="form-control" type="password" name="password"  value="">							
                                    </div>
								</div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
									<div class="form-group">
										<span class="form-label">Confirm Password</span>
                                        <input class="form-control" type="password" name="confirm"  value="">							
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