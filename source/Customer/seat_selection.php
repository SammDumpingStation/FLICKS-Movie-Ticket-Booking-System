<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php include_once '../../includes/css_links.php'?>
  <link rel="stylesheet" href="../../public/css/Customer/seat-selection.css">
  <title>Select Seats</title>
</head>
<body>
    <?php include_once '../../includes/navbar.php';?>
    <main class="flex">
      <section class="selection-group flex">
        <h3 class="selection">1. Book Tickets</h3>
        <h3 class="selection current">2. Select Seats</h3>
        <h3 class="selection">3. Confirm</button>
        <h3 class="selection">4. Booking Successful</h3>
      </section>

      <section class="ticket-contents flex">
        <div class="poster-container">
          <img class="poster" src="/public/images/Furiosa.jpg" alt="">
        </div>

        <div class="details-group flex">
          <div class="ticket-details">
            <label class="ticket-labels" for="">Movie Title</label>
            <h3 class="chosen">Furiosa: A Mad Max Saga</h3>
            <label class="ticket-labels">Time Slot:</label>
            <h3 class="chosen">12:30 P.M.</h3>
            <label class="ticket-labels">Screen Location:</label>
            <h3 class="chosen">Cinema 1</h3>
            <label class="ticket-labels">Tickets Reserved:</label>
            <h3 class="chosen">8 Tickets</h3>
            <label class="ticket-labels">Total Cost:</label>
            <h3 class="chosen">$3240</h3>
          </div>
          <p class="note">*Please ensure that you are selecting seats of your choice</p>
        </div>

      </section>  
      <section class="seat-section">

      </section>    
      <section class="button-operations">
        <a href="book_ticket.php"><button class="go-back">Go Back</button></a>
        <a href="confirmation.php"><button class="proceed">Proceed</button></a>
      </section>
    </main>

</body>
</html>