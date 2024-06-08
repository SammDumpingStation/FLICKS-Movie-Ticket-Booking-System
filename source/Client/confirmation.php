<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php include_once '../../includes/css_links.php'?>
  <link rel="stylesheet" href="../../public/css/Client/confirmation.css">
  <title>Document</title>
</head>
<body>
  <?php include('../../includes/navbar.php')?>

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
            <label class="ticket-labels">Tickets Reserved:</label>
            <h3 class="chosen">8 Tickets</h3>
            <label class="ticket-labels">Total Cost:</label>
            <h3 class="chosen">$3240</h3>
            <label for="ticket-labels">Selected Seats</label>
            <h3 class="chosen">A1, A2, A3, A4, A5, A6, A7, A8</h3>
          </div>
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

        <form class="flex methods-section">
          <div class="flex status">
            <h3 class="payment-methods">Available Methods</h3>
            <label for="cash" class="methods flex">
              <label for="cash">Over-the-counter</label>
              <input class="radio" type="radio" name="methods" value="over-the-counter" id="cash">         
            </label>            
          </div>

          <div class="flex status">
            <h3 class="payment-methods">Unavailable Methods</h3>
              <label for="gcash" class="methods unavailable flex">
                <label for="gcash">Gcash</label>
                <input class="radio" type="radio" name="methods" value="gcash" disabled id="gcash"> 
                <hr class="line-gcash">    
              </label>
    
              <label for="cards" class="methods unavailable flex">
                <label for="cards">Credit/Debit Cards</label>
                <input class="radio" type="radio" name="methods" value="credit/debit" disabled id="cards">
                <hr class="line-cards"> 
              </label>            
          </div>
        </form>

      </section>

      <section class="buttons-div flex">
        <a href="seat_selection.php"><button class="buttons go-back">Go Back</button></a>
        <a href="summary.php"><button class="buttons">Proceed</button></a>
      </section>
  </main>
</body>
</html>