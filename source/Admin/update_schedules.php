<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php include_once '../../includes/css_links.php'?>
  <link rel="stylesheet" href="../../public/css/Admin/update-schedules.css">
  <title>Document</title>
</head>
<body>
  <?php include_once '../../includes/navbar.php';?>

  <main>
    <a href="landing.php"><button class="return">Return</button></a>
    <section class="header">
      <h1 class="title">Update Schedules</h1>
    </section>

    <section>
      <h1 class="title2">Now Showing</h1>
      <section class="container">
        <div class="info-container">
          <div class="info-div">
            <p class="grey p-info">Movie Title <span class="white">Furiosa: A Mad Max Saga</span></p>
            <p class="grey p-info">Status: <span class="white">Now Showing</span></p>
            <p class="grey p-info">Screen Location: <span class="white">Cinema 1</span></p>
          </div>
          <div class="buttons">
            <button class="green-bg">Stash</button>
            <button class="red-bg">Move to Next Picture</button>
          </div>
        </div>
      </section>      
    </section>

    <section>
      <h1 class="title2">Next Picture</h1>
      <section class="container">
        <div class="info-container">
          <div class="info-div">
            <p class="grey p-info">Movie Title <span class="white">Furiosa: A Mad Max Saga</span></p>
            <p class="grey p-info">Status: <span class="white">Next Picture</span></p>
            <p class="grey p-info">Screen Location: <span class="white">Not Applicable</span></p>
          </div>
          <div class="buttons">
            <button class="green-bg">Move to Now Showing</button>
            <button class="red-bg">Move to Coming Soon</button>
          </div>
        </div>
      </section>      
    </section>

    <section>
      <h1 class="title2">Coming Soon</h1>
      <section class="container">
        <div class="info-container">
          <div class="info-div">
            <p class="grey p-info">Movie Title <span class="white">Furiosa: A Mad Max Saga</span></p>
            <p class="grey p-info">Status: <span class="white">Coming Soon</span></p>
            <p class="grey p-info">Screen Location: <span class="white">Not Applicable</span></p>
          </div>
          <div class="buttons">
            <button class="green-bg">Move to Next Picture</button>
            <button class="red-bg">Move to Upcoming Movies</button>
          </div>
        </div>
      </section>      
    </section>

    <section>
      <h1 class="title2">Upcoming Movies</h1>
      <section class="container">
        <div class="info-container">
          <div class="info-div">
            <p class="grey p-info">Movie Title <span class="white">Furiosa: A Mad Max Saga</span></p>
            <p class="grey p-info">Status: <span class="white">Upcoming Movie</span></p>
            <p class="grey p-info">Screen Location: <span class="white">Not Applicable</span></p>
          </div>
          <div class="buttons">
            <button class="green-bg">Move to Coming Soon</button>
            <button class="red-bg">Move to Stashed</button>
          </div>
        </div>
      </section>      
    </section>
  </main>
</body>
</html>