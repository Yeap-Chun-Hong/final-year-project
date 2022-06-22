<?php
include('header.php');
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
						    	<th>Feedback ID</th>
						    	<th>Customer Name</th>
								<th>Customer Email</th>
                                <th>Subject</th>
								<th>Message</th>
                                <th></th>
						    </tr>
						  </thead>
						  <tbody>
								<?php 
									//fetch booking data which is booked by the customer
									$query3 = "SELECT * FROM feedback";
									$result3 = mysqli_query($dbc,$query3);
									if(mysqli_num_rows($result3) > 0) {
										while ($row = mysqli_fetch_array($result3)) {
											$feedbackID = $row['feedbackID'];
											$custName = $row['custName'];
											$email = $row['email'];
											$subject = $row['subject'];
											$message = $row['message'];
										

											echo'<tr class="alert" role="alert"> <td>#F'.str_pad($feedbackID, 4, '0', STR_PAD_LEFT).'</td>'; //format booking id to #B000x
											echo'<td>'.$custName.'</td>
											<td>'.$email.'</td>
											<td>'.$subject.'</td>
											<td style="text-overflow: ellipsis; ">'.$message.'</td>
											<td><a href="reply_details.php?id='.$feedbackID.'">Reply</a></td>
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