<?php
include('header.php');
$custID = $_GET['id']; //retrieve customer id
?>
	<link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
    
    <title>Booking History</title>
    <section class="ftco-section">
		<div class="container">
		<h3>Booking History</h3>
			<div class="row">
				<div class="col-md-12">
					<div class="table-wrap">
						<table class="table" data-toggle="table" id="table" data-pagination="true">
						  <thead class="thead-primary">
						    <tr>
						    	<th>Booking ID</th>
						    	<th>Hotel Name</th>
								<th>Room Type</th>
                                <th>Booking Date</th>
								<th>Check-In Date</th>
								<th>Check-Out Date</th>
								<th>Status</th>
                                <th></th>
						    </tr>
						  </thead>
						  <tbody>
								<?php 
									//fetch booking data which is booked by the customer
									$query3 = "SELECT * FROM booking WHERE custID='$custID' ORDER BY bookingID DESC ";
									$result3 = mysqli_query($dbc,$query3);
									if(mysqli_num_rows($result3) > 0) {
										while ($row = mysqli_fetch_array($result3)) {
											$bookingID = $row['bookingID'];
											$bookingDate = $row['bookingDate'];
											$bookingTime = $row['time'];
											$checkInDate = $row['checkInDate'];
											$checkOutDate = $row['checkOutDate'];
											$status = $row['status'];
											$hotelID = $row['hotelID'];
											$roomID = $row['roomID'];

											//get hotel details
											$get_hotel = "SELECT * FROM hotel WHERE hotelID='$hotelID' ";
											$result = mysqli_query($dbc,$get_hotel);
											while ($row = mysqli_fetch_array($result)) {
												$hotelName = $row['hotelName'];
											}

											//get room details
											$get_room = "SELECT * FROM room WHERE roomID='$roomID' ";
											$result = mysqli_query($dbc,$get_room);
											while ($row = mysqli_fetch_array($result)) {
												$roomName = $row['roomName'];
											}

											echo'<tr class="alert" role="alert"> <td>#B'.str_pad($bookingID, 4, '0', STR_PAD_LEFT).'</td>'; //format booking id to #B000x
											echo'<td>'.$hotelName.'</td>
											<td>'.$roomName.'</td>
											<td>'.$bookingDate.' '.$bookingTime.'</td>
											<td>'.$checkInDate.'</td>
											<td>'.$checkOutDate.'</td>
											<td>'.$status.'</td>
											<td><a href="checkout.php?id='.$bookingID.'">Show Details</a></td>
									</tr>';
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