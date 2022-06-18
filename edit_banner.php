<?php
    include('header.php');
    //retrieve admin id from session
    $adminID = $_SESSION['adminID'];

    //retrieve banner details
    $query1 = "SELECT * FROM banner";
    $result =  mysqli_query($dbc,$query1);
    if(mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $bannerID = $row['bannerID'];
            $title = $row['title'];
            $subject = $row['subject'];
            $bannerImage1 = $row['bannerImage1'];
            $bannerImage2 = $row['bannerImage2'];
            $bannerImage3 = $row['bannerImage3'];
        }
    }

    if(isset($_POST['submitted'])){
        $title = $_POST['title'];
        $subject = $_POST['subject'];
        
        $error = array(); //error message
        $success = array(); //success message
        $update = false;

        //data validation
        if (!empty($title)) {
            $query1 = "UPDATE banner SET title ='$title' WHERE bannerID = '$bannerID'";
            mysqli_query($dbc, $query1);
            $update = true;

        }
        if (!empty($subject)) {
            $query2 = "UPDATE banner SET subject ='$subject' WHERE bannerID = '$bannerID'";
            mysqli_query($dbc, $query2);
            $update = true;
        }

        if(!empty($_FILES['img']['tmp_name'])){
            $cover = file_get_contents($_FILES['img']['tmp_name']);
            $cover = mysqli_real_escape_string($dbc,$cover);
            $query = "UPDATE banner SET bannerImage1 ='$cover' WHERE bannerID = '$bannerID'";
            mysqli_query($dbc, $query);
            $update = true;
        }
        if(!empty($_FILES['img2']['tmp_name'])){
            $img2 = file_get_contents($_FILES['img2']['tmp_name']);
            $img2 = mysqli_real_escape_string($dbc,$img2);
            $query = "UPDATE banner SET bannerImage2 ='$img2' WHERE bannerID = '$bannerID'";
            mysqli_query($dbc, $query);
            $update = true;

        }
        if(!empty($_FILES['img3']['tmp_name'])){
            $img3 = file_get_contents($_FILES['img3']['tmp_name']);
            $img3 = mysqli_real_escape_string($dbc,$img3);
            $query = "UPDATE banner SET bannerImage3 ='$img3' WHERE bannerID = '$bannerID'";
            mysqli_query($dbc, $query);
            $update = true;
        }

        if($update){ 
            //update data
            $query = "UPDATE banner SET adminID ='$adminID' WHERE bannerID = '$bannerID'";
            mysqli_query($dbc, $query);

            //prompt success message
            array_push($success,"Banner Updated!");   
        }else{
            //prompt error message if all fields are empty
            array_push($error,"All fields are empty!");   
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

	<title>Edit Banner</title>

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
                        
						<form action="edit_banner.php" method="POST" enctype="multipart/form-data">
							<div class="form-group">
                            <h3>Edit Banner </h3>
							</div>
                            <div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<span class="form-label">Header</span>
                                        <input class="form-control" name="title" type="text" value="<?php echo $title ?>"/>						
                                    </div>
								</div>
							</div>
                            <div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<span class="form-label">Subject</span>
                                        <input class="form-control" name="subject" type="text" value="<?php echo $subject ?>"/>						
                                    </div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<span class="form-label">Cover Image</span>
                                        <input type="file" class="form-control" name="img" accept="image/*" value="">
									</div>
								</div>
                                <div class="col-md-4">
									<div class="form-group">
										<span class="form-label">Banner Image 2</span>
										<input class="form-control" type="file" accept="image/*" name="img2" >
									</div>
								</div>
                                <div class="col-md-4">
									<div class="form-group">
										<span class="form-label">Banner Image 3</span>
										<input class="form-control" type="file" accept="image/*" name="img3" >
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