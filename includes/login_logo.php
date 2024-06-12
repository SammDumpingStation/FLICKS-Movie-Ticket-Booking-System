<?php 
  $logInAs = null;
  if (isset($_SESSION['web-status'])) {
    $webStatus = $_SESSION['web-status'];
    if ($webStatus === 'authentication') {
      $logInAs = null;
    }
    elseif ($webStatus === 'Join as Customer') {
      $logInAs = $webStatus;
    } elseif ($webStatus === 'Join as Admin') {
      $logInAs = $webStatus;
    }
  }
?>

<header>
  <nav class="login-nav">
    <a class="logo-link flex-center" href="/source/Log-in/log_in.php">
      <img class="logo" src="/public/images/logo.png" alt="">
      <h1 class="logo-label">FLICKS</h1> 
    </a>
      <button class="join-as"><?php echo $logInAs?></button>
  </nav>
</header>