<?php 
  $chose = $_GET['options'];
  $user = null;
  if (isset($chose) && $chose === 'customer') {
    $user = 'Customer';
  }
  elseif (isset($chose) && $chose === 'admin') {
    $user = 'Admin';
} else {
  echo "Unauthorized Access";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <?php echo $user?>
</body>
</html>