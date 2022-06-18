<?php
    require_once ("config.php");
    $hotelID=$_GET['id']; //retrieve hotel id
    date_default_timezone_set("Asia/Kuala_Lumpur"); //set Malaysia timezone 

    //fetch data
    $query3 = "SELECT * FROM hotel where hotelID='$hotelID'";
    $result3 = mysqli_query($dbc,$query3);
    if(mysqli_num_rows($result3) > 0) {
        while ($row = mysqli_fetch_array($result3)) {
            $hotelName = $row['hotelName'];
            $email = $row['email'];
            $address = $row['address'];
            $contact = $row['phoneNo'];
        }
    }
    //update reject date in database
    $reject_date = date("Y-m-d");
    $reject = "UPDATE hotel SET rejected_at ='$reject_date' where hotelID='$hotelID'";
    mysqli_query($dbc, $reject);

    //send an email to the merchant
    $to_email = $email; //merchant email
    $subject = "Rejected Application as Merchant"; //subject
    //body
    $body = "Hi,".$hotelName.". Your application as merchant had been rejected.
            \n\tHotel Name: ".$hotelName."
            \n\tAddress: ".$address."
            \n\tContact: ".$contact.
            "\n\nWe appreciate that you are interested in Kuro Hotel Booking Website.";
    $headers = "From: Kuro Hotel Booking Website"; // Let user know the sender
    mail($to_email, $subject, $body,$headers);  
    header('Location: manage_new_merchant.php');  //redirect user to the manage merchant page
?>