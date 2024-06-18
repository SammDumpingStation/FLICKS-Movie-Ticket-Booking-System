<?php
session_start();
include_once '../../classes/dbh.class.php';
$dbhconnect = new Dbh();
try {
    $nowShowing = "SELECT DISTINCT movie.id, movie.title, movie.poster, cinema.number, movie_status.status FROM movie LEFT JOIN cinema ON movie.id = cinema.movie_id LEFT JOIN movie_status ON movie.id = movie_status.movie_id WHERE movie_status.status = 'now showing' ORDER BY cinema.number";
    $nowStmt = $dbhconnect->connection()->prepare($nowShowing);
    $nowStmt->execute();
    $nowResults = $nowStmt->fetchALL(PDO::FETCH_ASSOC);

    $nextPicture = "SELECT DISTINCT movie.id, movie.title, movie.poster, cinema.number, movie_status.status FROM movie LEFT JOIN cinema ON movie.id = cinema.movie_id LEFT JOIN movie_status ON movie.id = movie_status.movie_id  WHERE movie_status.status = 'next picture'";
    $nextStmt = $dbhconnect->connection()->prepare($nextPicture);
    $nextStmt->execute();
    $nextResults = $nextStmt->fetchALL(PDO::FETCH_ASSOC);

    $comingSoon = "SELECT DISTINCT movie.id, movie.title, movie.poster, cinema.number, movie_status.status FROM movie LEFT JOIN cinema ON movie.id = cinema.movie_id LEFT JOIN movie_status ON movie.id = movie_status.movie_id  WHERE movie_status.status = 'coming soon'";
    $comingStmt = $dbhconnect->connection()->prepare($comingSoon);
    $comingStmt->execute();
    $comingResults = $comingStmt->fetchALL(PDO::FETCH_ASSOC);

} catch (\Throwable $th) {
    die("Query Failed. " . $th->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php include_once('../../includes/css_links.php') ?>
  <link rel="stylesheet" href="../../public/css/Customer/landing.css">
  <title>Home Page</title>
</head>
<body>

  <?php include_once('../../includes/navbar.php');?>

  <main>
    <section class="carousel flex-center">
      <h1 class="carousel-title">Ready to Watch?</h1>
      <h2 class="carousel-details">Browse our movie listings, pick your preferred showtime, and book your tickets today!</h2>
      <a href="./reserve_now.php"><button class="proceed">Reserve Now</button></a>
    </section>

    <form action="movie_info.php" method="get" class="movies-section flex">
      <div class="movies-container">
        <h2 class="movie-status">Now Showing</h2>
        <section class="movie-row flex">
        <?php foreach ($nowResults as $key) {?>
          <input hidden type="text" name="number[]" value="<?php echo htmlspecialchars($key['number']) ?>">
          <button name="movie-id" value="<?php echo htmlspecialchars($key['id'])?>" class="per-movie flex">
              <h1 class="movie-screen">C<?php echo htmlspecialchars($key['number'])?></h1>
              <div class="poster-container">
                <img class="movie-poster" src="/public/images/<?php echo htmlspecialchars($key['poster'])?>" alt="<?php echo htmlspecialchars($key['title']) ?> Poster">
              </div>
              <h2 class="movie-title"><?php echo htmlspecialchars($key['title'])?></h2>
          </button>
          <?php }?>       
        </section>  
      </div>

      <div class="movies-container">
        <h2 class="movie-status">Next Picture</h2>
        <section class="movie-row flex">
        <?php foreach ($nextResults as $next) {?>
          <button name="movie-id" value="<?php echo htmlspecialchars($next['id']) ?>" class="per-movie flex">
              <div class="poster-container">
                <img class="movie-poster" src="/public/images/<?php echo htmlspecialchars($next['poster'])?>" alt="<?php echo htmlspecialchars($next['poster']) ?> Poster">
              </div>
              <h2 class="movie-title"><?php echo htmlspecialchars($next['title'])?></h2>
          </button>
          <?php }?>       
        </section>
      </div>

      <div class="movies-container">
        <h2 class="movie-status">Coming Soon</h2>
        <section class="movie-row flex">
          <?php foreach ($comingResults as $coming) {?>
          <button name="movie-id" value="<?php echo htmlspecialchars($coming['id'])?>" class="per-movie flex">
            <div name="coming-results" value="<?php echo htmlspecialchars($coming['id']) ?>" class="poster-container">
                  <img class="movie-poster" src="/public/images/<?php echo htmlspecialchars($coming['poster'])?>" alt="<?php echo htmlspecialchars($coming['title'])?> Poster">
                </div>
                <h2 class="movie-title"><?php echo htmlspecialchars($coming['title']) ?></h2>
            </button>
          <?php }?>       
        </section>
      </div>
    </form>
  </main>
</body>
</html>