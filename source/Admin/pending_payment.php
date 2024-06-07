<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php include_once '../../includes/css_links.php'?>
  <link rel="stylesheet" href="../../public/css/Admin/pending_payment.css">
  <title>Document</title>
</head>
<body>
  <?php include_once '../../includes/navbar_admin.php';?>

  <main>
    <section class="header">
      <div class="title-section">
        <h1>Pending Payments</h1>
        <div class="seats-avail">
          <p class="grey">Seats Available: <span class="white">80</span></p>
          <button>Available Seats</button>          
        </div>
      </div>
      <div class="info-container">
        <p class="movie-info grey">Movie Name: <span class="details white">Furiosa: A Mad Max Saga</span></p>
        <p class="movie-info grey">Screen Location: <span class="details white">Cinema 1</span></p>
        <p class="movie-info grey">Current Showtime: <span class="details white">12:30</span></p>
      </div>   
    </section>

    <section class="pending-container">
      
    </section>
  </main>
</body>
</html>