<?php
require_once('config.php');
// check isset id from the link to retrieve hotel ID for merchant
if(isset($_GET['id'])){
    $hotelID = $_GET['id'];
    $query = "SELECT * FROM booking WHERE hotelID='$hotelID'"; // sort the data which is relevant to the hotel
}else{
    $query = "SELECT * FROM booking "; // if not, fetch all data
}

//excel file name
$fileName = date('Ymd')." Booking_Record.xls";

//display column name as first row
if(isset($_GET['id'])){ //column for merchant
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
}else{ //column for admin
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
        <th>Hotel Name</th>
    </tr>
    </thead><tbody>";
}

//run sql query and fetch all the data
$result1 = mysqli_query($dbc,$query);
if(mysqli_num_rows($result1) > 0) {
    while ($row = mysqli_fetch_array($result1)) {
        $bookingID = $row['bookingID'];
        $bookingID = "#B".str_pad($bookingID, 4, '0', STR_PAD_LEFT); //format booking id to #B000x
        $bookingDate = $row['bookingDate'];
        $bookingTime = $row['time'];
        $checkInDate = $row['checkInDate'];
        $checkOutDate = $row['checkOutDate'];
        $status = $row['status'];
        $custID = $row['custID'];
        $hotelID = $row['hotelID'];
        
		//get customer details
        $get_cust = "SELECT * FROM customer WHERE custID='$custID' ";
        $result = mysqli_query($dbc,$get_cust);
        while ($row = mysqli_fetch_array($result)) {
            $custName = $row['custName'];
            $cust_contact = (STRING) $row['hpNo'];
        }

		//get hotel details
        $get_hotel = "SELECT * FROM hotel WHERE hotelID='$hotelID' ";
        $result = mysqli_query($dbc,$get_hotel);
        while ($row = mysqli_fetch_array($result)) {
            $hotelName = $row['hotelName'];
        }

        if(isset($_GET['id'])){
            $line_data =array($bookingID,$custName,$cust_contact,$bookingDate,$bookingTime,$checkInDate,$checkOutDate,$status); //data for merchant
        }else{
            $line_data =array($bookingID,$custName,$cust_contact,$bookingDate,$bookingTime,$checkInDate,$checkOutDate,$status,$hotelName); //data for admin
        }
        //table row data
        $excelData .= '<tr><td>'.$bookingID.'</td>';
        $excelData .= '<td>'.$custName.'</td>';
        $excelData .= '<td>6'.$cust_contact.'</td>';
        $excelData .= '<td>'.$bookingDate.'</td>';
        $excelData .= '<td>'.$bookingTime.'</td>';
        $excelData .= '<td>'.$checkInDate.'</td>';
        $excelData .= '<td>'.$checkOutDate.'</td>';
        $excelData .= '<td>'.$status.'</td>';
        if(!isset($_GET['id'])){
            $excelData .= '<td>'.$hotelName.'</td>';
        }
        $excelData .= '</tr>';
    }
    $excelData .="</tbody></table>";
}else{
    $excelData = "No record found."."\n"; //prompt user no record is found in excel file
}

//export data to excel file with xls format
header("Content-Disposition: attachment; filename=\"$fileName\""); 
header("Content-Type: application/vnd.ms-excel"); 
echo $excelData; //print data
exit();
?>