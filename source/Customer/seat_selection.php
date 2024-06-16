<?php
session_start();
?>
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
    <form action="confirmation.php" method="get" class="form flex">
      <section class="selection-group flex">
        <h3 class="selection">1. Book Tickets</h3>
        <h3 class="selection current">2. Select Seats</h3>
        <h3 class="selection">3. Confirm</h3>
        <h3 class="selection">4. Booking Successful</h3>
      </section>

      <section class="ticket-contents flex">
        <div class="poster-container">
          <img class="poster" src="/public/images/<?php echo $_SESSION['poster']; ?>" alt="">
        </div>

        <div class="details-group flex">
          <div class="ticket-details">
            <label class="ticket-labels label-title" for="">Movie Title</label>
            <h3 class="chosen movie-title"><?php echo $_SESSION['title'] ?></h3>
            <label class="ticket-labels">Time Slot:</label>
            <h3 class="chosen"><?php echo $_SESSION['time-selected'] ?></h3>
            <label class="ticket-labels">Screen Location:</label>
            <h3 class="chosen">Cinema <?php echo $_SESSION['cinema-number'] ?></h3>
            <label class="ticket-labels">Tickets Reserved:</label>
            <h3 class="chosen"><?php echo $_SESSION['quantity']?> Tickets</h3>
            <label class="ticket-labels">Total Cost:</label>
            <h3 class="chosen">₱<?php echo $_SESSION['cost-plus-tax']?></h3>
          </div>
          <p class="note">*Please ensure that you are selecting seats of your choice</p>
        </div>
      </section>

      <section class="seat-section">
        <?php for ($i = 1; $i <= 120; $i++) {
              // Determine the group number (1-10 -> 'a', 11-20 -> 'b', etc.)
              $groupNumber = ceil($i / 10);
              // Convert the group number to a letter (1 -> 'a', 2 -> 'b', etc.)
              $letter = chr(64 + $groupNumber);
              // Combine the letter with the number
              $label = $letter . $i;
              ?>
          <button type="button" value="<?php echo $label ?>" class="seats-button"><?php echo $label ?></button>
        <?php }?>
      </section>
      <section class="button-operations">
        <button class="go-back" name="buttons" value="cancel">Cancel</button>
        <button class="proceed" onclick="submitArray();">Confirm</button>
      </section>
    </form>
<script>
    // Array to store clicked button values
    const clickedValues = [];
    // Counter to track the number of clicks
    const maxClicks = <?php echo $_SESSION['quantity'] ?>;

    // Add event listeners to all buttons
    document.querySelectorAll('.seats-button').forEach(button => {
        button.addEventListener('click', function() {
            // Get the value of the clicked button
            const value = this.value;

            // Check if the value is already in the array
            if (!clickedValues.includes(value)) {
                // Check if the array has less than maxClicks elements
                if (clickedValues.length < maxClicks) {
                    // Add the value to the array
                    clickedValues.push(value);
                    // Add a CSS class to indicate the button has been clicked
                    this.classList.add('clicked');
                } else {
                    alert('You can only select up to ' + maxClicks + ' seats.');
                }
            }

            // Log the array to the console (for debugging purposes)
            console.log(clickedValues);
        });
    });

    // Create a hidden form and submit it to pass the data to PHP
    function submitArray() {
        // Convert the JavaScript array to a JSON string
        const jsonString = JSON.stringify(clickedValues);

        const form = document.createElement('form');
        form.method = 'GET';
        form.action = 'handle_seat_selection.php'; // URL of the PHP script to handle the data

        const hiddenField = document.createElement('input');
        hiddenField.type = 'hidden';
        hiddenField.name = 'jsonArray';
        hiddenField.value = jsonString;

        form.appendChild(hiddenField);
        document.body.appendChild(form);
        form.submit();
    }
</script>
</body>
</html>
</body>
</html>
