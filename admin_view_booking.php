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
	<title>Manage Bookings</title>
	<section class="page-content" id="course-page">
		<div class="container">
			<h3>Manage Bookings</h3>
			<a href="generate_booking_report.php">Export to Excel</a>
			<section class="ftco-section">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<div class="table-wrap">
								<table class="table" data-toggle="table" id="table" data-pagination="true">
									<thead class="thead-primary">
										<tr>
											<th>Booking ID</th>
											<th>Customer Name</th>
											<th>Customer Contact Number</th>
											<th>Booking Date</th>
											<th>Check-In Date</th>
											<th>Check-Out Date</th>
											<th>Status</th>
											<th>Show Details</th>
											<th>Delete</th>
										</tr>
									</thead>
									<tbody>
										<?php 
										//fetch all booking data
											$query3 = "SELECT * FROM booking";
											$result3 = mysqli_query($dbc,$query3);
											if(mysqli_num_rows($result3) > 0) {
												while ($row = mysqli_fetch_array($result3)) {
													$bookingID = $row['bookingID'];
													$bookingDate = $row['bookingDate'];
													$bookingTime = $row['time'];
													$checkInDate = $row['checkInDate'];
													$checkOutDate = $row['checkOutDate'];
													$status = $row['status'];
													$custID = $row['custID'];

													//get customer details
													$get_cust = "SELECT * FROM customer WHERE custID='$custID' ";
													$result = mysqli_query($dbc,$get_cust);
													while ($row = mysqli_fetch_array($result)) {
														$custName = $row['custName'];
														$cust_contact = $row['hpNo'];
													}

													echo'<tr class="alert" role="alert"> <td>#B'.str_pad($bookingID, 4, '0', STR_PAD_LEFT).'	</td>'; //format booking id to #B000x
													echo'<td>'.$custName.'</td>
													<td>'.$cust_contact.'</td>
													<td>'.$bookingDate.' '.$bookingTime.'</td>
													<td>'.$checkInDate.'</td>
													<td>'.$checkOutDate.'</td>
													<td>'.$status.'</td>';
													echo '<td><a href="checkout.php?id='.$bookingID.'">Show Details</a></td>';
													echo '<td><a href="delete_booking.php?id='.$bookingID.'">Delete</a></td>';
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
			});
		});
			</script>

<?php
include('footer.php');
?>