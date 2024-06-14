<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php include_once '../../includes/css_links.php'?>
  <link rel="stylesheet" href="../../public/css/Admin/cinema-assignment.css">
  <title>Document</title>
</head>
<body>
  <?php include_once '../../includes/navbar.php';?>
  <main>
    <a href="landing.php"><button class="return">Return</button></a>
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
                <div class="show-times">
                  <h2 class="times-title">Show Times</h2>
                  <h6 class="time">12:30</h6>
                  <h6 class="time">3:30</h6>
                  <h6 class="time">7:30</h6>
                </div>
          </div>

          <div class="per-movie flex">
              <h1 class="movie-screen">C2</h1>
              <div class="poster-container">
                <img class="movie-poster" src="/public/images/Kingdom-of-the-Planet-of-the-Apes.jpg" alt="Haikyuu Dumpster Battle Poster">
              </div>
              <h2 class="movie-title">Kingdom of the Planet of the Apes</h2>
              <div class="show-times">
                  <h2 class="times-title">Show Times</h2>
                  <h6 class="time">12:30</h6>
                  <h6 class="time">3:30</h6>
                  <h6 class="time">7:30</h6>
                </div>
          </div>

          <div class="per-movie flex">
              <h1 class="movie-screen">C3</h1>
              <div class="poster-container">
                <img class="movie-poster" src="/public/images/WInnie-the-Pooh-Blood-and-Honey.jpg" alt="Haikyuu Dumpster Battle Poster">
              </div>
              <h2 class="movie-title">Winnie the Pooh Blood and Honey</h2>
              <div class="show-times">
                  <h2 class="times-title">Show Times</h2>
                  <h6 class="time">12:30</h6>
                  <h6 class="time">3:30</h6>
                  <h6 class="time">7:30</h6>
                </div>
          </div>

          <div class="per-movie flex">
              <h1 class="movie-screen">C4</h1>
              <div class="poster-container">
                <img class="movie-poster" src="/public/images/Furiosa.jpg" alt="Haikyuu Dumpster Battle Poster">
              </div>
              <h2 class="movie-title">Furiosa A Mad Max Saga </h2>
              <div class="show-times">
                  <h2 class="times-title">Show Times</h2>
                  <h6 class="time">12:30</h6>
                  <h6 class="time">3:30</h6>
                  <h6 class="time">7:30</h6>
                </div>
          </div>        
        </div>  
      </div>

      <section class="button-operations">
        <button class="go-back" name="submit" value="cancel">Cancel</button>
        <button class="proceed" name="submit" value="save">Save</button>
      </section>
    </section>
  </main>
</body>
</html>