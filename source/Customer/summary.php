<?php
session_start();

if (isset($_GET['home']) && $_GET['home'] === 'home') {
  // Define the session variables you want to keep
$sessionVariablesToKeep = [
    'user-type',
    'first-name',
    'last-name',
    'email',
    'phone-number',
];

// Loop through the entire $_SESSION array
foreach ($_SESSION as $key => $value) {
    // Check if the current key is not in the array of session variables to keep
    if (!in_array($key, $sessionVariablesToKeep)) {
        // Unset the session variable
        unset($_SESSION[$key]);
    }
}
header('Location: landing.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php include_once '../../includes/css_links.php'?>
  <link rel="stylesheet" href="../../public/css/Customer/summary.css">
  <title>Summary</title>
</head>
<body>
  <?php include '../../includes/navbar.php'?>

  <form action="" method="get" class="flex form">
      <section class="selection-group flex">
        <h3 class="selection">1. Book Tickets</h3>
        <h3 class="selection">2. Select Seats</h3>
        <h3 class="selection">3. Confirm</button>
        <h3 class="selection current">4. Booking Successful</h3>
      </section>

      <section class="summary-section flex">
        <div class="booking-hero flex">
          <div class="icon-container">
            <img src="/public/images/booking-icon.png" alt="">
          </div>
          <h2 class="booking-title">Booking Confirmed Successfully!</h2>
          <p class="booking-desc">Thank you for choosing to book with FLICKS! Your reservation has been confirmed. If there's anything you need before your arrival, don't hesitate to reach us out!</p>
          <button class="booking-button" name="home" value="home">Go Back to Home</button>
        </div>

        <div class="receipt-hero flex">
          <div class="first-half receipt"> 
            <h2 class="total-cost">₱<?php echo $_SESSION['cost-plus-tax'] ?>.00</h2>
            <h4 class="confirmed">Reservation Confirmed!</h4>
            <h6 class="reference">Ref. No.: <?php echo $_SESSION['reference-id'] ?? 12345?></h6>
          </div>  
          
          <div class="second-half receipt flex">

            <div class="receipt-group flex">
              <h3 class="payment-title">Payment Details</h3>
              <h6 class="date"><?php echo date(' F d D, Y h:i a')?></h6>              
            </div>

            <div class="receipt-group flex">
              <h5 class="label first">Movie Name</h5>
              <h4 class="details"><?php echo $_SESSION['title']?></h4>              
            </div>

            <div class="receipt-group flex">
              <h5 class="label">Screen Location</h5>
              <h4 class="details">Cinema <?php echo $_SESSION['cinema-number']?></h4>              
            </div>

            <div class="receipt-group flex">
              <h5 class="label">Seats Booked</h5>
              <h4 class="details"><?php echo $_SESSION['quantity'] ?> Ticket/s</h4>              
            </div>

            <div class="receipt-group flex">
              <h5 class="label">Time Slot</h5>
              <h4 class="details"><?php echo $_SESSION['time-selected']?></h4>              
            </div>

            <div class="receipt-group flex">
              <h5 class="label">Amount</h5>
              <h4 class="details">₱<?php echo $_SESSION['cost-plus-tax'] ?>.00</h4>              
            </div>

            <div class="receipt-group flex">
              <h5 class="label">Payment Method</h5>
              <h4 class="details"><?php echo $_SESSION['method'] ?? 'Over the Counter'?></h4>              
            </div>

            <div class="receipt-group flex">
              <h5 class="label">Payment Status</h5>
              <h4 class="details"><?php echo $_SESSION['status'] ?? 'Pending' ?></h4>              
            </div>
          </div>
        </div>
      </section>
  </main>
</body>
</html>