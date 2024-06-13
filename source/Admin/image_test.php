<?php include_once('../../classes/dbh.class.php');
  $dbhconnect = new Dbh();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php include_once '../../includes/css_links.php'?>
  <link rel="stylesheet" href="../../public/css/Customer/book-ticket.css">
  <title>Document</title>
</head>
<body>
  <form action="" method="get" enctype="multipart/form-data">
  <input type="file" name="image">
  <br> <br>
  <button type="submit" name="submit"></button>
  </form>
  
</body>
</html>