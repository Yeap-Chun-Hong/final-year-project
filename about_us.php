<?php
include ('header.php');
$user = 0;
$hotel = 0;
$get_about_details = "SELECT * FROM aboutus ";
$result =  mysqli_query($dbc,$get_about_details);
if(mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_array($result)) {
        $desc = $row['description'];
    }
}

$get_user = "SELECT * FROM customer ";
$result =  mysqli_query($dbc,$get_user);
if(mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_array($result)) {
        $user++;
    }
}

$get_hotel = "SELECT * FROM hotel ";
$result =  mysqli_query($dbc,$get_hotel);
if(mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_array($result)) {
        $hotel++;
    }
}
?>
<title>About Us</title>
    <link rel="stylesheet" type="text/css" href="css/about_us.css">
<section class="about-upper-section" itemprop="mainContentofPage">
			<div class="container">
				<article class="who-we-are">
					<h2 class="top-heading">About Us <?php echo isset($_SESSION['admin_login'])?'<a href="edit_about.php" style="font-size:15px;">Edit</a>':'' ?> </h2>
					<p><?php echo $desc?></p>
				</article>
				<div class="our-story">
					<h2 class="top-heading">our story</h2>
					<ul>
						<li><i class="fas fa-users"></i> <?php echo $user?> customer enrolled</li>
						<li><i class="fas fa-home"></i> <?php echo $hotel?> Merchant Joined</li>

						<!-- For None link use below -->
						<!-- <li><i class="fas fa-chalkboard-teacher"></i> <p>60+ certified teachers</p></li>
						<li><i class="fas fa-graduation-cap"></i>  <p>600+ students enrolled</p></li>
						<li><i class="fas fa-book-open"></i>  <p>50+ courses completed</p></li>
						<li><i class="fas fa-users"></i>  <p>10000+ foreign followers</p></li> -->
					</ul>
				</div>
			</div>
		</section>

		<section class="team-members" itemprop="contributor">
			<div class="container">
				<h2 class="top-heading">meet our team <?php echo isset($_SESSION['admin_login'])?'<a href="add_team.php" style="font-size:15px;">Add Team Members</a>':'' ?></h2>
				<article class="developer-grid">
					<div class="row">
                    <?php
                    $get_team_details = "SELECT * FROM team";
                    $result =  mysqli_query($dbc,$get_team_details);
                    $i=0;
                    if(mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_array($result)) {
                            $i++;
                            $memberID = $row['id'];
                            $name = $row['name'];
                            $post = $row['post'];
                            $image = $row['img'];

                            echo '<div class="col-md-4 col-sm-4">
                                    <div class="box">
                                        <img src="'.'data:image;base64,'.base64_encode($image).'">
                                        <div class="box-content">
                                            <h3 class="name">'.$name.'</h3>
                                            <span class="post">'.$post.'</span>';
                                            if(isset($_SESSION['admin_login'])){
                                                echo '<a href="edit_team.php?id='.$memberID.'" style="font-size:15px;">Edit Team Member</a><br>';
                                                echo '<a href="delete_team.php?id='.$memberID.'" style="font-size:15px;">Delete</a>';
                                            }
                                        echo'</div>
                                    </div>
                                </div>';
                                if($i == 1){
                                    echo' <div class="col-md-4 col-sm-4">
                                    <div class="box">
                                    </div>
                                </div>
                                </div>';
                                }
                            
                        }
                    }
                    ?>
        
                    </div>

					
				</article>
			</div>
		</section>
<?php
include ('footer.php');
?>