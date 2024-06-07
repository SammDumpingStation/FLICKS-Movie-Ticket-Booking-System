<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php include_once '../../includes/css_links.php'?>
  <?php include_once '../../includes/admin-container.php'?>
  <link rel="stylesheet" href="../../public/css/Admin/admin-action-history.css">
  <title>Document</title>
</head>
<body>
  <?php include_once '../../includes/navbar_admin.php';?>

  <main>
    <button><a href="landing.php">Go Back</a></button>
    <section class="header">
      <h1 class="title">Admin Action History</h1>
    </section>

      <section class="container">
        <div class="info-container">
          <div class="info-div">
            <p class="grey p-info">Admin <span class="white">Samm Caagbay</span></p>
            <p class="grey p-info">Action: <span class="white">Delete</span></p>
            <p class="grey p-info">Table <span class="white">customer Table</span></p>
          </div>
          <div class="buttons">
            <a href="landing.php"><button class="green-bg">Full Details</button></a> 
          </div>
        </div>     
    </section>
</body>
</html>