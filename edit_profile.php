<?php
require_once ("config.php");
include('header.php');


//handle the form
if (isset($_POST['submitted'])) {
    $name = $_POST['name'];
	$username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
	$password = $_POST['password'];
    $confirm = $_POST['confirm'];

    $success = array();
    $error = array();
    $update = true;

   $selectQuery = "SELECT * FROM customer WHERE username='$username'";
   $check_username = mysqli_query($dbc, $selectQuery);
    
    if (empty($name) && empty($username) && empty($email) && empty($phone) && empty($password) && empty($confirm) && empty($_FILES['image']['tmp_name']) ) {
        $update = false;
        array_push($error, "All fields are empty. Please input at least 1 credential to complete the update process!");
    } else if(mysqli_num_rows($check_username)>0){
        array_push($error, "Username that you have enter already exist!");
        $update = false;
    }
    else {
        //sql query
        $query1 = "UPDATE customer SET custName ='$name' WHERE custID = '{$_SESSION['custID']}'";
        $query2 = "UPDATE customer SET username ='$username' WHERE custID = '{$_SESSION['custID']}'";
        $query3 = "UPDATE customer SET email ='$email' WHERE custID = '{$_SESSION['custID']}'";
        $query4 = "UPDATE customer SET hpNo ='$phone' WHERE custID = '{$_SESSION['custID']}'";
        $query5 = "UPDATE customer SET password ='$password' WHERE custID = '{$_SESSION['custID']}'";

        if($update){

            if (!empty($name)) {
                if (preg_match("/^[a-zA-Z-\s']*$/", $name)) {
                    mysqli_query($dbc, $query1);
                    array_push($success, "Name updated.");
                } else {
                    $update = false;
                    array_push($error, "Only alphabets are allowed in name!");
                }
            }

            if (!empty($username)) {
                mysqli_query($dbc, $query2);
                array_push($success, "Username updated!");
            }

            if (!empty($email)) {
                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    mysqli_query($dbc, $query3);
                    array_push($success, "Email updated!");
                } else {
                    $update = false;
                    array_push($error, "Invalid email format!");
                }
            }

            if(!empty($phone)){
                if (ctype_digit($phone)) {
                    mysqli_query($dbc, $query4);
                    array_push($success, "Phone updated!");
                } else {
                    $update = false;
                    array_push($error, "Only numbers are allowed in phone!");
                }
            }

            if (!empty($password)) {
                if (strlen($password) >= 8) {
                    if (preg_match("#[0-9]+#",$password) && preg_match("#[A-Z]+#",$password) && preg_match("#[a-z]+#",$password)) {
                        if ($password == $confirm) {
                            mysqli_query($dbc, $query5);
                            array_push($success, "Password updated!");
                        } else {
                            array_push($error, "Confirm Password not matched!");
                        }
                    } else {
                        array_push($error, "Passwords must contain at least eight characters, including at least 1 capital letter, 1 lowercase letter and 1 numberQ");
                    }
                } else {
                    array_push($error, "Your password must contain at least 8 characters!");
                }
            }

            if(empty($password) && !empty($confirm)){
                $update = false;
                array_push($error, "Password is required!");
            }


            if(!empty($_FILES['image']['tmp_name'])){
                $data = addslashes(file_get_contents($_FILES['image']['tmp_name']));
                $query6 = "UPDATE customer SET picture ='$data' WHERE custID = '{$_SESSION['custID']}'";
                mysqli_query($dbc, $query6);
                array_push($success,"Image Updated!");

                
            }

        }
    }
}
?>
    <title>Edit Profile</title>
	<link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/edit_profile.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <body>
    <form  action="edit_profile.php" method="post" enctype="multipart/form-data">

    <div class="container rounded bg-white mt-5 mb-5 mr-5" >
        <div class="row">
                <div class="col-md-3 border-right">
                    <?php 
                    if (isset($_SESSION['login'])) {

                        //fetch user details from usertable
                        $query = "SELECT * FROM customer WHERE custID = '{$_SESSION['custID']}'";
                    
                        $result = mysqli_query($dbc, $query);
                    
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_array($result)) {
                                $prev_name = $row['custName'];
                                $prev_username = $row['username'];
                                $prev_email = $row['email'];
                                $prev_phone = $row['hpNo'];
                                $prev_profilePicture = $row['picture'];
                            }
                        }
                    }
                    ?>
                    <div class="d-flex flex-column align-items-center text-center p-3 py-5" style="font-size: 15px;"><img class="mt-5" width="120px" height="120px" src=" <?php echo !empty($prev_profilePicture)?'data:image;base64,'.base64_encode($prev_profilePicture) : 'images/default_profile_picture.png' ?>">
                    <span class="font-weight-bold"><?php echo $prev_name ?></span>
                    <span class="text-black-50"><?php echo $prev_email ?></span>
                    <span class="text-black-50"><?php echo $prev_phone ?></span>

                </div>
            </div>
            <div class="col-md-5 border-right">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4>Profile Settings</h4>
                    </div>
                        <div class="row mt-3">
                            <div class="col-md-12"><label class="labels">Full Name</label><input type="text" class="edit-profile" name="name" value=""></div>
                            <div class="col-md-12"><label class="labels">Username</label><input type="text" class="edit-profile"  name="username" value=""></div>
                            <div class="col-md-12"><label class="labels">Email</label><input type="text" class="edit-profile" name="email" value=""></div>
                            <div class="col-md-12"><label class="labels">Phone Number</label><input type="text" class="edit-profile" name="phone" value=""></div>
                            <div class="col-md-12"><label class="labels">Password</label><input type="password" class="edit-profile" name="password" value=""></div>
                            <div class="col-md-12"><label class="labels">Confirm Password</label><input type="password" class="edit-profile" name="confirm" value=""></div>
                            <div class="col-md-12"><label class="labels">Image</label><input type="file" class="edit-profile" name="image" accept="image/*" value=""></div>
                        </div>
                        
                        <div class="mt-5 text-center"><button class="btn btn-primary btn-lg profile-button" type="submit">Save Profile</button></div>
                        <input type="hidden" name="submitted" value="true"/>
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
            </div>   
        </div>
    </div>
    </form>
<?php
    mysqli_close($dbc); //close database
    include('footer.php');
?>