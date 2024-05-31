<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php include_once './includes/css_links.php'?>
  <link rel="stylesheet" href="/public/css/book-ticket.css">
  <title>Document</title>
</head>
<body>
  <?php include_once './includes/navbar.php';?>

  <main class="flex">
    <section class="selection-group flex">
      <h3 class="selection current">1. Book Tickets</h3>
      <h3 class="selection">2. Select Seats</h3>
      <h3 class="selection">3. Confirm</button>
      <h3 class="selection">4. Booking Successful</h3>
    </section>

    <section class="current-contents flex">
      <div class="poster-container">
        <img src="/public/images/Furiosa.jpg" alt="">
      </div>
      <div class="movie-details">
        <h1 class="title">Furiosa: A Mad Max Saga</h1>
        <div class="below-title">
          <h1 class="price">$400</h1>
        </div>
      </div>
    </section>
  </main>
</body>
</html>