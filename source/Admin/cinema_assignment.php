<?php
function calculateEndTime($startTime, $minutesToAdd)
{
    $time_in_minutes = strtotime($startTime) / 60; // Convert start time to minutes
    $new_time_in_minutes = $time_in_minutes + $minutesToAdd; // Calculate end time in minutes
    $newTime = date("h:i", $new_time_in_minutes * 60); // Convert end time back to desired format
    return $newTime;
}
session_start();
include_once '../../classes/dbh.class.php';
$dbhconnect = new Dbh();
$buttonAction = $_POST['submit'] ?? null;
if (isset($buttonAction)) {
    if ($buttonAction === 'cancel') {
        header('Location: landing.php');
    } elseif ($buttonAction === 'save') {
        try {
            // Check if cinema table has existing records
            $queryCheck = "SELECT COUNT(*) as count FROM cinema";
            $stmtCheck = $dbhconnect->connection()->prepare($queryCheck);
            $stmtCheck->execute();
            $rowCount = $stmtCheck->fetch(PDO::FETCH_ASSOC)['count'];

            // If records exist, delete all existing time slots
            if ($rowCount > 0) {
                $queryDelete = "DELETE FROM cinema";
                $stmtDelete = $dbhconnect->connection()->prepare($queryDelete);
                $stmtDelete->execute();
            }

            // Setting up the time
            $timeStart = '12:30';
            $screenNumbers = $_POST['number'];
            $movieIDs = $_POST['movie-id'];
            $lengths = $_POST['length'] ?? null;
            $rest = 45;

            for ($i = 0; $i < count($screenNumbers); $i++) {
                $screenNumber = $screenNumbers[$i];
                $movieID = $movieIDs[$i];
                $length = $lengths[$i];

                $timeEnd1st = calculateEndTime($timeStart, $length);

                $queryTime = "INSERT INTO cinema (time_start, time_end, number, movie_id) VALUES (:time_started, :time_ended, :number, :movie_id);";
                $timestmt1 = $dbhconnect->connection()->prepare($queryTime);
                $timestmt1->bindParam(":time_started", $timeStart, PDO::PARAM_STR);
                $timestmt1->bindParam(":time_ended", $timeEnd1st, PDO::PARAM_STR);
                $timestmt1->bindParam(":number", $screenNumber, PDO::PARAM_INT);
                $timestmt1->bindParam(":movie_id", $movieID, PDO::PARAM_INT);

                if (!$timestmt1->execute()) {
                    throw new Exception("Failed to insert movie data");
                }

                $timeStart2nd = $timeEnd1st;
                $timeStart2nd = calculateEndTime($timeStart2nd, $rest);
                $timeEnd2nd = calculateEndTime($timeStart2nd, $length);

                $queryTime = "INSERT INTO cinema (time_start, time_end, number, movie_id) VALUES (:time_started, :time_ended, :number, :movie_id);";
                $timestmt2 = $dbhconnect->connection()->prepare($queryTime);
                $timestmt2->bindParam(":time_started", $timeStart2nd, PDO::PARAM_STR);
                $timestmt2->bindParam(":time_ended", $timeEnd2nd, PDO::PARAM_STR);
                $timestmt2->bindParam(":number", $screenNumber, PDO::PARAM_INT);
                $timestmt2->bindParam(":movie_id", $movieID, PDO::PARAM_INT);

                if (!$timestmt2->execute()) {
                    throw new Exception("Failed to insert movie data");
                }

                $timeStart3rd = $timeEnd2nd;
                $timeStart3rd = calculateEndTime($timeStart3rd, $rest);
                $timeEnd3rd = calculateEndTime($timeStart3rd, $length);

                $queryTime = "INSERT INTO cinema (time_start, time_end, number, movie_id) VALUES (:time_started, :time_ended, :number, :movie_id);";
                $timestmt3 = $dbhconnect->connection()->prepare($queryTime);
                $timestmt3->bindParam(":time_started", $timeStart3rd, PDO::PARAM_STR);
                $timestmt3->bindParam(":time_ended", $timeEnd3rd, PDO::PARAM_STR);
                $timestmt3->bindParam(":number", $screenNumber, PDO::PARAM_INT);
                $timestmt3->bindParam(":movie_id", $movieID, PDO::PARAM_INT);

                if (!$timestmt3->execute()) {
                    throw new Exception("Failed to insert movie data");
                } else {
                    header('Location: cinema_assignment.php');
                }

            }
        } catch (\Throwable $th) {
            die("Query Failed. " . $th->getMessage());
        }
    }
}
try {
    $queryNow = "SELECT movie.id, movie.title, movie.poster, movie.length FROM movie JOIN movie_status ON movie.id = movie_status.movie_id WHERE movie_status.status = 'now showing';";
    $stmt = $dbhconnect->connection()->prepare($queryNow);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

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
  <link rel="stylesheet" href="../../public/css/Admin/cinema-assignment.css">
  <title>Cinema Assignment</title>
</head>
<body>
  <?php include_once '../../includes/navbar.php';?>
  <main>
    <a href="landing.php"><button class="return">Return</button></a>
    <form action="" method="post" class="movies-section flex">
      <div class="movies-container">
        <h2 class="movie-status">Now Showing</h2>
        <div class="movie-row flex">
        <?php foreach ($result as $key) {?>
          <div class="per-movie flex">
              <label class="screen-label" for="">Screen Location</label>
              <input type="text" name="length[]" value="<?php echo htmlspecialchars($key['length']) ?>" hidden>
              <input type="text" name="movie-id[]" value="<?php echo htmlspecialchars($key['id']) ?>" hidden>
              <select name="number[]" class="movie-screen">
                <option value=""></option>
                <option value="1">C1</option>
                <option value="2">C2</option>
                <option value="3">C3</option>
                <option value="4">C4</option>
              </select>
              <div class="poster-container">
                <img class="movie-poster" src="/public/images/<?php echo htmlspecialchars($key['poster']) ?>" alt="<?php echo htmlspecialchars($key['title']) ?> Poster">
              </div>
              <h2 class="movie-title"><?php echo htmlspecialchars($key['title']) ?></h2>
                <div class="show-times">
                  <h2 class="times-title">Show Times</h2>
                  <?php
                    try {
                        $movie_ID = $key['id'];
                        $queryShowTimes = "SELECT time_start FROM cinema WHERE movie_id = :movieID";
                        $stmt = $dbhconnect->connection()->prepare($queryShowTimes);
                        $stmt->bindParam(":movieID", $movie_ID, PDO::PARAM_INT);
                        $stmt->execute();
                        $timeResult = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        if (empty($timeResult)) {?>
                            <h6 class='time'>Not yet set!</h6>
                                            <?php } else {
                            foreach ($timeResult as $time) {?>
                                <?php $timeFromDbh = $time['time_start'];
                                $timestamp = strtotime($timeFromDbh);
                                $formattedTime = date("h:i A", $timestamp);
                                $finalTime = str_replace('AM', 'PM', $formattedTime);?>
                                <h6 class='time'><?php echo htmlspecialchars($finalTime) ?></h6>
                                <?php }
                                  }
                              } catch (\Throwable $th) {
                                  die("Query Failed. " . $th->getMessage());
                              }?>
                </div>
          </div>
        <?php }?>
        </div>
      </div>

      <section class="button-operations">
        <button class="go-back" name="submit" value="cancel">Cancel</button>
        <button class="proceed" name="submit" value="save">Save</button>
      </section>
    </form>
  </main>
</body>
</html>