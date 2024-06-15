<?php
session_start();
include_once '../../classes/dbh.class.php';
$dbhconnect = new Dbh();

if (isset($_GET['cinema'])) {
  $number = $_GET['cinema'];
  $title = $_GET['title'];
  $seatAvail = $_GET['available'];
}

try {
  $query = "SELECT reservation.*, customer.first_name, customer.last_name, customer.user_type FROM reservation JOIN customer ON reservation.customer_id = customer.id WHERE reservation.status = 'pending';";
  $stmt = $dbhconnect->connection()->prepare($query);
  $stmt->execute();
  $results = $stmt->fetchALL(PDO::FETCH_ASSOC) ?? null;
} catch (\Throwable $th) {
  //throw $th;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php include_once '../../includes/css_links.php'?>
  <link rel="stylesheet" href="../../public/css/Admin/pending-payment.css">
  <title>Pending Payments</title>
</head>
<body>
  <?php include_once '../../includes/navbar.php';?>

  <main>
    <section class="header">
    <a href="landing.php"><button class="return">Return</button></a>
      <div class="title-section">
        <h1>Pending Payments</h1>
        <div class="seats-avail">
          <p class="grey">Seats Available: <span class="white">80</span></p>
          <button>Available Seats</button>          
        </div>
      </div>
      <div class="header-container">
        <p class="movie-info grey">Movie Name: <span class="details white"><?php echo $title?></span></p>
        <p class="movie-info grey">Screen Location: <span class="details white">Cinema <?php echo $number?></span></p>
        <p class="movie-info grey">Current Showtime: <span class="details white">12:30</span></p>
      </div>   
    </section>

    <?php if (!$results) {
      echo "<p class='container'>No one reserved a ticket yet!</p>";
}else {
    foreach($results as $key) {?>
        <section class="container">
          <div class="info-container">
            <div class="info-div">
              <p class="grey p-info">Member <span class="white">Samm Caagbay</span></p>
              <p class="grey p-info">Total Amount: <span class="white">$3240</span></p>
              <p class="grey p-info">Reference I.D.: <span class="white">12345678</span></p>
              <p class="grey p-info">Seat/s Booked: <button class="white seats"><a href="seats_chosen.php">8 seats</a></button></p>
              <p class="grey p-info">Time Slot: <span class="white">12:30</span></p>
              <p class="grey p-info">Time Booked: <span class="white">June 1, 2023 10:30 A.M.</span></p>
            </div>
            <div class="buttons">
              <button class="green-bg">Approve</button>
              <button class="yellow-bg">Edit Ticket</button>
              <button class="red-bg">Reject</button>
            </div>
          </div>
        </section>
      <?php } }?>
  </main>
</body>
</html>