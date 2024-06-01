<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php include_once './includes/css_links.php'?>
  <link rel="stylesheet" href="/public/css/summary.css">
  <title>Document</title>
</head>
<body>
  <?php include './includes/navbar.php'?>

  <main class="flex">
      <section class="selection-group flex">
        <h3 class="selection">1. Book Tickets</h3>
        <h3 class="selection">2. Select Seats</h3>
        <h3 class="selection">3. Confirm</button>
        <h3 class="selection current">4. Booking Successful</h3>
      </section>

      <section class="summary-section flex">
        <div class="booking-hero">
          <img src="/public/images/booking-icon.png" alt="">
          <h2>Booking Confirmed successfully</h2>
          <p>Thank you for choosing to book with FLICKS! Your reservation has been confirmed. If there's anything you need before your arrival, don't hesitate to reach us out!</p>
          <button>Go Back to Home</button>
        </div>

        <div class="receipt-hero">
          <div class="first-half receipt"> 
            <h2>$3240</h2>
            <h4 for="">Reservation Confirmed!</h4>
            <h6>Ref. No.: 123456789</h6>
          </div>  
          <div class="second-half receipt">
            <h3 class="payment-title">Payment Details</h3>
            <h6 class="date">Jul 25, 2023 05:07:03 AM</h6>

            <h5 class="label">Movie Name</h5>
            <h4 class="details">Furios</h4>

            <h5 class="label">Screen Location</h5>
            <h4 class="details">Cinema 4</h4>

            <h5 class="label">Seats Booked</h5>
            <h4 class="details">8 Tickets</h4>

            <h5 class="label">Time Slot</h5>
            <h4 class="details">12:30</h4>

            <h5 class="label">Amount</h5>
            <h4 class="details">$3240</h4>

            <h5 class="label">Payment Method</h5>
            <h4 class="details">Over-the-counter</h4>

            <h5 class="label">Payment Status</h5>
            <h4 class="details">Pending</h4>
          </div>
        </div>
      </section>
  </main>
</body>
</html>