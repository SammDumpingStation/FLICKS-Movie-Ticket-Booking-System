<?php
include_once '../../classes/dbh.class.php';
$dbhconnect = new Dbh();
session_start();

try {
    $movieQuery = "SELECT DISTINCT movie.id, movie.title, cinema.number, movie_status.status FROM movie LEFT JOIN cinema ON movie.id = cinema.movie_id LEFT JOIN movie_status ON movie.id = movie_status.movie_id ORDER BY movie_status.status, cinema.number";
    $movieStmt = $dbhconnect->connection()->prepare($movieQuery);
    $movieStmt->execute();
    $movieResults = $movieStmt->fetchALL(PDO::FETCH_ASSOC);

} catch (\Throwable $th) {
    die("Query Failed. " . $th->getMessage());
}

$buttons = $_GET['buttons'] ?? null;
$id = $_GET['movie-id'] ?? null;
if (isset($buttons)) {
    if ($buttons === 'edit') {
        $_SESSION['movie-id'] = $id;
        header('Location: update_movie.php');
    } elseif ($buttons === 'delete') {
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

  <main>
    <a href="landing.php"><button class="return">Return</button></a>
    <section class="header">
      <h1 class="title">Manage Movies</h1>
      <div class="sorting-movies">
        <button>Recently Added</button>
        <button>Alphabetical Order</button>
        <button>Now Showing</button>
        <button>Next Picture</button>
        <button>Coming Soon</button>
        <button>Stashed</button>
        <button>Upcoming Movies</button>
      </div>
    </section>

    <?php foreach ($movieResults as $key) {?>
    <form action="" method="get" class="container">
      <div class="info-container">
        <div class="info-div">
          <p class="grey p-info">Movie Title <span class="white"><?php echo htmlspecialchars($key['title']) ?></span></p>
          <input type="hidden" name="movie-id" value="<?php echo $key['id'] ?>" id="">
          <p class="grey p-info">Status: <span class="white"><?php echo ucwords(htmlspecialchars($key['status'])) ?></span></p>
          <p class="grey p-info">Screen Location: <span class="white"><?php echo htmlspecialchars($key['number'] ?? "Not Currently Showing") ?></span></p>
        </div>
        <div class="buttons">
          <button class="yellow-bg" name="buttons" value="edit">Edit Movie</button>
          <button class="red-bg" name="buttons" value="delete">Delete</button>
        </div>
      </div>
    </form>
    <?php }?>
  </main>
</body>
</html>