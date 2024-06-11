<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php include_once '../../includes/css_links.php'?>
  <link rel="stylesheet" href="../../public/css/Customer/book-ticket.css">
  <title>Book A Ticket</title>
</head>
<body>
  <?php include_once '../../includes/navbar.php';?>

  <main class="flex">
    <section class="selection-group flex">
      <h3 class="selection current">1. Book Tickets</h3>
      <h3 class="selection">2. Select Seats</h3>
      <h3 class="selection">3. Confirm</button>
      <h3 class="selection">4. Booking Successful</h3>
    </section>

    <section class="current-contents flex">
      <div class="poster-container">
        <img src="/public/images/Furiosa.jpg" alt="">
      </div>

      <div class="movie-details flex">
        <h1 class="title">Furiosa: A Mad Max Saga</h1>
        <div class="below-title">
          <h1 class="price">$400</h1>
          <div class="timeslot">
            <h2 class="sec-head">Select Time Slot</h2>
            <h3 class="sec-desc">Select the time slot you wish to watch.</h3>
            <div class="times-container flex">
              <button>12:30 P.M.</button>
              <button>3:30 P.M.</button>
              <button>6:30 P.M.</button>
            </div>
          </div>

          <div class="tickets">
            <h2 class="sec-head">Select Tickets</h2>
            <h3 class="sec-desc">Select the number of tickets you wish to buy.</h3>

            <div class="quant-div">
              <h4 class="sect-title">Quantity</h4>

              <div class="quantity-div flex">
                <h6 class="operators minus">-</h6>
                <input type="number" class="input" name="" id="">
                <h6 class="operators plus">+</h6>
              </div>
              <h6 class="info-quant">*You can buy a maximum of 8 tickets per transaction*</h6>

            </div>

            <div class="total-div">
              <h4 class="sect-title">Total Cost</h4>
              <p class="total">$3200 + $40 <span class="book-fee">(Booking fee)</span> = <span class="total-plus-fee">$3240.00</span></p>
            </div>
          </div>
        </div>

        <div class="button-operations">
          <a href="movie_info.php"><button class="go-back">Go Back</button></a>
          <a href="seat_selection.php"><button class="proceed">Proceed</button></a>
        </div>
      </div>
    </section>
  </main>
</body>
</html>