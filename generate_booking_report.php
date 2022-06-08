<?php
require_once('config.php');
$hotelID = $_GET['id'];
//excel file name
$fileName = date('Ymd')." Booking_Record.xls";

//column name
$field = array('Booking ID','Customer Name','Customer Contact Number','Booking Date','Booking Time','Check-In Date','Check-Out Date','Status');

//display column name as first row
$excelData = "<table border=1><thead>
<tr>
    <th>Booking ID</th>
    <th>Customer Name</th>
    <th>Customer Contact Number</th>
    <th>Booking Date</th>
    <th>Booking Time</th>
    <th>Check-In Date</th>
    <th>Check-Out Date</th>
    <th>Status</th>
</tr>
</thead><tbody>";
$query = "SELECT * FROM booking WHERE hotelID='$hotelID'";
$result1 = mysqli_query($dbc,$query);
if(mysqli_num_rows($result1) > 0) {
    while ($row = mysqli_fetch_array($result1)) {
        $bookingID = $row['bookingID'];
        $bookingID = "#B".str_pad($bookingID, 4, '0', STR_PAD_LEFT);
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
            $cust_contact = (STRING) $row['hpNo'];
        }
        $line_data =array($bookingID,$custName,$cust_contact,$bookingDate,$bookingTime,$checkInDate,$checkOutDate,$status,);
        $excelData .= '<tr><td>'.$bookingID.'</td>';
        $excelData .= '<td>'.$custName.'</td>';
        $excelData .= '<td>6'.$cust_contact.'</td>';
        $excelData .= '<td>'.$bookingDate.'</td>';
        $excelData .= '<td>'.$bookingTime.'</td>';
        $excelData .= '<td>'.$checkInDate.'</td>';
        $excelData .= '<td>'.$checkOutDate.'</td>';
        $excelData .= '<td>'.$status.'</td></tr>';

    }
}else{
    $excelData = "No record found."."\n";
}
$excelData .="</tbody></table>";
header("Content-Disposition: attachment; filename=\"$fileName\""); 
header("Content-Type: application/vnd.ms-excel"); 
echo $excelData;
exit();

    ?>