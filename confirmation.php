<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php include_once './includes/css_links.php'?>
  <link rel="stylesheet" href="/public/css/confirmation.css">
  <title>Document</title>
</head>
<body>
  <?php include('./includes/navbar.php')?>

  <main class="flex">
      <section class="selection-group flex">
        <h3 class="selection">1. Book Tickets</h3>
        <h3 class="selection">2. Select Seats</h3>
        <h3 class="selection current">3. Confirm</button>
        <h3 class="selection">4. Booking Successful</h3>
      </section>

      <section class="ticket-contents flex">
        <div class="poster-container">
          <img class="poster" src="/public/images/Furiosa.jpg" alt="">
        </div>

        <div class="details-group flex">
          <div class="ticket-details">
            <label class="ticket-labels">Time Slot:</label>
            <h3 class="chosen">12:30 P.M.</h3>
            <label class="ticket-labels">Screen Location:</label>
            <h3 class="chosen">Cinema 1</h3>
            <label class="ticket-labels">Ticket Bought:</label>
            <h3 class="chosen">8</h3>
            <label class="ticket-labels">Total Cost:</label>
            <h3 class="chosen">$3240</h3>
          </div>
          <p class="note">*Please ensure that you are selecting seats of your choice</p>
        </div>
    </section>
      <hr class="line">

      <section class="personal-details flex">
        <h2 class="titles">Personal Details</h2>
        <div class="flex personal-input">
          <div class="flex input-div">
            <label class="label" for=" name">Full Name <span class="red">*</span></label>
            <input id="name" class="input-details" type="text" name="" id="">            
          </div>
          <div class="flex input-div">
            <label class="label"  for="email">Email <span class="red">*</span></label>
            <input id="input-details" class="input-details" type="text" name="" id="">  
          </div>

          <div class="flex input-div">
            <label class="label"  for="number">Phone Number <span class="red">*</span></label>
            <input id="number" class="input-details" type="text" name="" id="">   
          </div>        
        </div>
      </section>

      <section class="payment-section">
        <h2 class="titles">Payment Method</h2>
        <h3 class="payment-methods">Available Methods</h3>
          <div class="methods">
            <label for="">Over-the-counter</label>
            <input type="radio" name="" id="">         
          </div>
        <h3 class="payment-methods">Unavailable Methods</h3>
          <div class="methods unavailable">
            <label for="">Gcash</label>
            <input type="radio" name="" id="">     
          </div>
          <div class="methods unavailable">
            <label for="">Credit/Debit Cards</label>
            <input type="radio" name="" id=""> 
          </div>
      </section>

      <section class="buttons">
        <button>Go Back</button>
        <button>Proceed</button>
      </section>
  </main>
</body>
</html>