<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php include_once '../../includes/css_links.php'?>
  <link rel="stylesheet" href="../../public/css/Admin/manage-movie.css">
  <title>Document</title>
</head>
<body>
  <?php include_once '../../includes/navbar.php';?>

  <main>
    <a href="landing.php"><button class="return">Return</button></a>
    <section class="header">
      <h1 class="title">Manage Movies</h1>
      <div class="sorting-movies">
        <button>Recently Added</button>
        <button>Alphabetical Order</button>
        <button>Now Showing</button>
        <button>Next Picture</button>
        <button>Coming Soon</button>
        <button>Stashed</button>
        <button>Upcoming Movies</button>
      </div>
    </section>

    <section class="container">
      <div class="info-container">
        <div class="info-div">
          <p class="grey p-info">Movie Title <span class="white">Furiosa: A Mad Max Saga</span></p>
          <p class="grey p-info">Status: <span class="white">Now Showing</span></p>
          <p class="grey p-info">Screen Location: <span class="white">Cinema 1</span></p>
        </div>
        <div class="buttons">
          <button class="yellow-bg">Edit Movie</button>
          <button class="red-bg">Delete</button>
        </div>
      </div>
    </section>
  </main>
</body>
</html>