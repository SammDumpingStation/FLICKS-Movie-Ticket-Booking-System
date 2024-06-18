<?php
session_start();
include_once '../../classes/dbh.class.php';
$dbhconnect = new Dbh();

$searchTerm = $_SESSION['search'];

try {
    // Prepare the SQL query using LIKE operator and wildcard characters
    $searchQuery = "SELECT DISTINCT movie.*, cinema.number FROM movie LEFT JOIN cinema ON movie.id = cinema.movie_id WHERE title LIKE :searchTerm";
    $stmt = $dbhconnect->connection()->prepare($searchQuery);
    $searchTerm = '%' . $searchTerm . '%';
    $stmt->bindParam(':searchTerm', $searchTerm, PDO::PARAM_STR);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php include_once '../../includes/css_links.php'?>
  <link rel="stylesheet" href="../../public/css/Customer/reserve-now.css">
  <title>Search</title>
</head>
<body>
  <?php include_once '../../includes/navbar.php';?>

  <main>
    <div class="movies-container">
    <h2 class="movie-status">Results</h2>
    <form action="movie_info.php" method="get" class="movie-row flex">
      <?php foreach ($results as $key) {?>
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