<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php include_once('./includes/css_links.php') ?>
  <link rel="stylesheet" href="/public/css/landing.css">
  <title>Document</title>
</head>
<body>

  <?php include_once('./includes/navbar.php');?>

  <main>
    <section class="carousel flex-center">
      <h1 class="carousel-title">Ready to Watch?</h1>
      <h2 class="carousel-details">Browse our movie listings, pick your preferred showtime, and book your tickets today!</h2>
      <a href="./reserve_now.php"><button class="carousel-button">Reserve Now</button></a>
    </section>

    <section class="movies-section flex">
      <div class="movies-container">
        <h2 class="movie-status">Now Showing</h2>
        <div class="movie-row flex">

          <div class="per-movie flex">
              <h1 class="movie-screen">C1</h1>
              <div class="poster-container">
                <img class="movie-poster" src="/public/images/Haikyu-Dumpster-Battle.jpg" alt="Haikyuu Dumpster Battle Poster">
              </div>
              <h2 class="movie-title">Haikyuu!! The Dumpster Battle</h2>
          </div>

          <div class="per-movie flex">
              <h1 class="movie-screen">C2</h1>
              <div class="poster-container">
                <img class="movie-poster" src="/public/images/Kingdom-of-the-Planet-of-the-Apes.jpg" alt="Haikyuu Dumpster Battle Poster">
              </div>
              <h2 class="movie-title">Kingdom of the Planet of the Apes</h2>
          </div>

          <div class="per-movie flex">
              <h1 class="movie-screen">C3</h1>
              <div class="poster-container">
                <img class="movie-poster" src="/public/images/WInnie-the-Pooh-Blood-and-Honey.jpg" alt="Haikyuu Dumpster Battle Poster">
              </div>
              <h2 class="movie-title">Winnie the Pooh Blood and Honey</h2>
          </div>

          <div class="per-movie flex">
              <h1 class="movie-screen">C4</h1>
              <div class="poster-container">
                <img class="movie-poster" src="/public/images/Furiosa.jpg" alt="Haikyuu Dumpster Battle Poster">
              </div>
              <h2 class="movie-title">Furiosa A Mad Max Saga </h2>
          </div>        
        </div>  
      </div>
      <div class="movies-container">
        <h2 class="movie-status">Next Picture</h2>
        <div class="movie-row flex">

          <div class="per-movie flex">
              <div class="poster-container">
                <img class="movie-poster" src="/public/images/Haikyu-Dumpster-Battle.jpg" alt="Haikyuu Dumpster Battle Poster">
              </div>
              <h2 class="movie-title">Haikyuu!! The Dumpster Battle</h2>
          </div>

          <div class="per-movie flex">
              <div class="poster-container">
                <img class="movie-poster" src="/public/images/Kingdom-of-the-Planet-of-the-Apes.jpg" alt="Haikyuu Dumpster Battle Poster">
              </div>
              <h2 class="movie-title">Kingdom of the Planet of the Apes</h2>
          </div>

          <div class="per-movie flex">
              <div class="poster-container">
                <img class="movie-poster" src="/public/images/WInnie-the-Pooh-Blood-and-Honey.jpg" alt="Haikyuu Dumpster Battle Poster">
              </div>
              <h2 class="movie-title">Winnie the Pooh Blood and Honey</h2>
          </div>

          <div class="per-movie flex">
              <div class="poster-container">
                <img class="movie-poster" src="/public/images/Furiosa.jpg" alt="Haikyuu Dumpster Battle Poster">
              </div>
              <h2 class="movie-title">Furiosa A Mad Max Saga</h2>
          </div>        
        </div>
      </div>
      <div class="movies-container">
        <h2 class="movie-status">Coming Soon</h2>
        <div class="movie-row flex">

          <div class="per-movie flex">
              <div class="poster-container">
                <img class="movie-poster" src="/public/images/Haikyu-Dumpster-Battle.jpg" alt="Haikyuu Dumpster Battle Poster">
              </div>
              <h2 class="movie-title">Haikyuu!! The Dumpster Battle</h2>
          </div>

          <div class="per-movie flex">
              <div class="poster-container">
                <img class="movie-poster" src="/public/images/Kingdom-of-the-Planet-of-the-Apes.jpg" alt="Haikyuu Dumpster Battle Poster">
              </div>
              <h2 class="movie-title">Kingdom of the Planet of the Apes</h2>
          </div>

          <div class="per-movie flex">
              <div class="poster-container">
                <img class="movie-poster" src="/public/images/WInnie-the-Pooh-Blood-and-Honey.jpg" alt="Haikyuu Dumpster Battle Poster">
              </div>
              <h2 class="movie-title">Winnie the Pooh Blood and Honey</h2>
          </div>

          <div class="per-movie flex">
              <div class="poster-container">
                <a href="movie_info.php"><img class="movie-poster" src="/public/images/Furiosa.jpg" alt="Haikyuu Dumpster Battle Poster"></a>
              </div>
              <h2 class="movie-title">Furiosa A Mad Max Saga</h2>
          </div>        
        </div>
      </div>
    </section>
  </main>
</body>
</html>