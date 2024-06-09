<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php include_once '../../includes/css_links.php'?>
  <link rel="stylesheet" href="../../public/css/Admin/registered-users.css">
  <title>Registered Users</title>
</head>
<body>
  <?php include_once '../../includes/navbar.php';?>

  <main>
    <a href="landing.php"><button class="return">Return</button></a>
    <section class="header">
      <h1 class="title">Registered Users</h1>
    </section>

      <section class="container">
        <div class="info-container">
          <div class="info-div">
            <p class="grey p-info">Customer <span class="white">Samm Caagbay</span></p>
            <p class="grey p-info">Registration No.: <span class="white">1234563</span></p>
            <p class="grey p-info">Movies Booked: <span class="white">1</span></p>
          </div>
          <div class="buttons">
            <button class="green-bg">Full Details</button>
            <button class="yellow-bg">Update</button> 
            <button class="red-bg">Delete</button> 

          </div>
        </div>     
    </section>
</body>
</html>