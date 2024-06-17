<?php
function generateReferenceID()
{
    $prefix = "flicks";
    $year = date("Y");
    $randomNumber = mt_rand(100000, 999999);
    $referenceID = $prefix . $year . $randomNumber;
    return $referenceID;
}
session_start();
include_once '../../classes/dbh.class.php';
$dbhconnect = new Dbh();

$buttons = $_POST['buttons'] ?? null;

if (isset($buttons)) {
    if ($buttons === 'cancel') {
        header('Location: seat_selection.php');
    } elseif ($buttons === 'confirm') {
        try {
            //Customer Information to database
            $userType = $_SESSION['user-type'] ?? 'guest';
            $firstName = $_POST['first-namr'] ?? null;
            $lastName = $_POST['last-name'] ?? null;
            $email = $_POST['email'] ?? null;
            $phoneNumber = $_POST['phone-number'] ?? null;

            $customerQuery = "INSERT INTO customer(user_type, first_name, last_name, email, phone_number, created_at) VALUES (:userType, :fname, :lname, :email, :pnum, NOW());";
            $cusStmt = $dbhconnect->connection()->prepare($customerQuery);
            $cusStmt->bindParam(":userType", $userType, PDO::PARAM_STR);
            $cusStmt->bindParam(":fname", $firstName, PDO::PARAM_STR);
            $cusStmt->bindParam(":lname", $lastName, PDO::PARAM_STR);
            $cusStmt->bindParam(":email", $email, PDO::PARAM_STR);
            $cusStmt->bindParam(":pnum", $phoneNumber, PDO::PARAM_STR);

            if (!$cusStmt->execute()) {
                throw new Exception("Failed to insert movie data");
                header('Location: confirmation?error=database.php');
            }

            $customerIDQuery = "SELECT id FROM customer ORDER BY id DESC LIMIT 1;";
            $IDstmt = $dbhconnect->connection()->prepare($customerIDQuery);
            $IDstmt->execute();
            $customerIDResult = $IDstmt->fetch(PDO::FETCH_ASSOC);

            if (!$IDstmt->execute()) {
                throw new Exception("Failed to get movie data");
                header('Location: confirmation?error=database.php');
            }

            //Reservation Information to database
            $quantity = $_SESSION['quantity'] ?? null;
            $totalCost = $_SESSION['cost-plus-tax'] ?? null;
            $seatsChosen = $_SESSION['seats-selected'] ?? null;
            $timeSelected = $_SESSION['time-selected'] ?? null;
            $timeWithoutAMPM = date("h:i", strtotime($timeSelected));
            $referenceID = generateReferenceID();
            $cinemaID = $_SESSION['cinema-number'] ?? null;
            $customerID = $customerIDResult['id'];

            $reservationQuery = "INSERT INTO reservation (quantity, total_cost, seats_chosen, time_selected, reference_id, customer_id, cinema_id, date_reserved) VALUES (:quantity, :total_cost, :seats_chosen, :time_selected, :reference_id, :customer_id, :cinema_id, NOW())";
            $reservationStmt = $dbhconnect->connection()->prepare($reservationQuery);
            $reservationStmt->bindParam(":quantity", $quantity, PDO::PARAM_INT);
            $reservationStmt->bindParam(":total_cost", $totalCost, PDO::PARAM_INT);
            $reservationStmt->bindParam(":seats_chosen", serialize($seatsChosen), PDO::PARAM_STR);
            $reservationStmt->bindParam(":time_selected", $timeWithoutAMPM, PDO::PARAM_STR);
            $reservationStmt->bindParam(":reference_id", $referenceID, PDO::PARAM_STR);
            $reservationStmt->bindParam(":customer_id", $customerID, PDO::PARAM_INT);
            $reservationStmt->bindParam(":cinema_id", $cinemaID, PDO::PARAM_INT);

            if (!$reservationStmt->execute()) {
                throw new Exception("Failed to insert movie data");
                header('Location: confirmation?error=database.php');
            }

            $reservationIDQuery = "SELECT id FROM reservation ORDER BY id DESC LIMIT 1;";
            $resIDstmt = $dbhconnect->connection()->prepare($reservationIDQuery);
            $resIDstmt->execute();
            $reservationIDResult = $resIDstmt->fetch(PDO::FETCH_ASSOC);

            if (!$resIDstmt->execute()) {
                throw new Exception("Failed to get movie data");
                header('Location: confirmation?error=database.php');
            }

            //Payment Data Variables
            $method = $_POST['methods'];
            $status = 'pending';
            $reservationID = $reservationIDResult['id'];

            $paymentQuery = "INSERT INTO payment (method, status, reservation_id) VALUES (:method, :status, :reservation_id);";
            $paymentStmt = $dbhconnect->connection()->prepare($paymentQuery);
            $paymentStmt->bindParam(":method", $method, PDO::PARAM_STR);
            $paymentStmt->bindParam(":status", $status, PDO::PARAM_STR);
            $paymentStmt->bindParam(":reservation_id", $reservationID, PDO::PARAM_INT);

            if (isset($method)) {
                $str = $method;
                $str = str_replace("-", " ", $str);
                $sentenceMethod = ucwords($str);
                $sentenceStatus = ucwords($status);
                $_SESSION['reference-id'] = $referenceID;
                $_SESSION['method'] = $sentenceMethod;
                $_SESSION['status'] = $sentenceStatus;
            }

            if (!$paymentStmt->execute()) {
                throw new Exception("Failed to get movie data");
                header('Location: confirmation?error=database.php');
            } else {

                header('Location: summary.php');
            }
        } catch (\Throwable $th) {
            die("Query Failed. " . $th->getMessage());
        }
    }
}
      ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php include_once '../../includes/css_links.php'?>
  <link rel="stylesheet" href="../../public/css/Customer/confirmation.css">
  <title>Confirmation</title>
</head>
<body>
  <?php include '../../includes/navbar.php'?>

  <form action="" method="post" class="form flex">
      <section class="selection-group flex">
        <h3 class="selection">1. Book Tickets</h3>
        <h3 class="selection">2. Select Seats</h3>
        <h3 class="selection current">3. Confirm</button>
        <h3 class="selection">4. Booking Successful</h3>
      </section>

      <section class="ticket-contents flex">
        <div class="poster-container">
          <img class="poster" src="/public/images/<?php echo $_SESSION['poster'] ?>" alt="">
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
            <h3 class="chosen"><?php echo $_SESSION['quantity'] ?> Tickets</h3>
            <label class="ticket-labels">Total Cost:</label>
            <h3 class="chosen">₱<?php echo $_SESSION['cost-plus-tax'] ?>.00</h3>
            <label for="ticket-labels">Selected Seats</label>
            <h3 class="chosen">
              <?php
if (isset($_SESSION['seats-selected'])) {
    $seats = $_SESSION['seats-selected'];
    $lastIndex = count($seats) - 1;
    $seatString = '';
    foreach ($seats as $index => $seat) {
        if ($index === $lastIndex) {
            $seatString .= $seat; // Add the last seat without a comma
        } else {
            $seatString .= $seat . ", "; // Add the seat followed by a comma
        }
    }
    echo $seatString;
}?></h3>
          </div>
        </div>
    </section>
      <hr class="line">

      <section class="personal-details flex">
        <h2 class="titles">Personal Details</h2>
        <div class="flex personal-input">
          <div class="flex input-div">
            <label class="label" for="fname">First Name <span class="red">*</span></label>
            <input id="fname" class="input-details" type="text" name="first-name" value="<?php echo $_SESSION['first-name'] ?? null ?>" placeholder="First Name">
          </div>
          <div class="flex input-div">
            <label class="label" for="lname">Last Name <span class="red">*</span></label>
            <input id="lname" class="input-details" type="text" name="last-name" value="<?php echo $_SESSION['last-name'] ?? null ?>" placeholder="Last Name">
          </div>
          <div class="flex input-div">
            <label class="label"  for="email">Email <span class="red">*</span></label>
            <input id="input-details" class="input-details" type="text" name="email" value="<?php echo $_SESSION['email'] ?? null ?>" value="" placeholder="Email">
          </div>

          <div class="flex input-div">
            <label class="label"  for="number">Phone Number <span class="red">*</span></label>
            <input id="number" class="input-details" type="text" name="phone-number" value="<?php echo $_SESSION['phone-number'] ?? null ?>" id="" placeholder="Phone Number">
          </div>
        </div>
      </section>

      <section class="payment-section">
        <h2 class="titles">Payment Method</h2>

        <section class="flex methods-section">
          <div class="flex current-status">
            <h3 class="payment-methods">Available Methods</h3>
            <label for="cash" class="methods flex">
              <label for="cash">Over-the-counter</label>
              <input class="radio" type="radio" name="methods" value="over-the-counter" id="cash">
            </label>
          </div>

          <div class="flex current-status">
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
        </section>

      </section>

      <section class="button-operations">
        <button class="go-back" name="buttons" value="cancel" >Go Back</button>
        <button class="proceed" name="buttons" value="confirm" >Confirm</button>
      </section>
    </form>
</body>
</html>