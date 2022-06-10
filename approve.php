<?php
    require_once ("config.php");
    $hotelID=$_GET['id']; 
    $query3 = "SELECT * FROM hotel where hotelID='$hotelID'";
    $result3 = mysqli_query($dbc,$query3);
    if(mysqli_num_rows($result3) > 0) {
        while ($row = mysqli_fetch_array($result3)) {
            $hotelName = $row['hotelName'];
            $email = $row['email'];
        }
    }
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $username = '';
    $password = '';
    for ($i = 0; $i < 10; $i++) {
        $username .= $characters[rand(0, $charactersLength - 1)];
        $password .= $characters[rand(0, $charactersLength - 1)];
    }

  $approve = "UPDATE hotel SET approve ='1',username='$username',password='$password' where hotelID='$hotelID'";
  mysqli_query($dbc, $approve);
  $to_email = $email;
  $subject = "Approved Application as Merchant";
  $body = "Hi,".$hotelName.". Your application as merchant had been approved. Below is your default merchant username and password:
        \n\tUsername: ".$username."
        \n\tPassword: ".$password.
        "\n\nNote: Please do change the merchant username and password after login and set active once you have completed setup the hotel.";
  $headers = "From: Kuro Hotel Booking Website";
  mail($to_email, $subject, $body,$headers);  
  header('Location: manage_new_merchant.php');  
?>