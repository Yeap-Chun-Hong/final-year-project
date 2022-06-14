<?php
include('header.php');

$adminID = $_SESSION['adminID'];

if(isset($_POST['submitted'])){
    $name = $_POST['name'];
    $post = $_POST['post'];

    $error = array();
    $success = array();
    $add = true;

    if(empty($name)){
		array_push($error, "Name is required!");
		$add = false;
	}else if (!preg_match ("/^[a-zA-Z\s]+$/",$name)){
        array_push($error, "Only alphabets are allowed in name!");
		$add = false;
    }

    if(empty($post)){
		array_push($error, "Post is required!");
		$add = false;
	}

    if(empty($_FILES['image']['tmp_name'])){
        array_push($error, "Image for team member is required");
		$add = false;
    }

    if($add){
        $image = file_get_contents($_FILES['image']['tmp_name']);
        $image = mysqli_real_escape_string($dbc,$image);
        $insert = "INSERT INTO team (id,name,post,img) 
                    VALUES ('','$name','$post','$image')";
        mysqli_query($dbc, $insert);
        array_push($success, "Team Member Added!");
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

	<title>Add Team Members</title>

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
                            <form action="add_team.php" method="POST" enctype="multipart/form-data">
                       							
						 <div class="form-group">
                            <h3>Add Team Members </h3>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<span class="form-label">Name</span>
                                        <input class="form-control" type="text" name="name" value="">
                                    </div>
 								</div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <span class="form-label">Post</span>
                                        <input class="form-control" type="text" name="post" value="" >							
                                    </div>
								</div>
                            </div>
                            <div class="row">

                                <div class="col-md-3">
									<div class="form-group">
										<span class="form-label">Image</span>
                                        <input class="form-control" type="file" accept="image/*" name="image" >							
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