<?php
include_once '../../classes/dbh.class.php';
$dbhconnect = new Dbh();
$button = $_POST['submit'] ?? null;

if (isset($button)) {
    if ($button === 'cancel') {
        header('Location: landing.php');
        exit();
    } elseif ($button === 'save') {
        // Retrieve form data
        $title = $_POST['title'];
        $description = $_POST['description'];
        $length = $_POST['length'];
        $ageRating = $_POST['age-rating'];
        $dimension = $_POST['dimension'];
        $ratingScore = $_POST['rating-score'];
        $status = $_POST['movie-status'];
        $cost = $_POST['cost'];

        // Retrieve file data
        $poster = $_FILES['poster']['name'];
        $tempname = $_FILES['poster']['tmp_name'];
        $folder = '../../public/images/' . $poster;

        // Move uploaded file
        if (move_uploaded_file($tempname, $folder)) {
            try { // SQL Query to insert movie data
                $movieQuery = "INSERT INTO movie (title, description, poster, age_rating, dimension, length, rating_score, ticket_cost, created_at)
                               VALUES (:title, :description, :poster, :age_rating, :dimension, :length, :ticket_cost, :rating_score, NOW())";
                $movieStmt = $dbhconnect->connection()->prepare($movieQuery);
                $movieStmt->bindParam(":title", $title, PDO::PARAM_STR);
                $movieStmt->bindParam(":description", $description, PDO::PARAM_STR);
                $movieStmt->bindParam(":poster", $poster, PDO::PARAM_STR);
                $movieStmt->bindParam(":age_rating", $ageRating, PDO::PARAM_STR);
                $movieStmt->bindParam(":dimension", $dimension, PDO::PARAM_STR);
                $movieStmt->bindParam(":length", $length, PDO::PARAM_INT);
                $movieStmt->bindParam(":rating_score", $ratingScore, PDO::PARAM_INT);
                $movieStmt->bindParam(":ticket_cost", $cost, PDO::PARAM_INT);

                if (!$movieStmt->execute()) {
                    throw new Exception("Failed to insert movie data");
                }

                $movieIDQuery = "SELECT id FROM movie ORDER BY id DESC LIMIT 1;";
                $IDstmt = $dbhconnect->connection()->prepare($movieIDQuery);
                $IDstmt->execute();
                $movieIDResult = $IDstmt->fetch(PDO::FETCH_ASSOC);
                $movieID = $movieIDResult['id'];

                // SQL Query to insert movie status
                $statusQuery = "INSERT INTO movie_status (movie_id, status) VALUES (:movie_id, :status)";
                $statusStmt = $dbhconnect->connection()->prepare($statusQuery);
                $statusStmt->bindParam(":movie_id", $movieID, PDO::PARAM_INT);
                $statusStmt->bindParam(":status", $status, PDO::PARAM_STR);

                if (!$statusStmt->execute()) {
                    throw new Exception("Failed to insert movie status data");
                }
                else {
                  header('Location: add_movie.php');
                }

            } catch (\Throwable $th) {
                // Roll back the transaction in case of an error
                die("Query Failed. " . $th->getMessage());
            }
        } else {
            echo '<h2>File not Uploaded</h2>';
        }
    }

    // Clean up the statements
    $movieStmt = null;
    $statusStmt = null;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php include_once '../../includes/css_links.php'?>
  <link rel="stylesheet" href="../../public/css/Admin/add-movie.css">
  <title>Add A Movie</title>
</head>
<body>
  <?php include_once '../../includes/navbar.php';?>

  <main>
    <a href="landing.php"><button class="return">Return</button></a>
    <h1 class="title">Add a Movie</h1>
    <form class="add-form" action="" method="POST" enctype="multipart/form-data">
      <section class="basic-info-section">
        <div class="input-container">
          <label for="name">Title</label>
          <input class="input" id="name" type="text" name="title" placeholder="Movie Title">
        </div>

        <div class="input-container">
          <label for="length">Length</label>
          <input class="input" id="length" type="text" name="length" placeholder="Movie Length (In Minutes)">
        </div>

        <div class="input-container">
          <label for="rated">Age Rating</label>
            <select class="input" name="age-rating" id="rated"> <!-- make a custom css and html idf we have time -->
              <option value="none">Select an Age Rating</option>
              <option value="G">G (General Audiences)</option>
              <option value="PG">PG (Parental Guidance Suggested)</option>
              <option value="PG-13">PG-13 (Parents Strongly Cautioned)</option>
              <option value="R-18">R-18 (Rated 18)</option>
            </select>
          </div>

        <div class="input-container">
          <label for="dimension">Dimension</label>
            <select class="input" name="dimension" id="dimension"> <!-- make a custom css and html idf we have time -->
              <option value="none">Select a Dimension Type</option>
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
          <input class="input" id="rating" type="text" name="rating-score" placeholder="Ranging from 1 - 10">
        </div>

        <div class="input-container">
          <label for="status">Status</label>
            <select class="input" name="movie-status" id="status"> <!-- make a custom css and html idf we have time -->
              <option value="none">Select a Status</option>
              <option value="now showing">Now Showing</option>
              <option value="next picture">Next Picture</option>
              <option value="coming soon">Coming Soon</option>
              <option value="upcoming movies">Upcoming Movies</option>
              <option value="stashed">Stashed</option>
            </select>
        </div>

        <div class="input-container">
          <label for="cost">Ticket Cost</label>
          <input class="input" id="cost" type="text" name="cost" placeholder="Ticket Cost">
        </div>
      </section>

      <section class="desc-poster-section">
        <div class="large-container">
          <label for="description">Description</label>
          <textarea class="large-input input" name="description" id="description" placeholder="Movie Description goes here...."></textarea>
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