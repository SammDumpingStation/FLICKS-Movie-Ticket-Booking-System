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
  <?php include_once '../../includes/login_css_links.php'?>
  <link rel="stylesheet" href="../../public/css/Log-In/log-in-landing.css">
  <title>Log-in Landing Page</title>
</head>
<body>
  <?php include_once('../../includes/login_logo.php')?>

  <form action="log_in.php" method="get">
    <h1 class="title">Log-in as a Customer or Admin</h1>
    <section class="option-section">
      <label for="have-account" class="option">
        <input id="have-account" class="radio" type="radio" name="options" value="customer">
        <span class="custom-radio"></span>
        <img src="../../public/images/user.png" alt="">
        <label for="have-account">I'm a Customer</label>
      </label>

      <label for="no-account" class="option">
        <input id="no-account" class="radio" type="radio" name="options" value="admin">
        <span class="custom-radio"></span>
        <img src="../../public/images/admin.png" alt="">
        <label for="no-account">I'm an Admin</label>
      </label>
    </section>
    <button class="proceed">
        Continue
    </button>
  </main>
</body>
</html>
