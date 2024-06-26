<?php 
session_start();
include_once '../../classes/dbh.class.php';
$dbhconnect = new Dbh();
try {
$nowShowing = "SELECT DISTINCT movie.id, movie.title, movie.poster, cinema.number, movie_status.status FROM movie LEFT JOIN cinema ON movie.id = cinema.movie_id LEFT JOIN movie_status ON movie.id = movie_status.movie_id WHERE movie_status.status = 'now showing' ORDER BY cinema.number";
$nowStmt = $dbhconnect->connection()->prepare($nowShowing);
$nowStmt->execute();
$nowResults = $nowStmt->fetchALL(PDO::FETCH_ASSOC);


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
  <link rel="stylesheet" href="../../public/css/Customer/reserve-now.css">
  <title>Reserve Now!</title>
</head>
<body>
  <?php include_once '../../includes/navbar.php';?>
  
  <main>
    <div class="movies-container">
    <h2 class="movie-status">Now Showing</h2>
    <form action="movie_info.php" method="get" class="movie-row flex">
      <?php foreach ($nowResults as $key) {?>
          <input hidden type="text" name="number[]" value="<?php echo htmlspecialchars($key['number']) ?>">
          <button name="movie-id" value="<?php echo htmlspecialchars($key['id']) ?>" class="per-movie flex">
              <h1 class="movie-screen">C<?php echo htmlspecialchars($key['number']) ?></h1>
              <div class="poster-container">
                <img class="movie-poster" src="/public/images/<?php echo htmlspecialchars($key['poster']) ?>" alt="<?php echo htmlspecialchars($key['title']) ?> Poster">
              </div>
              <h2 class="movie-title"><?php echo htmlspecialchars($key['title']) ?></h2>
          </button>
      <?php }?>     
    </form>  
  </div>
  </main>
</body>
</html>