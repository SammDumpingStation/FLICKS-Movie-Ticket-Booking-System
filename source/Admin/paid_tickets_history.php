<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php include_once '../../includes/css_links.php'?>
  <link rel="stylesheet" href="../../public/css/Admin/paid-tickets-history.css">
  <title>Document</title>
</head>
<body>
  <?php include_once '../../includes/navbar.php';?>

  <main>
    <a href="landing.php"><button class="return">Return</button></a>
    <h1 class="title">Paid Tickets History</h1>
    <section class="container">
      <div class="info-container">
        <div class="info-div">
          <p class="grey p-info">Guest:<span class="white">Samm Reyven Joey Caagbay</span></p>
          <p class="grey p-info">Movie:<span class="white">Furiosa: A Mad Max Saga</span></p>
          <p class="grey p-info">Status:<span class="white">Paid</span></p>
          <p class="grey p-info">Total Cost:<span class="white">$3240</span></p>
        </div>
        <div class="buttons">
          <button class="green-bg">Full Details</button>
          <button class="red-bg">Delete</button>
        </div>
      </div>
    </section>
  </main>
</body>
</html>