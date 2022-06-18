<?php
include('header.php');
?>
<!DOCTYPE html>
	<link rel="stylesheet" type="text/css" href="css/owl.carousel.css">
	<link rel="stylesheet" type="text/css" href="css/owl.theme.default.css">
    <link rel="stylesheet" type="text/css" href="css/lightbox.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">

	
	<script type="text/javascript" src="js/favourite.js"></script>
	<title>Manage Newly Registered Merchant</title>
	<section class="page-content" id="course-page">
		<div class="container">
			<h3>Manage Newly Registered Merchant</h3>
			<section class="ftco-section">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<div class="table-wrap">
								<table class="table" data-toggle="table" id="table" data-pagination="true">
									<thead class="thead-primary">
										<tr>
											<th>Hotel Name</th>
											<th>Address</th>
											<th>Email</th>
											<th>Contact Number</th>
											<th>Reject</th>
											<th>Approve</th>
										</tr>
									</thead>
									<tbody>
										<?php 
											//fetch the merchant which is newly register and did not been rejected
											$query3 = "SELECT * FROM hotel WHERE approve='0' && rejected_at is NULL";
											$result3 = mysqli_query($dbc,$query3);
											if(mysqli_num_rows($result3) > 0) {
												while ($row = mysqli_fetch_array($result3)) {
													$hotelID = $row['hotelID'];
													$hotelName = $row['hotelName'];
													$hotelAddress = $row['address'];
													$hotelEmail = $row['email'];
													$hotelContact = $row['phoneNo'];

													echo'
													<tr class="alert" role="alert">';
													echo'<td>'.$hotelName.'</td>
													<td>'.$hotelAddress.'</td>
													<td>'.$hotelEmail.'</td>
													<td>'.$hotelContact.'</td>';
													echo '<td><a href="reject.php?id='.$hotelID.'">Reject</a></td>';
													echo '<td><a href="approve.php?id='.$hotelID.'">Approve</a></td>';
													echo'</tr>';
												}
											}
										?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</section>								
		</div>
	</section>

<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
	<script type="text/javascript" src="js/lightbox.js"></script>
	<script type="text/javascript" src="js/all.js"></script>
	<script type="text/javascript" src="js/isotope.pkgd.min.js"></script>
	<script type="text/javascript" src="js/owl.carousel.js"></script>
	<script type="text/javascript" src="js/jquery.flexslider.js"></script>
	<script type="text/javascript" src="js/jquery.rateyo.js"></script>
	<script type="text/javascript" src="js/jquery.mmenu.all.js"></script>
	<script type="text/javascript" src="js/custom.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>    
    <script>
$(document).ready(function () {
    $('#table').DataTable({
        paging: true,
        ordering: true,
        info: true,
        pagelength:5
    });
});
    </script>

<?php
include('footer.php');
?>