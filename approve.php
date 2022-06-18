<?php
    require_once ("config.php");
    $hotelID=$_GET['id']; //retrieve hotel id

    //fetch data
    $query3 = "SELECT * FROM hotel where hotelID='$hotelID'";
    $result3 = mysqli_query($dbc,$query3);
    if(mysqli_num_rows($result3) > 0) {
        while ($row = mysqli_fetch_array($result3)) {
            $hotelName = $row['hotelName'];
            $email = $row['email'];
        }
    }
    //generate OTP with 10 random characters for new merchant
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $username = '';
    $password = '';
    for ($i = 0; $i < 10; $i++) {
        $username .= $characters[rand(0, $charactersLength - 1)];
        $password .= $characters[rand(0, $charactersLength - 1)];
    }

    //encrypt password
    $encrypted_pw=base64_encode($password);

    //update status,username and password in database
    $approve = "UPDATE hotel SET approve ='1',username='$username',password='$encrypted_pw' where hotelID='$hotelID'";
    mysqli_query($dbc, $approve);

    //send an email to the merchant
    $to_email = $email; //merchant email
    $subject = "Approved Application as Merchant"; //subject
    //body
    $body = "Hi,".$hotelName.". Your application as merchant had been approved. Below is your default merchant username and password:
            \n\tUsername: ".$username."
            \n\tPassword: ".$password.
            "\n\nNote: Please do change the merchant username and password after login and set active once you have completed setup the hotel.";
    $headers = "From: Kuro Hotel Booking Website"; // Let user know the sender
    mail($to_email, $subject, $body,$headers);  
    header('Location: manage_new_merchant.php');  //redirect user to the manage merchant page
?>