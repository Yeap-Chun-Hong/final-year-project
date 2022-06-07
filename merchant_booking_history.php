<?php
include('merchant_header.php');
$hotelID = $_SESSION['hotelID'];
?>
	<link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
    
    <title>Booking History</title>
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
                                <th></th>
						    </tr>
						  </thead>
						  <tbody>
								<?php 
								$query3 = "SELECT * FROM booking WHERE hotelID='$hotelID' ORDER BY bookingID DESC ";
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


                                        $get_cust = "SELECT * FROM customer WHERE custID='$custID' ";
								        $result = mysqli_query($dbc,$get_cust);
                                        while ($row = mysqli_fetch_array($result)) {
                                            $custName = $row['custName'];
                                            $cust_contact = $row['hpNo'];
                                        }

										echo'
										<tr class="alert" role="alert"> <td>#B'.str_pad($bookingID, 4, '0', STR_PAD_LEFT).'	</td>';
										echo'<td>'.$custName.'</td>
                                        <td>'.$cust_contact.'</td>
                                        <td>'.$bookingDate.' '.$bookingTime.'</td>
                                        <td>'.$checkInDate.'</td>
                                        <td>'.$checkOutDate.'</td>
                                        <td>'.$status.'</td>';
                                        if($status == 'Completed'){echo '<td><a href="checkout.php?id='.$bookingID.'">Show Details</a></td>';}
                                        else{echo'<td></td>';}
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