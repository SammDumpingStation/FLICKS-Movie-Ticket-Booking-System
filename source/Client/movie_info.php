<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php include_once '../../includes/css_links.php'?>
  <link rel="stylesheet" href="../../public/css/movie-info.css">
  <title>Document</title>
</head>
<body>
  <?php include_once '../../includes/navbar.php';?>

  <main class="flex">
    <div class="main">
      <section class="poster-left flex">
        <div class="poster-container">
          <img class="poster" src="/public/images/Furiosa.jpg" alt="">
        </div>
        <h2 class="screen">Cinema 2</h2>
      </section>

      <section class="details-right flex">
          <div class="title-container flex">
            <h1 class="movie-title">Furiosa: A Mad Max Saga</h1>
            <h3 class="rating">Rating: (4.5/5)</h3>            
          </div>
          <div class="mini-info flex">
            <button class="info">PG-13</button>
            <button class="info">2D</button>
            <button class="info">2hr 28min</button>
          </div>

          <p class="description">
            As the world fell, young Furiosa is snatched from the Green Place of  Many Mothers and falls into the hands of a great Biker Horde led by the  Warlord Dementus.  Sweeping through the Wasteland, they come across the  Citadel presided over by The Immortan Joe.  While the two Tyrants war  for dominance, Furiosa must survive many trials as she puts together the  means to find her way home.
          </p>

          <div class="showtime-div flex">
            <h2 class="showtime-title">Show Times</h2>
            <h6 class="showtime-date">May 30, 2024</h6>
            <div class="times-container flex">
              <h5 class="showtimes">12:30 P.M.</h5>
              <h5 class="showtimes">3:30 P.M.</h5>
              <h5 class="showtimes">6:30 P.M.</h5>
            </div>
          </div>
      </section>
    </div>

    <div class="button-container flex">
      <a href="landing.php"><button class="buttons see-trailer">Go Back</button></a>
      <a href="book_ticket.php"><button class="buttons reserve-now">Reserve Now</button></a>
    </div>
  </main>
</body>
</html>