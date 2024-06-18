<?php
session_start();
include_once '../../classes/dbh.class.php';
$dbhconnect = new Dbh();

$id = $_SESSION['movie-id'] ?? 'bruh';
$button = $_POST['submit'] ?? null;
if (isset($button)) {
    if ($button == 'cancel') {
        unset($_SESSION['movie-id']);
        header('Location: manage_movies.php');
    } elseif ($button === 'save') {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $poster = $_FILES['poster']['name'];
        $ageRating = $_POST['age-rating'];
        $dimension = $_POST['dimension'];
        $length = $_POST['length'];
        $ratingScore = $_POST['rating-score'];
        $status = $_POST['movie-status'];
        $cost = $_POST['cost'];

        $tempname = $_FILES['poster']['tmp_name'];
        $folder = '../../public/images/' . $poster;

        // Move the uploaded file
        if (move_uploaded_file($tempname, $folder)) {
            try {
                // SQL Query to update movie data
                $updateMovieQuery = "UPDATE movie SET title = :title, description = :description, poster = :poster, age_rating = :age_rating, dimension = :dimension, length = :length, rating_score = :rating_score, ticket_cost = :ticket_cost WHERE id = :id";
                $updateMovieStmt = $dbhconnect->connection()->prepare($updateMovieQuery);
                $updateMovieStmt->bindParam(":title", $title, PDO::PARAM_STR);
                $updateMovieStmt->bindParam(":description", $description, PDO::PARAM_STR);
                $updateMovieStmt->bindParam(":poster", $poster, PDO::PARAM_STR);
                $updateMovieStmt->bindParam(":age_rating", $ageRating, PDO::PARAM_STR);
                $updateMovieStmt->bindParam(":dimension", $dimension, PDO::PARAM_STR);
                $updateMovieStmt->bindParam(":length", $length, PDO::PARAM_INT);
                $updateMovieStmt->bindParam(":rating_score", $ratingScore, PDO::PARAM_INT);
                $updateMovieStmt->bindParam(":ticket_cost", $cost, PDO::PARAM_STR);
                $updateMovieStmt->bindParam(":id", $id, PDO::PARAM_INT);

                if (!$updateMovieStmt->execute()) {
                    throw new Exception("Failed to update movie data");
                }

                // SQL Query to update movie status
                $updateStatusQuery = "UPDATE movie_status SET status = :status WHERE movie_id = :movie_id";
                $updateStatusStmt = $dbhconnect->connection()->prepare($updateStatusQuery);
                $updateStatusStmt->bindParam(":movie_id", $id, PDO::PARAM_INT);
                $updateStatusStmt->bindParam(":status", $status, PDO::PARAM_STR);

                if (!$updateStatusStmt->execute()) {
                    throw new Exception("Failed to update movie status");
                } else {
                  header('Location: manage_movies.php?=success');
                }
            } catch (\Throwable $th) {
                die("Update Failed. " . $th->getMessage());
            }
        }
    }
}

try {
    $query = "SELECT movie.*, movie_status.status FROM movie JOIN movie_status ON movie.id = movie_status.movie_id WHERE movie.id = :id;";
    $movieStmt = $dbhconnect->connection()->prepare($query);
    $movieStmt->bindParam(":id", $id, PDO::PARAM_INT);
    $movieStmt->execute();
    $movieResults = $movieStmt->fetch(PDO::FETCH_ASSOC);
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
  <link rel="stylesheet" href="../../public/css/Admin/add-movie.css">
  <title>Update Movie</title>
</head>
<body>
  <?php include_once '../../includes/navbar.php';?>

  <main>
    <a href="manage_movies.php"><button class="return">Return</button></a>
    <h1 class="title">Update a Movie</h1>
    <form class="add-form" action="" method="POST" enctype="multipart/form-data">
      <section class="basic-info-section">
        <div class="input-container">
          <label for="name">Title</label>
          <input class="input" id="name" type="text" name="title" placeholder="Movie Title" value="<?php echo $movieResults['title'] ?>">
        </div>

        <div class="input-container">
          <label for="length">Length</label>
          <input class="input" id="length" type="text" name="length" placeholder="Movie Length (In Minutes)" value="<?php echo $movieResults['length'] ?>">
        </div>

        <div class="input-container">
          <label for="rated">Age Rating</label>
            <select class="input" name="age-rating" id="rated"> <!-- make a custom css and html idf we have time -->
              <option value="<?php echo $movieResults['age_rating'] ?>"><?php echo $movieResults['age_rating'] ?></option>
              <option value="G">G (General Audiences)</option>
              <option value="PG">PG (Parental Guidance Suggested)</option>
              <option value="PG-13">PG-13 (Parents Strongly Cautioned)</option>
              <option value="R-18">R-18 (Rated 18)</option>
            </select>
          </div>

        <div class="input-container">
          <label for="dimension">Dimension</label>
            <select class="input" name="dimension" id="dimension"> <!-- make a custom css and html idf we have time -->
              <option value="<?php echo $movieResults['dimension'] ?>"><?php echo $movieResults['dimension'] ?></option>
              <option value="2D">2D (Two-Dimensional)</option>
              <option value="3D">3D (Three-Dimensional)</option>
              <option value="IMAX">IMAX</option>
              <option value="4D">4D (Four-Dimensional)</option>
              <option value="VR">VR (Virtual Reality)</option>
              <option value="HDR">HDR (High Dynamic Range)</option>
            </select>
        </div>

        <div class="input-container">
          <label for="rating">Rating Score</label>
          <input class="input" id="rating" type="text" name="rating-score" placeholder="Ranging from 1 - 10" value="<?php echo $movieResults['rating_score'] ?>">
        </div>

        <div class="input-container">
          <label for="status">Status</label>
            <select class="input" name="movie-status" id="status"> <!-- make a custom css and html idf we have time -->
              <option value="<?php echo $movieResults['status'] ?>"><?php echo ucwords($movieResults['status']) ?></option>
              <option value="now showing">Now Showing</option>
              <option value="next picture">Next Picture</option>
              <option value="coming soon">Coming Soon</option>
              <option value="upcoming movies">Upcoming Movies</option>
              <option value="stashed">Stashed</option>
            </select>
        </div>

        <div class="input-container">
          <label for="cost">Ticket Cost</label>
          <input class="input" id="cost" type="text" name="cost" value="<?php echo $movieResults['ticket_cost']?>" placeholder="Ticket Cost">
        </div>
      </section>

      <section class="desc-poster-section">
        <div class="large-container">
          <label for="description">Description</label>
          <textarea class="large-input input" name="description" id="description" placeholder="Movie Description goes here...."><?php echo $movieResults['description'] ?></textarea>
        </div>

        <div class="large-container ">
          <label class="grey" for="poster">Poster</label>
          <div class="poster-section">
              <input class="input poster-input" id="poster" name="poster" type="file">
          </div>
        </div>
      </section>
      <section class="button-operations">
        <button class="go-back" name="submit" value="cancel">Cancel</button>
        <button class="proceed" name="submit" value="save">Save</button>
      </section>
    </form>
  </main>
</body>
</html>