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

        // Retrieve file data
        $poster = $_FILES['poster']['name'];
        $tempname = $_FILES['poster']['tmp_name'];
        $folder = '../../public/images/' . $poster;

        // Move uploaded file
        if (move_uploaded_file($tempname, $folder)) {
            try { // SQL Query to insert movie data
                $movieQuery = "INSERT INTO movie (title, description, poster, age_rating, dimension, length, rating_score, created_at)
                               VALUES (:title, :description, :poster, :age_rating, :dimension, :length, :rating_score, NOW())";
                $movieStmt = $dbhconnect->connection()->prepare($movieQuery);
                $movieStmt->bindParam(":title", $title, PDO::PARAM_STR);
                $movieStmt->bindParam(":description", $description, PDO::PARAM_STR);
                $movieStmt->bindParam(":poster", $poster, PDO::PARAM_STR);
                $movieStmt->bindParam(":age_rating", $ageRating, PDO::PARAM_STR);
                $movieStmt->bindParam(":dimension", $dimension, PDO::PARAM_STR);
                $movieStmt->bindParam(":length", $length, PDO::PARAM_INT);
                $movieStmt->bindParam(":rating_score", $ratingScore, PDO::PARAM_INT);

                if (!$movieStmt->execute()) {
                    throw new Exception("Failed to insert movie data");
                }

                $movieIDQuery = "SELECT id FROM movie ORDER BY id DESC LIMIT 1;";
                $IDstmt = $dbhconnect->connection()->prepare($movieIDQuery);
                $IDstmt->execute();
                $movieID = $IDstmt->fetchAll(PDO::FETCH_ASSOC);

                // SQL Query to insert movie status
                $statusQuery = "INSERT INTO movie_status (movie_id, status) VALUES (:movie_id, :status)";
                $statusStmt = $dbhconnect->connection()->prepare($statusQuery);
                $statusStmt->bindParam(":movie_id", $movieID, PDO::PARAM_INT);
                $statusStmt->bindParam(":status", $status, PDO::PARAM_STR);

                if (!$statusStmt->execute()) {
                    throw new Exception("Failed to insert movie status data");
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