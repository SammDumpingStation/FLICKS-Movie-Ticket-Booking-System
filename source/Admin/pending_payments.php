<?php
session_start();
include_once '../../classes/dbh.class.php';
$dbhconnect = new Dbh();

$number = $_GET['cinema-number'] ?? $_SESSION['number'] ?? null;
$title = $_GET['title'] ?? $_SESSION['title'] ?? null;
$seatAvail = $_GET['available'] ?? $_SESSION['seatsAvail'] ?? null;
$_SESSION['title'] = $title;
$_SESSION['number'] = $number;
$_SESSION['seatsAvail'] = $seatAvail;
$buttons = $_GET['buttons'] ?? null;
$id = $_GET['reservation-id'] ?? null;

if (isset($buttons)) {
    if ($buttons === 'approve') {
        $query = "UPDATE reservation SET status = 'paid' WHERE id = :id;";
        $updateStatusStmt = $dbhconnect->connection()->prepare($query);
        $updateStatusStmt->bindParam(":id", $id, PDO::PARAM_INT);
        if (!$updateStatusStmt->execute()) {
            throw new Exception("Failed to update movie status");
        } else {
            header('Location: pending_payments.php?=approved');
        }

    } elseif ($buttons === 'reject') {
        $query = "UPDATE reservation SET status = 'rejected' WHERE id = :id; ";
        $updateStatusStmt = $dbhconnect->connection()->prepare($query);
        $updateStatusStmt->bindParam(":id", $id, PDO::PARAM_INT);
        if (!$updateStatusStmt->execute()) {
            throw new Exception("Failed to update movie status");
        } else {
            header('Location: pending_payments.php?=rejected');
        }

    }
}

try {
    $query = "SELECT reservation.*, customer.first_name, customer.last_name, customer.user_type FROM reservation JOIN customer ON reservation.customer_id = customer.id WHERE reservation.status = 'pending' AND reservation.cinema_id = :id;";
    $stmt = $dbhconnect->connection()->prepare($query);
    $stmt->bindParam(":id", $number, PDO::PARAM_INT);
    $stmt->execute();
    $results = $stmt->fetchALL(PDO::FETCH_ASSOC) ?? null;

} catch (\Throwable $th) {
    die("Update Failed. " . $th->getMessage());
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
      </div>
      <div class="header-container">
        <p class="movie-info grey">Movie Name: <span class="details white"><?php echo $title ?></span></p>
        <p class="movie-info grey">Screen Location: <span class="details white">Cinema <?php echo $number ?></span></p>
        <p class="movie-info grey">Showtime Start: <span class="details white">12:30 P.M.</span></p>
      </div>
    </section>

    <?php if (!$results) {
    echo "<p class='container'>No one reserved a ticket yet!</p>";
} else {
    foreach ($results as $key) {?>
        <form action="" method="get" class="container">
          <div class="info-container">
            <div class="info-div">
              <p class="grey p-info">Member <span class="white"><?php echo $key['first_name'] . " " . $key['last_name'] ?></span></p>
              <p class="grey p-info">Total Amount: <span class="white">₱<?php echo $key['total_cost'] ?></span></p>
              <p class="grey p-info">Reference I.D.: <span class="white"><?php echo $key['reference_id'] ?></span></p>
              <p class="grey p-info">Seat/s Booked: <button class="white seats"><a href="seats_chosen.php"><?php echo $key['quantity'] ?> seat/s</a></button></p>
              <p class="grey p-info">Time Slot: <span class="white"><?php echo $key['time_selected'] ?></span></p>
              <p class="grey p-info">Time Booked: <span class="white"><?php echo $key['date_reserved'] ?></span></p>
            </div>
            <div class="buttons">
              <input type="hidden" name="reservation-id" value="<?php echo $key['id'] ?>">
              <button class="green-bg" name="buttons" value="approve">Approve</button>
              <button class="red-bg" name="buttons" value="reject">Reject</button>
            </div>
          </div>
        </form>
      <?php }
}?>
  </main>
</body>
</html>