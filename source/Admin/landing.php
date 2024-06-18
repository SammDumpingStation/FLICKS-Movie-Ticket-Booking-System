<?php
session_start();
date_default_timezone_set('Asia/Manila');
include_once '../../classes/dbh.class.php';
$dbhconnect = new Dbh();

try {
    $movieQuery = "SELECT movie.id, movie.length, movie.title, movie_status.status FROM movie JOIN movie_status ON movie.id = movie_status.movie_id WHERE movie_status.status = 'now showing';";
    $movieStmt = $dbhconnect->connection()->prepare($movieQuery);
    $movieStmt->execute();
    $movieResults = $movieStmt->fetchALL(PDO::FETCH_ASSOC);

    // echo date('h:i A');
    // $custom = '';
    $currentTime = date("h:i");

} catch (\Throwable $th) {
    //throw $th;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php include_once '../../includes/css_links.php'?>
  <link rel="stylesheet" href="../../public/css/Admin/landing.css">
  <title>Home Page</title>
</head>
<body>

  <?php include_once '../../includes/navbar.php';?>

  <main class="flex">
    <section>
      <h1>Pending Payments</h1>
      <section class="pending-container">
        <?php foreach ($movieResults as $key) {?>
          <form action="pending_payments.php" method="get" class="pending-cinema">
            <input hidden type="text" name="title" value="<?php echo htmlspecialchars($key['title'] ?? null) ?>">
            <input hidden type="text" name="available" value="<?php echo htmlspecialchars($key['available'] ?? 120) ?>">
            <button name="cinema" value="" class="button-pending pending-cinema">
                <div>
                    <h3 data-name="">Cinema </h3>
                    <p class="date"><?php echo date('F d, Y h:i A') ?></p>
                  </div>
                <div>
                  <h2>Movie</h2>
                  <p><?php echo $key['title'] ?></p>
                </div>
                <div>
                  <h2>Duration</h2>
                  <?php $duration = $key['length'] . " minutes";
                      $custTimeStr = strtotime($duration);
                      $movieTime = date('h:i', $custTimeStr);
                      ?>
                  <p><?php echo $movieTime ?> hours</p>
                </div>
                <div>
                  <h2>Time Start:</h2>
                  <?php 
                    $cinemaQuery = "SELECT * FROM cinema WHERE movie_id = :movie_id;";
                    $cinemaStmt = $dbhconnect->connection()->prepare($cinemaQuery);
                    $cinemaStmt->bindParam(":movie_id", $key['id'], PDO::PARAM_INT);
                    $cinemaStmt->execute();
                    $cinemaResult = $cinemaStmt->fetchALL(PDO::FETCH_ASSOC);

                  foreach ($cinemaResult as $time) {
                    $startTimeSlot = $time['time_start'];
                    $endTimeSlot = $time['time_end'];

                    if ($currentTime > $startTimeSlot && $currentTime < $endTimeSlot) {
                      echo $startTimeSlot . '<br>';
                    } else {
                      echo "Too Late!";
                    }
                  }
                  ?>
                  <p>12:30 PM</p>
                </div>
                <div>
                  <h2>Status</h2>
                  <p>Available</p>
                </div>
                <div>
                  <h2>Seats Available</h2>
                  <p><?php echo htmlspecialchars($key['available'] ?? '120') ?> Seats</p>
                </div>
                <div>
                  <h2>Pending</h2>
                  <p><?php echo htmlspecialchars($key['reservation_count'] ?? '0') ?> Reservations</p>
                </div>
            </button>
          </form>
              <?php }?>
    </section>
    </section>

    <section>
      <h1>Movie Section</h1>
      <section class="admin-container">
        <a class="admin-sections" href="add_movie.php">
          <img src="../../public/images/admin.png" alt="">
          <p>Add Movies</p>
        </a>
        <a class="admin-sections" href="manage_movies.php">
          <img src="../../public/images/admin.png" alt="">
          <p>Manage Movies</p>
        </a>
        <a class="admin-sections" href="cinema_assignment.php">
          <img src="../../public/images/admin.png" alt="">
          <p>Cinema Assignment</p>
        </a>
        <a class="admin-sections" href="update_schedules.php">
          <img src="../../public/images/admin.png" alt="">
          <p>Update Schedules</p>
        </a>
        <a class="admin-sections" href="stashed_movies.php">
          <img src="../../public/images/admin.png" alt="">
          <p>Stashed Movies</p>
        </a>
        <a class="admin-sections" href="upcoming_movies.php">
          <img src="../../public/images/admin.png" alt="">
          <p>Upcoming Movies</p>
        </a>
      </section>
    </section>

    <section>
      <h1>Action Center</h1>
        <section class="admin-container">
          <a class="admin-sections" href="paid_tickets_history.php">
            <img src="../../public/images/admin.png" alt="">
            <p>Paid Tickets History</p>
          </a>
          <a class="admin-sections" href="admin_action_history.php">
            <img src="../../public/images/admin.png" alt="">
            <p>Admin Action History</p>
          </a>
          <a class="admin-sections" href="registered_users.php">
            <img src="../../public/images/admin.png" alt="">
            <p>Registered Users</p>
          </a>
        </section>
    </section>

  </main>

</body>
</html>