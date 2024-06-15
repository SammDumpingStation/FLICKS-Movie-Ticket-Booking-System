<?php
session_start();
include_once '../../classes/dbh.class.php';
$dbhconnect = new Dbh();

// try {
//     $query = "SELECT movie.title, cinema.number, cinema.time_start FROM movie JOIN cinema ON movie.id = cinema.movie_id";

//     $stmt = $dbhconnect->connection()->prepare($query);
//     $stmt->execute();
//     $data = $stmt->fetch(PDO::FETCH_ASSOC);
//     $result = $data['id'];

// } catch (\Throwable $th) {
//     //throw $th;
// }
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
        <?php for ($i = 0; $i < 4; $i++) {?>
          <section class="pending-cinema">
            <div>
              <h3>Cinema 1</h3>
              <p>Current Time</p>
            </div>
          <div>
            <h2>Movie</h2>
            <p>Furiosa: A Mad Max Saga</p>
          </div>
          <div>
            <h2>Time Start:</h2>
            <p>12:30</p>
          </div>
          <div>
            <h2>Status</h2>
            <p>Available</p>
          </div>
          <div>
            <h2>Seats Available</h2>
            <p>80 Seats</p>
          </div>
          <div>
            <h2>Pending</h2>
            <p>12 Reservations</p>
          </div>
        </section>
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