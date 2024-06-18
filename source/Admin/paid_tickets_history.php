<?php
session_start();
include_once '../../classes/dbh.class.php';
$dbhconnect = new Dbh();

try {
    $query = "SELECT DISTINCT reservation.*, customer.first_name, customer.last_name, movie.title FROM reservation JOIN customer ON reservation.customer_id = customer.id JOIN cinema ON reservation.cinema_id = cinema.number JOIN movie ON cinema.movie_id = movie.id WHERE status = 'paid';";
    $stmt = $dbhconnect->connection()->prepare($query);
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
  <link rel="stylesheet" href="../../public/css/Admin/paid-tickets.css">
  <title>Paid Tickets History</title>
</head>
<body>
  <?php include_once '../../includes/navbar.php';?>

  <main>
    <a href="landing.php"><button class="return">Return</button></a>
    <h1 class="title">Paid Tickets History</h1>
    <section class="container">
      <?php foreach ($results as $key) {?>
      <div class="info-container">
        <div class="info-div">
          <p class="grey p-info">Customer:<span class="white"><?php echo $key['first_name'] . " " . $key['last_name']?></span></p>
          <p class="grey p-info">Movie:<span class="white"><?php echo $key['title']?></span></p>
          <p class="grey p-info">Status:<span class="white"><?php echo ucwords($key['status'])?></span></p>
          <p class="grey p-info">Total Cost:<span class="white">₱<?php echo $key['total_cost']?></span></p>
        </div>
      </div>
      <?php }?>
    </section>
  </main>
</body>
</html>