<?php
session_start();
include_once '../../classes/dbh.class.php';
$dbhconnect = new Dbh();

function formatDuration($minutes)
{
    $hours = floor($minutes / 60);
    $remainingMinutes = $minutes % 60;
    return $hours . 'hr ' . $remainingMinutes . 'min';
}

$id = $_GET['movie-id'] ?? ($_SESSION['movie-id'] ?? null);
$_SESSION['movie-id'] = $id;
try {
    $query = "SELECT DISTINCT movie.*, movie_status.status, cinema.number FROM movie LEFT JOIN movie_status ON movie.id = movie_status.movie_id LEFT JOIN cinema ON movie.id = cinema.movie_id WHERE movie.id = :id";
    $stmt = $dbhconnect->connection()->prepare($query);
    $stmt->bindParam(":id", $id, PDO::PARAM_INT);
    $stmt->execute();
    $results = $stmt->fetchALL(PDO::FETCH_ASSOC);
} catch (\Throwable $th) {
die("Query Failed. " . $th->getMessage());
}

$button = $_GET['buttons'] ?? null;
if (isset($button)) {
    if ($button === 'go-back' || $button === 'okay') {
        header('Location: landing.php');
    } elseif ($button === 'reserve') {
        header('Location: book_ticket.php');
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php include_once '../../includes/css_links.php'?>
  <link rel="stylesheet" href="../../public/css/Customer/movie-info.css">
  <title>Movie Information</title>
</head>
<body>
  <?php include_once '../../includes/navbar.php';?>

  <?php foreach ($results as $key) {?>
  <form action="" method="get" class="form flex">
    <div class="main">
      <section class="poster-left flex">
        <div class="poster-container">
          <img class="poster" src="/public/images/<?php echo $key['poster']?>" alt="">
        </div>
        <?php if (!$key) {?>
        <h2 class="screen">Not Yet Showing</h2>
        <?php } else{?>
        <h2 class="screen">Cinema <?php echo $key['number']?></h2>
        <?php }?>
      </section>

      <section class="details-right flex">
          <div class="title-container flex">
            <h1 class="movie-title"><?php echo $key['title'] ?></h1>
            <h3 class="rating">Rating: (<?php echo $key['rating_score'] ?>/10)</h3>
          </div>
          <div class="mini-info flex">
            <button class="info"><?php echo $key['age_rating'] ?></button>
            <button class="info"><?php echo $key['dimension'] ?></button>
            <button class="info"><?php echo $formattedDuration = formatDuration($key['length']);?></button>
          </div>

          <p class="description"><?php echo $key['description']?></p>

          <div class="showtime-div flex">
            <h2 class="showtime-title">Show Times</h2>
            <h6 class="showtime-date">May 30, 2024</h6>
            
            <div class="times-container flex">
            <?php $movie_ID = $key['id'];
                  $queryShowTimes = "SELECT time_start FROM cinema WHERE movie_id = :movieID";
                  $stmt = $dbhconnect->connection()->prepare($queryShowTimes);
                  $stmt->bindParam(":movieID", $movie_ID, PDO::PARAM_INT);
                  $stmt->execute();
                  $timeResult = $stmt->fetchAll(PDO::FETCH_ASSOC);
                  ?>
            <?php if (empty($timeResult)) {?>
                    <h5 class="showtime flex">Not Currently Showing</h5>
                    <?php } else {
                    foreach ($timeResult as $time) {
                        $timeFromDbh = $time['time_start'];
                        $timestamp = strtotime($timeFromDbh);
                        $formattedTime = date("h:i A", $timestamp);
                        $finalTime = str_replace('AM', 'PM', $formattedTime);?>
                        <h5 class="showtimes flex"><?php echo htmlspecialchars($finalTime)?></h5></h6>
                        <?php }
                          }?>
            </div>
          </div>
      </section>
    </div>

    <div class="button-operations">
      <button class="go-back" name="buttons" value="go-back">Cancel</button>
      <?php if ($key['status'] === 'now showing') {?>
      <button class="proceed" name="buttons" value="reserve">Reserve Now</button>
      <?php } else{?>
      <button class="proceed" name="buttons" value="okay">Confirm</button>
        <?php }?>
    </div>
  </form>
  <?php }?> 
</body>
</html>