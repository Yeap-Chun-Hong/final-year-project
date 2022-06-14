<?php
include('header.php');

$memberID = $_GET['id'];
$details = "SELECT * FROM team WHERE id='$memberID' ";
$result =  mysqli_query($dbc,$details);
if(mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_array($result)) {
        $name = $row['name'];
        $post = $row['post'];
    }
}

if(isset($_POST['submitted'])){
    $name = $_POST['name'];
    $post = $_POST['post'];

    $error = array();
    $success = array();
    $update = true;

    if (!preg_match ("/^[a-zA-Z\s]+$/",$name)){
        array_push($error, "Only alphabets are allowed in name!");
		$update = false;
    }

    if(!empty($name)){
        $query = "UPDATE team SET name ='$name' WHERE id='$memberID' ";
        mysqli_query($dbc, $query);
    }
    if(!empty($post)){
        $query = "UPDATE team SET post ='$post' WHERE id='$memberID' ";
        mysqli_query($dbc, $query);
    }
    if(!empty($_FILES['image']['tmp_name'])){
        $image = file_get_contents($_FILES['image']['tmp_name']);
        $image = mysqli_real_escape_string($dbc,$image);
        $query = "UPDATE team SET img ='$image' WHERE id='$memberID' ";
        mysqli_query($dbc, $query);
    }

    if($update){
        array_push($success, "Team Member Profile edited!");
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

	<title>Edit Team Member</title>

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
                            <form action="<?php echo 'edit_team.php?id='.$memberID ?>" method="POST" enctype="multipart/form-data">
                       							
						 <div class="form-group">
                            <h3>Edit Team Member</h3>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<span class="form-label">Name</span>
                                        <input class="form-control" type="text" name="name" value="<?php echo $name?>">
                                    </div>
 								</div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <span class="form-label">Post</span>
                                        <input class="form-control" type="text" name="post" value="<?php echo $post?>" >							
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