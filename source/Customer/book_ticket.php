<?php
session_start();
include_once '../../classes/dbh.class.php';
$dbhconnect = new Dbh();
$movieID = $_GET['movie-id'] ?? ($_SESSION['movie-id'] ?? null);
$movieTime = $_GET['time'] ?? null;
$time = $_GET['time-option'] ?? $_SESSION['time-selected'] ?? "None";
$buttons = $_GET['book-buttons'] ?? 'Check';

try {
    $query = "SELECT movie.id, movie.title, movie.poster, cinema.time_start FROM movie JOIN cinema ON movie.id = cinema.movie_id WHERE movie.id = :movieID;";
    $nowStmt = $dbhconnect->connection()->prepare($query);
    $nowStmt->bindParam(":movieID", $movieID, PDO::PARAM_STR);
    $nowStmt->execute();
    $nowResults = $nowStmt->fetchALL(PDO::FETCH_ASSOC);

    $singleStmt = $dbhconnect->connection()->prepare($query);
    $singleStmt->bindParam(":movieID", $movieID, PDO::PARAM_STR);
    $singleStmt->execute();
    $singleNow = $singleStmt->fetch(PDO::FETCH_ASSOC);

    $ticketQuery = "SELECT DISTINCT movie.id, ticket.cost, cinema.number FROM movie JOIN cinema ON movie.id = cinema.movie_id JOIN ticket ON cinema.number = ticket.id WHERE movie.id = :movieID;";
    $tickStmt = $dbhconnect->connection()->prepare($ticketQuery);
    $tickStmt->bindParam(":movieID", $movieID, PDO::PARAM_STR);
    $tickStmt->execute();
    $tickResults = $tickStmt->fetchALL(PDO::FETCH_ASSOC);
} catch (\Throwable $th) {
    die("Query Failed. " . $th->getMessage());
}

if (isset($buttons)) {
    if ($buttons === 'cancel') {
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

    } elseif ($buttons === 'Check') {
        $quantity = $_GET['quantity'] ?? 0;
        $cost = $_GET['cost'] ?? 0;
        $product = $cost * $quantity;
        $PlusTax = $product + 40;
        if ($PlusTax > 40) {
            $_SESSION['quantity'] = $quantity;
            $_SESSION['cost-plus-tax'] = $PlusTax;
            $buttons = 'Proceed';
        }
    } elseif ($buttons === 'Proceed') {
        header('Location: seat_selection.php');
    }
}
$_SESSION['time-selected'] = $time;
?>

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

        <?php if ($singleNow) {?>
          <form action="" method="get" class="current-contents flex">
            <div class="poster-container">

              <img src="../../public/images/<?php echo htmlspecialchars($singleNow['poster']);
    $_SESSION['poster'] = $singleNow['poster'];
    $_SESSION['movie-id'] = $singleNow['id'] ?>" alt="">
            </div>

        <div class="movie-details flex">
          <h1 class="title"><?php echo htmlspecialchars($singleNow['title']);
    $_SESSION['title'] = $singleNow['title'] ?? null; ?></h1>
        <?php }?>
        <section class="below-title">
          <?php foreach ($tickResults as $key) {?>
            <input type="hidden" name="cost" value="<?php echo htmlspecialchars($key['cost']);
    $_SESSION['cinema-number'] = $key['number'] ?? null ?>" id="">
            <h1 class="price">₱<?php echo htmlspecialchars($key['cost']) ?></h1>
          <?php }?>
          <section class="timeslot">
            <h2 class="sec-head">Select Time Slot</h2>
            <h3 class="sec-desc">Select the time slot you wish to watch.</h3>
            <div class="times-container flex">

              <?php foreach ($nowResults as $key) {
    $timeFromDbh = $key['time_start'];
    $timestamp = strtotime($timeFromDbh);
    $formattedTime = date("h:i A", $timestamp);
    $finalTime = str_replace('AM', 'PM', $formattedTime);
    ?>
                  <input type="hidden" name="movie-id" value="<?php echo htmlspecialchars($key['id']) ?>" id="">
                  <button disabled name="time" value="<?php echo $finalTime ?>"><?php echo htmlspecialchars($finalTime) ?></button>
                <?php
}?>
            </div>
            <label class="time-desc" for="">Click Here!</label>
            <select name="time-option" class="time-option" id="">
              <option value="none"></option>
                <?php foreach ($nowResults as $key) {
    $timeFromDbh = $key['time_start'];
    $timestamp = strtotime($timeFromDbh);
    $formattedTime = date("h:i A", $timestamp);
    $finalTime = str_replace('AM', 'PM', $formattedTime);
    ?>
            <option value="<?php echo $finalTime; ?>" <?php echo ($finalTime == $time) ? 'selected' : ''; ?>><?php echo $finalTime; ?></option>                <?php
}?>
            </select>
            <p class="time-desc">You have selected: <span class="white"><?php echo htmlspecialchars($time); ?></span></p>

          </section>

          <div class="tickets">
            <h2 class="sec-head">Select Tickets</h2>
            <h3 class="sec-desc">Select the number of tickets you wish to buy.</h3>

            <div class="quant-div">
              <h4 class="sect-title">Quantity</h4>

              <div class="quantity-div flex">
                <h6 class="operators minus">-</h6>
                <input type="number" class="input" name="quantity" value="<?php echo $_SESSION['quantity'] ?? 0 ?>">
                <h6 class="operators plus">+</h6>
              </div>
              <h6 class="info-quant">*You can buy a maximum of 8 tickets per transaction*</h6>

            </div>

            <div class="total-div">
              <h4 class="sect-title">Total Cost</h4>
              <p class="total">₱<?php echo $product ?? 0 ?>.00 + ₱40.00 <span class="book-fee">(Booking fee)</span> = <span class="total-plus-fee">₱<?php echo $_SESSION['cost-plus-tax'] ?? 0; ?>.00</span></p>
            </div>
          </div>
        </section>

        <div class="button-operations">
          <button class="go-back" name="book-buttons" value="cancel">Cancel</button>
          <button class="proceed" name="book-buttons" value="<?php echo $buttons ?>"><?php echo $buttons ?></button>
        </div>
      </div>
    </form>
  </main>
</body>
</html>