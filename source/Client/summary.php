<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php include_once '../../includes/css_links.php'?>
  <link rel="stylesheet" href="../../public/css/Client/summary.css">
  <title>Summary</title>
</head>
<body>
  <?php include '../../includes/navbar.php'?>

  <main class="flex">
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
          <a href="landing.php"><button class="booking-button">Go Back to Home</button></a>
        </div>

        <div class="receipt-hero flex">
          <div class="first-half receipt"> 
            <h2 class="total-cost">$3240</h2>
            <h4 class="confirmed">Reservation Confirmed!</h4>
            <h6 class="reference">Ref. No.: 123456789</h6>
          </div>  
          
          <div class="second-half receipt flex">

            <div class="receipt-group flex">
              <h3 class="payment-title">Payment Details</h3>
              <h6 class="date">Jul 25, 2023 05:07:03 AM</h6>              
            </div>

            <div class="receipt-group flex">
              <h5 class="label first">Movie Name</h5>
              <h4 class="details">Furiosa: A Mad Max Saga</h4>              
            </div>

            <div class="receipt-group flex">
              <h5 class="label">Screen Location</h5>
              <h4 class="details">Cinema 4</h4>              
            </div>

            <div class="receipt-group flex">
              <h5 class="label">Seats Booked</h5>
              <h4 class="details">8 Tickets</h4>              
            </div>

            <div class="receipt-group flex">
              <h5 class="label">Time Slot</h5>
              <h4 class="details">12:30</h4>              
            </div>

            <div class="receipt-group flex">
              <h5 class="label">Amount</h5>
              <h4 class="details">$3240</h4>              
            </div>

            <div class="receipt-group flex">
              <h5 class="label">Payment Method</h5>
              <h4 class="details">Over-the-counter</h4>              
            </div>

            <div class="receipt-group flex">
              <h5 class="label">Payment Status</h5>
              <h4 class="details">Pending</h4>              
            </div>
          </div>
        </div>
      </section>
  </main>
</body>
</html>