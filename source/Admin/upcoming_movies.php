<?php
include_once '../../classes/dbh.class.php';
$dbhconnect = new Dbh();

try {
    $query = "SELECT movie.poster, movie.title, movie_status.status FROM movie JOIN movie_status ON movie.id = movie_status.movie_id WHERE movie_status.status = 'upcoming movies'";
    $stmt = $dbhconnect->connection()->prepare($query);
    $stmt->execute();
    $result = $stmt->fetchALL(PDO::FETCH_ASSOC);

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
  <link rel="stylesheet" href="../../public/css/Admin/stashed-movie.css">
  <title>Upcoming Movies</title>
</head>
<body>
  <?php include_once '../../includes/navbar.php';?>

  <main>
    <a href="landing.php"><button class="return">Return</button></a>
    <section class="header">
      <h1 class="title">Upcoming Movies</h1>
    </section>

     <section class="movies-section flex">
      <div class="movies-container">
        <div class="movie-row flex">
          <?php
            if (!$result) {
            echo "<h2 class=''>Nothing Has Been added yet!</h2>";
            } else {
            foreach ($result as $key) {?>
              <div class="per-movie flex">
                <div class="poster-container">
                  <img class="movie-poster" src="/public/images/Haikyu-Dumpster-Battle.jpg" alt="Haikyuu Dumpster Battle Poster">
                </div>
                <h2 class="movie-title">Haikyuu!! The Dumpster Battle</h2>
            </div>
          <?php }
            }?>
        </div>
      </div>

    </section>
</body>
</html>