<?php
include_once '../../classes/dbh.class.php';
$dbhconnect = new Dbh();
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

} catch (\Throwable $th) {
die("Query Failed. " . $th->getMessage());
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

  <main>
    <a href="landing.php"><button class="return">Return</button></a>
    <section class="header">
      <h1 class="title">Update Schedules</h1>
    </section>

    <section>
      <h1 class="title2">Now Showing</h1>
      <?php foreach ($nowResults as $now) {?>
        <section class="container">
          <div class="info-container">
            <div class="info-div">
              <p class="grey p-info">Movie Title <span class="white"><?php echo htmlspecialchars($now['title'])?></span></p>
              <p class="grey p-info">Status: <span class="white"><?php echo ucwords(htmlspecialchars($now['status'])) ?></span></p>
              <p class="grey p-info">Screen Location: <span class="white">Cinema <?php echo htmlspecialchars($now['number'])?></span></p>
            </div>
            <div class="buttons">
              <button class="green-bg">Stash</button>
              <button class="red-bg">Move to Next Picture</button>
            </div>
          </div>
        </section>
        <?php }?>
      </section>
      
    <section>
      <h1 class="title2">Next Picture</h1>
      <?php foreach ($nextResults as $next) {?>
      <section class="container">
        <div class="info-container">
          <div class="info-div">
              <p class="grey p-info">Movie Title <span class="white"><?php echo htmlspecialchars($next['title'])?></span></p>
              <p class="grey p-info">Status: <span class="white"><?php echo ucwords(htmlspecialchars($next['status'])) ?></span></p>
              <p class="grey p-info">Screen Location: <span class="white"><?php echo htmlspecialchars($next['number'] ?? "Not Currently Showing")?></span></p>
          </div>
          <div class="buttons">
            <button class="green-bg">Move to Now Showing</button>
            <button class="red-bg">Move to Coming Soon</button>
          </div>
        </div>
      </section>
      <?php }?>
    </section>

    <section>
      <h1 class="title2">Coming Soon</h1>
      <?php foreach ($comingResults as $coming) {?>
      <section class="container">
        <div class="info-container">
          <div class="info-div">
              <p class="grey p-info">Movie Title <span class="white"><?php echo htmlspecialchars($coming['title'])?></span></p>
              <p class="grey p-info">Status: <span class="white"><?php echo ucwords(htmlspecialchars($coming['status'] ?? "Not Currently Showing")) ?></span></p>
              <p class="grey p-info">Screen Location: <span class="white"><?php echo htmlspecialchars($coming['number'] ?? "Not Currently Showing")?></span></p>
          </div>
          <div class="buttons">
            <button class="green-bg">Move to Next Picture</button>
            <button class="red-bg">Move to Upcoming Movies</button>
          </div>
        </div>
      </section>
      <?php }?>
    </section>

    <section>
      <h1 class="title2">Upcoming Movies</h1>
      <?php foreach ($upResults as $up) {?>
      <section class="container">
        <div class="info-container">
          <div class="info-div">
              <p class="grey p-info">Movie Title <span class="white"><?php echo htmlspecialchars($up['title'])?></span></p>
              <p class="grey p-info">Status: <span class="white"><?php echo ucwords(htmlspecialchars($up['status'])) ?></span></p>
              <p class="grey p-info">Screen Location: <span class="white"><?php echo htmlspecialchars($up['number'] ?? "Not Currently Showing")?></span></p>
          </div>
          <div class="buttons">
            <button class="green-bg">Move to Coming Soon</button>
            <button class="red-bg">Move to Stashed</button>
          </div>
        </div>
      </section>
      <?php }?>
    </section>
  </main>
</body>
</html>