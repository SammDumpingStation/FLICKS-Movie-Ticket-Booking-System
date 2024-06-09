<?php
  $operation = null;
  $fileLink = null;
  if (isset($_GET['operation']) && $_GET['operation'] === 'register') {
    $operation = 'Register';
    $fileLink = 'register.php';
}
  else {
    $operation = 'Log-in';
    $fileLink = 'log_in.php';
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php include_once '../../includes/login_css_links.php'?>
  <link rel="stylesheet" href="../../public/css/Log-In/log-in-landing.css">
  <title><?php echo $operation?> Landing Page</title>
</head>
<body>
  <?php include_once('../../includes/login_logo.php')?>

  <form action="<?php echo $fileLink?>" method="get">
    <h1 class="title"><?php echo $operation ?> as a Customer or Admin</h1>
    <section class="option-section">
      <label for="have-account" class="option">
        <input id="have-account" class="radio" type="radio" name="options" value="Customer">
        <span class="custom-radio"></span>
        <img src="../../public/images/user.png" alt="">
        <label for="have-account">I'm a Customer</label>
      </label>

      <label for="no-account" class="option">
        <input id="no-account" class="radio" type="radio" name="options" value="Admin">
        <span class="custom-radio"></span>
        <img src="../../public/images/admin.png" alt="">
        <label for="no-account">I'm an Admin</label>
      </label>
      <button class="continue-button proceed">
          Continue
      </button>
  </form>
  </main>
</body>
</html>
