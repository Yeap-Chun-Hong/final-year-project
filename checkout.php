<?php
    include ('header.php');
    $bookingID = $_GET['id']; //get booking id

    //fetch booking details
    $getBookingDetails = "SELECT * FROM booking WHERE bookingID ='$bookingID' ";
    $result =  mysqli_query($dbc,$getBookingDetails);
    if(mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $bookingDate = $row['bookingDate'];
            $checkInDate = $row['checkInDate'];
            $checkOutDate = $row['checkOutDate'];
            $time = $row['time'];
            $room = $row['room'];
            $adult = $row['adult'];
            $children = $row['children'];
            $price = $row['price'];
            $custID = $row['custID'];
            $hotelID = $row['hotelID'];
            $roomID = $row['roomID'];
            $status = $row['status'];
            $paymentMethod = $row['payment'];
        }    
    }
    //get hotel details
    $get_hotel = "SELECT * FROM hotel WHERE hotelID='$hotelID' ";
    $result = mysqli_query($dbc,$get_hotel);
    if(mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_array($result)) {
        $hotelName = $row['hotelName'];
        $childrenPrice = $row['childPrice'];
        $adultPrice= $row['adultPrice'];
      }
    }

    //get customer details
    $getCustDetails = "SELECT * FROM customer WHERE custID ='$custID' ";
    $result2 =  mysqli_query($dbc,$getCustDetails);
    if(mysqli_num_rows($result2) > 0) {
        while ($row = mysqli_fetch_array($result2)) {
            $custName = $row['custName'];
            $custEmail = $row['email'];
            $custPhone = $row['hpNo'];
        }
    }

    //get room details
    $getRoomDetails = "SELECT * FROM room WHERE roomID ='$roomID' ";
    $result3 =  mysqli_query($dbc,$getRoomDetails);
    if(mysqli_num_rows($result3) > 0) {
        while ($row = mysqli_fetch_array($result3)) {
          $roomName = $row['roomName'];
            $roomPrice = $row['price'];
            $roomAvailable = $row['roomAvailable'];
        }
    }

    //calculate prices
    $adultTotal = $adultPrice *$adult; //total adult fees
    $childrenTotal = $childrenPrice * $children; //total children fees
    $roomTotal= $roomPrice *$room; //total room fees
    $days = (strtotime($checkOutDate) - strtotime($checkInDate)) / (60 * 60 * 24); //calculate the days 

    //calculate the total fees and multiply by days 
    $totalFees = $roomTotal  + $adultTotal + $childrenTotal; 
    $subtotal = $totalFees * $days; 
    
    $tax = $subtotal *0.1; // 10% tax
    $total = $subtotal + $tax;    //total amount need to pay

if(isset($_POST['submitted'])){
  //update data if checkout button is clicked
  $paymentMethod = $_POST['payment-method'];
  $update = "UPDATE booking SET 
              price ='$total',
              payment = '$paymentMethod',
              status = 'Completed',
              price = '$total' 
              WHERE bookingID = '$bookingID'";
  mysqli_query($dbc, $update);

  //minus the room that have been booked and update to database
  $roomAvailable-=$room;
  $updateRoomAvailable = "UPDATE room SET roomAvailable ='$roomAvailable' WHERE roomID = '$roomID'";
  mysqli_query($dbc, $updateRoomAvailable);

  //redirect user to thank you page
  header('Location: thankyou.php');
  exit();
}
?>
<link rel="stylesheet" type="text/css" href="css/checkout.css">
<title>Checkout</title>

<div class="iphone">
  <header class="header">
    <h1>Checkout</h1>
  </header>

  <form action="<?php echo 'checkout.php?id='.$bookingID ?>" class="form" method="POST">
    <div>
      <h2>Customer Details</h2>

      <div>

      <table>
        <tbody>
        <tr>
            <td>Name  &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;:<?php echo $custName?></td>
          </tr> 
          <tr>
            <td>Contact Number&nbsp; :<?php echo $custPhone?></td>
          </tr> 
          <tr>
            <td>Email  &nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; :<?php echo $custEmail?></td>
          </tr>
          <tr>
            <td>Booking Ticket   &nbsp;&nbsp;&nbsp; :<?php echo '#B'.str_pad($bookingID, 4, '0', STR_PAD_LEFT); ?></td>
          </tr>
        </tbody>
      </table>
    </div>
    <div>
    <h2>Booking Details</h2>

      <table>
        <tbody>
        <tr>
            <td>Hotel Name &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:<?php echo $hotelName?></td>
          </tr>
          <tr>
            <td>Room Type  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:<?php echo $roomName?></td>
          </tr>
        <tr>
            <td>Booking Date  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:<?php echo $bookingDate.' '.$time?></td>
          </tr>
        <tr>
            <td>Check-In Date  &nbsp;&nbsp;&nbsp;&nbsp;:<?php echo $checkInDate?></td>
          </tr>
          <tr>
            <td>Check-Out Date &nbsp;:<?php echo $checkOutDate?></td>
          </tr>
        <tr>
            <td></td>
            <td align="right">Price (RM)</td>
            <td align="right">Quantity</td>
            <td align="right">Total (RM)</td>

          </tr>
          <tr><td></td><td></td></tr>
        <tr>
            <td>Adult Fees</td>
            <td align="right"><?php echo number_format($adultPrice,2)?></td>
            <td align="right"><?php echo $adult?></td>
            <td align="right"><?php echo number_format($adultTotal,2)?></td>
          </tr>
          <tr>
            <td>Children Fees</td>
            <td align="right"><?php echo number_format($childrenPrice,2)?></td>
            <td align="right"><?php echo $children?></td>
            <td align="right"><?php echo number_format($childrenTotal,2)?></td>
          </tr>
          <tr>
            <td>Room Fees</td>
            <td align="right"><?php echo number_format($roomPrice,2)?></td>
            <td align="right"><?php echo $room?></td>
            <td align="right"><?php echo number_format($roomTotal,2)?></td>
          </tr>
          <tr>
            <td>Subtotal</td>
            <td align="right"><?php echo number_format($totalFees,2)?></td>
            <td align="right"><?php echo $days ?></td>
            <td align="right"><?php echo number_format($subtotal,2)?></td>
          </tr>
        </tbody>
      </table>
    </div>

    <div>
      <table>
        <tbody>
          <tr>
            <td>SST (10%)</td>
            <td align="right"><?php echo number_format($tax,2)?></td>
          </tr>
        </tbody>
        <tfoot>
          <tr>
            <td>Total</td>
            <td align="right"><?php echo number_format($total,2)?></td>
          </tr>
        </tfoot>
      </table>
    </div>
    <fieldset>
      <h2>Payment Method</h2>

      <div class="form__radios">
        <div class="form__radio">
          <label for="visa"><svg class="icon">
              <use xlink:href="#icon-visa" />
            </svg>Visa Payment</label>
          <input checked id="visa" name="payment-method" type="radio"  value="Visa Payment" <?php echo $paymentMethod=='Visa Payment'?'checked':'' ?> <?php echo ($paymentMethod == '-')?'':'disabled' ?>/>
        </div>

        <div class="form__radio">
          <label for="paypal"><img src="images/download.png" class="icon" />Touch 'n Go</label>
          <input id="paypal" name="payment-method" type="radio" value="TNG ewallet" <?php echo $paymentMethod=='TNG ewallet'?'checked':'' ?> <?php echo ($paymentMethod == '-')?'':'disabled' ?>/>
        </div>

        <div class="form__radio">
          <label for="mastercard">
            <img src="images/cash.svg" class="icon" />Cash</label>
          <input id="mastercard" name="payment-method" type="radio" value="Cash" <?php echo $paymentMethod=='Cash'?'checked':'' ?> <?php echo ($paymentMethod == '-')?'':'disabled' ?>/>
        </div>
      </div>
    </fieldset>
    <div>
     
    </div>
    <?php 
      //if status is complete, hide the checkout button
      //if room available is 0, show fully booked
      //if not customer login, hide the checkout button to prevent other user checkout
      echo isset($_SESSION['custID'])?$status!='Completed'?$roomAvailable >0?'<button class="button button--full" type="submit"><svg class="icon">
          <use xlink:href="#icon-shopping-bag" />
        </svg>Checkout Now</button><input type="hidden" name="submitted" value="true"/>'    : '<button class="button button--full" type="button" style="background:grey;" disabled>Fully booked</button>'
        :'':'' 
    ?>
  </form>
</div>

<svg xmlns="http://www.w3.org/2000/svg" style="display: none">

  <symbol id="icon-shopping-bag" viewBox="0 0 24 24">
    <path d="M20 7h-4v-3c0-2.209-1.791-4-4-4s-4 1.791-4 4v3h-4l-2 17h20l-2-17zm-11-3c0-1.654 1.346-3 3-3s3 1.346 3 3v3h-6v-3zm-4.751 18l1.529-13h2.222v1.5c0 .276.224.5.5.5s.5-.224.5-.5v-1.5h6v1.5c0 .276.224.5.5.5s.5-.224.5-.5v-1.5h2.222l1.529 13h-15.502z" />
  </symbol>


  <symbol id="icon-visa" viewBox="0 0 504 504">
    <path d="m184.8 324.4 25.6-144h40l-24.8 144z" fill="#3c58bf" />
    <path d="m184.8 324.4 32.8-144h32.8l-24.8 144z" fill="#293688" />
    <path d="m370.4 182c-8-3.2-20.8-6.4-36.8-6.4-40 0-68.8 20-68.8 48.8 0 21.6 20 32.8 36 40s20.8 12 20.8 18.4c0 9.6-12.8 14.4-24 14.4-16 0-24.8-2.4-38.4-8l-5.6-2.4-5.6 32.8c9.6 4 27.2 8 45.6 8 42.4 0 70.4-20 70.4-50.4 0-16.8-10.4-29.6-34.4-40-14.4-7.2-23.2-11.2-23.2-18.4 0-6.4 7.2-12.8 23.2-12.8 13.6 0 23.2 2.4 30.4 5.6l4 1.6z" fill="#3c58bf" />
    <path d="m370.4 182c-8-3.2-20.8-6.4-36.8-6.4-40 0-61.6 20-61.6 48.8 0 21.6 12.8 32.8 28.8 40s20.8 12 20.8 18.4c0 9.6-12.8 14.4-24 14.4-16 0-24.8-2.4-38.4-8l-5.6-2.4-5.6 32.8c9.6 4 27.2 8 45.6 8 42.4 0 70.4-20 70.4-50.4 0-16.8-10.4-29.6-34.4-40-14.4-7.2-23.2-11.2-23.2-18.4 0-6.4 7.2-12.8 23.2-12.8 13.6 0 23.2 2.4 30.4 5.6l4 1.6z" fill="#293688" />
    <path d="m439.2 180.4c-9.6 0-16.8.8-20.8 10.4l-60 133.6h43.2l8-24h51.2l4.8 24h38.4l-33.6-144zm-18.4 96c2.4-7.2 16-42.4 16-42.4s3.2-8.8 5.6-14.4l2.4 13.6s8 36 9.6 44h-33.6z" fill="#3c58bf" />
    <path d="m448.8 180.4c-9.6 0-16.8.8-20.8 10.4l-69.6 133.6h43.2l8-24h51.2l4.8 24h38.4l-33.6-144zm-28 96c3.2-8 16-42.4 16-42.4s3.2-8.8 5.6-14.4l2.4 13.6s8 36 9.6 44h-33.6z" fill="#293688" />
    <path d="m111.2 281.2-4-20.8c-7.2-24-30.4-50.4-56-63.2l36 128h43.2l64.8-144h-43.2z" fill="#3c58bf" />
    <path d="m111.2 281.2-4-20.8c-7.2-24-30.4-50.4-56-63.2l36 128h43.2l64.8-144h-35.2z" fill="#293688" />
    <path d="m0 180.4 7.2 1.6c51.2 12 86.4 42.4 100 78.4l-14.4-68c-2.4-9.6-9.6-12-18.4-12z" fill="#ffbc00" />
    <path d="m0 180.4c51.2 12 93.6 43.2 107.2 79.2l-13.6-56.8c-2.4-9.6-10.4-15.2-19.2-15.2z" fill="#f7981d" />
    <path d="m0 180.4c51.2 12 93.6 43.2 107.2 79.2l-9.6-31.2c-2.4-9.6-5.6-19.2-16.8-23.2z" fill="#ed7c00" />
    <g fill="#051244">
      <path d="m151.2 276.4-27.2-27.2-12.8 30.4-3.2-20c-7.2-24-30.4-50.4-56-63.2l36 128h43.2z" />
      <path d="m225.6 324.4-34.4-35.2-6.4 35.2z" />
      <path d="m317.6 274.8c3.2 3.2 4.8 5.6 4 8.8 0 9.6-12.8 14.4-24 14.4-16 0-24.8-2.4-38.4-8l-5.6-2.4-5.6 32.8c9.6 4 27.2 8 45.6 8 25.6 0 46.4-7.2 58.4-20z" />
      <path d="m364 324.4h37.6l8-24h51.2l4.8 24h38.4l-13.6-58.4-48-46.4 2.4 12.8s8 36 9.6 44h-33.6c3.2-8 16-42.4 16-42.4s3.2-8.8 5.6-14.4" />
    </g>
  </symbol>
</svg>
  </div>
<?php
include ('footer.php');
?>