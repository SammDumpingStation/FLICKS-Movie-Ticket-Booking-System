<?php
include_once '../../classes/dbh.class.php';
$dbhconnect = new Dbh();
session_start();

$sortButtons = $_GET['sort'] ?? null;
$returnButton = $_GET['return'] ?? null;
if ($returnButton === 'return') {
    header('Location: landing.php');
}
if (!$sortButtons) {
    $movieQuery = "SELECT DISTINCT movie.id, movie.title, cinema.number, movie_status.status FROM movie LEFT JOIN cinema ON movie.id = cinema.movie_id LEFT JOIN movie_status ON movie.id = movie_status.movie_id ORDER BY movie_status.status, cinema.number";
} elseif ($sortButtons === 'recently') {
    $movieQuery = "SELECT DISTINCT movie.id, movie.title, cinema.number, movie_status.status FROM movie LEFT JOIN cinema ON movie.id = cinema.movie_id LEFT JOIN movie_status ON movie.id = movie_status.movie_id ORDER BY movie.id DESC";
} elseif ($sortButtons === 'alphabetical') {
    $movieQuery = "SELECT DISTINCT movie.id, movie.title, cinema.number, movie_status.status FROM movie LEFT JOIN cinema ON movie.id = cinema.movie_id LEFT JOIN movie_status ON movie.id = movie_status.movie_id ORDER BY movie.title";
} elseif ($sortButtons === 'now') {
    $movieQuery = "SELECT DISTINCT movie.id, movie.title, cinema.number, movie_status.status FROM movie LEFT JOIN cinema ON movie.id = cinema.movie_id LEFT JOIN movie_status ON movie.id = movie_status.movie_id WHERE movie_status.status = 'now showing' ORDER BY cinema.number";
} elseif ($sortButtons === 'next') {
    $movieQuery = "SELECT DISTINCT movie.id, movie.title, cinema.number, movie_status.status FROM movie LEFT JOIN cinema ON movie.id = cinema.movie_id LEFT JOIN movie_status ON movie.id = movie_status.movie_id WHERE movie_status.status = 'next picture'";
} elseif ($sortButtons === 'coming') {
    $movieQuery = "SELECT DISTINCT movie.id, movie.title, cinema.number, movie_status.status FROM movie LEFT JOIN cinema ON movie.id = cinema.movie_id LEFT JOIN movie_status ON movie.id = movie_status.movie_id WHERE movie_status.status = 'coming soon'";
} elseif ($sortButtons === 'stashed') {
    $movieQuery = "SELECT DISTINCT movie.id, movie.title, cinema.number, movie_status.status FROM movie LEFT JOIN cinema ON movie.id = cinema.movie_id LEFT JOIN movie_status ON movie.id = movie_status.movie_id WHERE movie_status.status = 'stashed'";
} elseif ($sortButtons === 'upcoming') {
    $movieQuery = "SELECT DISTINCT movie.id, movie.title, cinema.number, movie_status.status FROM movie LEFT JOIN cinema ON movie.id = cinema.movie_id LEFT JOIN movie_status ON movie.id = movie_status.movie_id WHERE movie_status.status = 'upcoming movies'";
}

try {
    $movieStmt = $dbhconnect->connection()->prepare($movieQuery);
    $movieStmt->execute();
    $movieResults = $movieStmt->fetchALL(PDO::FETCH_ASSOC);

} catch (\Throwable $th) {
    die("Query Failed. " . $th->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['movie-id']) && isset($_GET['button-value'])) {
    $movieIDs = $_GET['movie-id'];
    $buttonValues = $_GET['button-value'];

    foreach ($movieIDs as $id) {
        if (isset($buttonValues[$id])) {
            $buttonValue = $buttonValues[$id];
            if ($buttonValue === 'edit') {
                $_SESSION['movie-id'] = $id;
                header('Location: update_movie.php');
            } elseif ($buttonValue === 'delete') {
                try {
                    $dbh = $dbhconnect->connection();

                    // Delete from movie_status table
                    $deleteStatusQuery = "DELETE FROM movie WHERE id = :id";
                    $statusStmt = $dbh->prepare($deleteStatusQuery);
                    $statusStmt->bindParam(":id", $id, PDO::PARAM_INT);
                    $statusStmt->execute();

                    echo "Movie and its related records deleted successfully.";
                    header('Location: manage_movies.php?=deletedsuccess');
                } catch (Exception $e) {
                    die("Error deleting movie: " . $e->getMessage());
                }
            } else {
                echo "No movie ID provided.";
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
  <link rel="stylesheet" href="../../public/css/Admin/manage-movie.css">
  <title>Manage Movies</title>
</head>
<body>
  <?php include_once '../../includes/navbar.php';?>

  <form action="" method="get">
    <button class="return" name="return" value="return">Return</button>
    <section class="header">
      <h1 class="title">Manage Movies</h1>
      <div class="sorting-movies">
        <button name="sort" value="recently">Recently Added</button>
        <button name="sort" value="alphabetical">Alphabetical Order</button>
        <button name="sort" value="now">Now Showing</button>
        <button name="sort" value="next">Next Picture</button>
        <button name="sort" value="coming">Coming Soon</button>
        <button name="sort" value="stashed">Stashed</button>
        <button name="sort" value="upcoming">Upcoming Movies</button>
      </div>
    </section>

    <?php
if (!$movieResults) {
    echo " <section class='container'><p class='info-container'>Nothing Has Been added yet!</p></section>";
} else {
    foreach ($movieResults as $key) {?>
    <section class="container">
      <div class="info-container">
        <div class="info-div">
          <p class="grey p-info">Movie Title <span class="white"><?php echo htmlspecialchars($key['title']) ?></span></p>
          <input type="hidden" name="movie-id[]" value="<?php echo $key['id'] ?>" id="">
          <p class="grey p-info">Status: <span class="white"><?php echo ucwords(htmlspecialchars($key['status'])) ?></span></p>
          <p class="grey p-info">Screen Location: <span class="white"><?php echo htmlspecialchars($key['number'] ?? "Not Currently Showing") ?></span></p>
        </div>
        <div class="buttons">
          <button class="yellow-bg" name="button-value[<?php echo $key['id'] ?>]" value="edit">Edit Movie</button>
          <button class="red-bg" name="button-value[<?php echo $key['id'] ?>]" value="delete">Delete</button>
        </div>
      </div>
    </section>
    <?php }
}?>
  </form>
</body>
</html>