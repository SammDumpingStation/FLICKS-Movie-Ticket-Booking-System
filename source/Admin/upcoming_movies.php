<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php include_once '../../includes/css_links.php'?>
  <link rel="stylesheet" href="../../public/css/Admin/stashed-movie.css">
  <title>Upcoming Movies</title>
</head>
<body>
  <?php include_once '../../includes/navbar.php';?>

  <main>
    <a href="landing.php"><button class="return">Return</button></a>
    <section class="header">
      <h1 class="title">Upcoming Movies</h1>
    </section>

     <section class="movies-section flex">
      <div class="movies-container">
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
              <h2 class="movie-title">Furiosa A Mad Max Saga </h2>
          </div>        
        </div>  
      </div>
           
    </section>
</body>
</html>