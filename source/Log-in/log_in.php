<?php 
  $chose = $_GET['options'];
  $user = null;
  $opposite = null;
  $description = null;
  if (isset($chose) && $chose === 'Customer') {
    $user = 'Customer';
    $opposite = 'Admin';
    $description = 'Log-in to get discounts when using FLICKS!';
  }
  elseif (isset($chose) && $chose === 'Admin') {
    $user = 'Admin';
    $opposite = 'Customer';
    $description = 'Manage Movies and Approve Tickets with FLICKS!';
} else {
  header('Location: auth_portal.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php include_once '../../includes/login_css_links.php'?>
  <link rel="stylesheet" href="../../public/css/Log-In/log-in.css">
  <title>Log-in Landing Page</title>
</head>
<body>
  <?php include_once('../../includes/login_logo.php')?>

  <main>
    <form class="main-form" action="log_in.php" method="get">
      <h1 class="title">Welcome <?php echo $user?>!</h1>
      <h2 class="title-desc"><?php echo $description?></h2>
      <section class="main-input">
        <label for="username" class="input-form">
          <img src="../../public/images/user.png" alt="">
          <input id="username" type="text" name="username" placeholder="Username or Email">
        </label>
        <label for="password" class="input-form">
          <img src="../../public/images/padlock.png" alt="">
          <input id="password" type="text" name="password" placeholder="Password">
          <img src="../../public/images/hide.png" alt="">
        </label>
        <label for="keep-login" class="keep-login">
          <input type="checkbox" name="keep-login" id="keep-login">
          <p>Keep me Logged In</p>
        </label>
        <button class="proceed">Continue</button>
        <p class="forgot">Forgot Password?</p>
      </section>
    </form>
    <section class="register">
      <div class="register-header">
        <hr class="line1">
        <p>Don't have a FLICKS account?</p>
        <hr class="line2">
      </div>
      
      <section class="last-section">
        <form class="last-form" action="log_in.php" method="get">
          <button class="opposite-button" name="options" value="<?php echo $opposite?>">
            Log-in as <?php echo $opposite?>
          </button>
        </form>
        <form class="last-form" action="auth_portal.php" method="get">
          <button type="submit" class="register-button" name="operation" value="register">
            Register</button>
        </form>
      </section>
    </section>
  </main>

</body>
</html>
