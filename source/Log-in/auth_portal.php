<?php
  session_start();
  if (isset($_GET['operation']) && $_GET['operation'] === 'register') {
    $operation = 'Register';
    $fileLink = 'registration_form.php';
}

  else {
    $operation = 'Log-in';
    $fileLink = 'log_in.php';
  }
  $_SESSION['web-status'] = 'authentication';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php include_once '../../includes/login_css_links.php'?>
  <link rel="stylesheet" href="../../public/css/Log-In/auth_portal.css">
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
      <section class="portal-button">
        <button class="go-back" name="portal-button" value="cancel">
            Cancel
        </button>
        <button class="proceed" name="portal-button" value="continue">
            Continue
        </button>
      </section>
  </form>
  </main>
</body>
</html>
