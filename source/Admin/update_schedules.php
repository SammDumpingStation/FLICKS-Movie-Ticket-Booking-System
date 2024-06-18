<?php
include_once '../../classes/dbh.class.php';
$dbhconnect = new Dbh();
session_start();
try {
    $nowShowing = "SELECT DISTINCT movie.*, cinema.number, movie_status.status FROM movie LEFT JOIN cinema ON movie.id = cinema.movie_id LEFT JOIN movie_status ON movie.id = movie_status.movie_id WHERE movie_status.status = 'now showing' ORDER BY cinema.number";
    $nowStmt = $dbhconnect->connection()->prepare($nowShowing);
    $nowStmt->execute();
    $nowResults = $nowStmt->fetchALL(PDO::FETCH_ASSOC);

    $nextPicture = "SELECT DISTINCT movie.*, cinema.number, movie_status.status FROM movie LEFT JOIN cinema ON movie.id = cinema.movie_id LEFT JOIN movie_status ON movie.id = movie_status.movie_id  WHERE movie_status.status = 'next picture'";
    $nextStmt = $dbhconnect->connection()->prepare($nextPicture);
    $nextStmt->execute();
    $nextResults = $nextStmt->fetchALL(PDO::FETCH_ASSOC);

    $comingSoon = "SELECT DISTINCT movie.*, cinema.number, movie_status.status FROM movie LEFT JOIN cinema ON movie.id = cinema.movie_id LEFT JOIN movie_status ON movie.id = movie_status.movie_id  WHERE movie_status.status = 'coming soon'";
    $comingStmt = $dbhconnect->connection()->prepare($comingSoon);
    $comingStmt->execute();
    $comingResults = $comingStmt->fetchALL(PDO::FETCH_ASSOC);

    $upcoming = "SELECT DISTINCT movie.*, cinema.number, movie_status.status FROM movie LEFT JOIN cinema ON movie.id = cinema.movie_id LEFT JOIN movie_status ON movie.id = movie_status.movie_id  WHERE movie_status.status = 'upcoming movies'";
    $upStmt = $dbhconnect->connection()->prepare($upcoming);
    $upStmt->execute();
    $upResults = $upStmt->fetchALL(PDO::FETCH_ASSOC);

    $stashed = "SELECT DISTINCT movie.*, cinema.number, movie_status.status FROM movie LEFT JOIN cinema ON movie.id = cinema.movie_id LEFT JOIN movie_status ON movie.id = movie_status.movie_id  WHERE movie_status.status = 'stashed'";
    $stashedStmt = $dbhconnect->connection()->prepare($stashed);
    $stashedStmt->execute();
    $stashedResults = $stashedStmt->fetchALL(PDO::FETCH_ASSOC);

} catch (\Throwable $th) {
    die("Query Failed. " . $th->getMessage());
}

$return = $_GET['return'] ?? null;
if ($return === 'return') {
    header("Location: landing.php");
}
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['movie-id']) && isset($_GET['button-value'])) {
    $movieIDs = $_GET['movie-id'];
    $buttonValues = $_GET['button-value'];

    foreach ($movieIDs as $id) {
        if (isset($buttonValues[$id])) {
            $buttonValue = $buttonValues[$id];

            try {
                if ($buttonValue === 'move-to-stashed') {
                    $query = "UPDATE movie_status SET status = 'stashed' WHERE movie_id = :id";
                } elseif ($buttonValue === 'move-to-now') {
                    $query = "UPDATE movie_status SET status = 'now showing' WHERE movie_id = :id";
                } elseif ($buttonValue === 'move-to-next') {
                    $query = "UPDATE movie_status SET status = 'next picture' WHERE movie_id = :id";
                } elseif ($buttonValue === 'move-to-coming') {
                    $query = "UPDATE movie_status SET status = 'coming soon' WHERE movie_id = :id";
                } elseif ($buttonValue === 'move-to-upcoming') {
                    $query = "UPDATE movie_status SET status = 'upcoming movies' WHERE movie_id = :id";
                }

                $stmt = $dbhconnect->connection()->prepare($query);
                $stmt->bindParam(":id", $id, PDO::PARAM_INT);
                if (!$stmt->execute()) {
                    throw new Exception("Failed to update movie status");
                } else {
                    header('Location: update_schedules.php');
                }
            } catch (\Throwable $th) {
                die("Update Failed. " . $th->getMessage());
            }
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
  <link rel="stylesheet" href="../../public/css/Admin/update-schedules.css">
  <title>Update Schedules</title>
</head>
<body>
  <?php include_once '../../includes/navbar.php';?>

  <form action="" method="get">
    <button class="return" name="return" value="return">Return</button>
    <section class="header">
      <h1 class="title">Update Schedules</h1>
    </section>

    <section class="sections">
      <h1 class="title2">Now Showing</h1>
      <?php 
      if (!$nowResults) {
      echo "<section class='container'><div class='info-container'>Admin as not added anything yet</div></section>";     
      } else { foreach ($nowResults as $now) {?>
        <section class="container">
          <div class="info-container">
            <div class="info-div">
              <input type="hidden" name="movie-id[]" value="<?php echo $now['id'] ?>" id="">
              <p class="grey p-info">Movie Title <span class="white"><?php echo htmlspecialchars($now['title']) ?></span></p>
              <p class="grey p-info">Status: <span class="white"><?php echo ucwords(htmlspecialchars($now['status'])) ?></span></p>
              <p class="grey p-info">Screen Location: <span class="white">Cinema <?php echo htmlspecialchars($now['number'] ?? "Not yet set") ?></span></p>
            </div>
            <div class="buttons">
              <button class="green-bg" name="button-value[<?php echo $now['id'] ?>]" value="move-to-stashed">Stash</button>
              <button class="red-bg" name="button-value[<?php echo $now['id'] ?>]" value="move-to-next">Move to Next Picture</button>
            </div>
          </div>
        </section>
        <?php } }?>
      </section>

    <section class="sections">
      <h1 class="title2">Next Picture</h1>
      <?php 
      if (!$nextResults) {
      echo "<section class='container'><div class='info-container'>Admin as not added anything yet</div></section>";     
      } else { foreach ($nextResults as $next) {?>
      <section class="container">
        <div class="info-container">
          <div class="info-div">
              <input type="hidden" name="movie-id[]" value="<?php echo $next['id'] ?>" id="">
              <p class="grey p-info">Movie Title <span class="white"><?php echo htmlspecialchars($next['title']) ?></span></p>
              <p class="grey p-info">Status: <span class="white"><?php echo ucwords(htmlspecialchars($next['status'])) ?></span></p>
              <p class="grey p-info">Screen Location: <span class="white"><?php echo htmlspecialchars($next['number'] ?? "Not Currently Showing") ?></span></p>
          </div>
          <div class="buttons">
            <button class="green-bg" name="button-value[<?php echo $next['id'] ?>]" value="move-to-now">Move to Now Showing</button>
            <button class="red-bg" name="button-value[<?php echo $next['id'] ?>]" value="move-to-coming">Move to Coming Soon</button>
          </div>
        </div>
      </section>
      <?php } }?>
    </section>

    <section class="sections">
      <h1 class="title2">Coming Soon</h1>
      <?php 
      if (!$comingResults) {
      echo "<section class='container'><div class='info-container'>Admin as not added anything yet</div></section>";     
      } else { foreach ($comingResults as $coming) {?>
      <section class="container">
        <div class="info-container">
          <div class="info-div">
              <input type="hidden" name="movie-id[]" value="<?php echo $coming['id'] ?>" id="">
              <p class="grey p-info">Movie Title <span class="white"><?php echo htmlspecialchars($coming['title']) ?></span></p>
              <p class="grey p-info">Status: <span class="white"><?php echo ucwords(htmlspecialchars($coming['status'] ?? "Not Currently Showing")) ?></span></p>
              <p class="grey p-info">Screen Location: <span class="white"><?php echo htmlspecialchars($coming['number'] ?? "Not Currently Showing") ?></span></p>
          </div>
          <div class="buttons">
            <button class="green-bg" name="button-value[<?php echo $coming['id'] ?>]" value="move-to-next">Move to Next Picture</button>
            <button class="red-bg" name="button-value[<?php echo $coming['id'] ?>]" value="move-to-upcoming">Move to Upcoming Movies</button>
          </div>
        </div>
      </section>
      <?php } }?>
    </section>

    <section class="sections">
      <h1 class="title2">Upcoming Movies</h1>
      <?php 
      if (!$upResults) {
      echo "<section class='container'><div class='info-container'>Admin as not added anything yet</div></section>";     
      } else { foreach ($upResults as $up) {?>
      <section class="container">
        <div class="info-container">
          <div class="info-div">
              <input type="hidden" name="movie-id[]" value="<?php echo $up['id'] ?>" id="">
              <p class="grey p-info">Movie Title <span class="white"><?php echo htmlspecialchars($up['title']) ?></span></p>
              <p class="grey p-info">Status: <span class="white"><?php echo ucwords(htmlspecialchars($up['status'])) ?></span></p>
              <p class="grey p-info">Screen Location: <span class="white"><?php echo htmlspecialchars($up['number'] ?? "Not Currently Showing") ?></span></p>
          </div>
          <div class="buttons">
            <button class="green-bg" name="button-value[<?php echo $up['id'] ?>]" value="move-to-coming">Move to Coming Soon</button>
            <button class="red-bg"name="button-value[<?php echo $up['id'] ?>]" value="move-to-stashed" >Move to Stashed</button>
          </div>
        </div>
      </section>
      <?php } }?>
    </section>

    <section class="sections">
      <h1 class="title2">Stashed Movies</h1>
      <?php 
      if (!$stashedResults) {
      echo "<section class='container'><div class='info-container'>Admin as not added anything yet</div></section>";     
    } else{
    foreach ($stashedResults as $stashed) {?>
      <section class="container">
        <div class="info-container">
          <div class="info-div">
              <input type="hidden" name="movie-id[]" value="<?php echo $stashed['id'] ?>" id="">
              <p class="grey p-info">Movie Title <span class="white"><?php echo htmlspecialchars($stashed['title']) ?></span></p>
              <p class="grey p-info">Status: <span class="white"><?php echo ucwords(htmlspecialchars($stashed['status'])) ?></span></p>
              <p class="grey p-info">Screen Location: <span class="white"><?php echo htmlspecialchars($stashed['number'] ?? "Not Currently Showing") ?></span></p>
          </div>
          <div class="buttons">
            <button class="green-bg" name="button-value[<?php echo $stashed['id'] ?>]" value="move-to-now">Move to Now Showing</button>
            <button class="red-bg"name="button-value[<?php echo $stashed['id'] ?>]" value="move-to-upcoming">Move to Upcoming Movies</button>
          </div>
        </div>
      </section>
      <?php } } ?>
    </section>
  </form>
</body>
</html>