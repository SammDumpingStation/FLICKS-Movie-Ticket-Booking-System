<?php
$actionType = $_SESSION['action-type'];

$logInAs = null;
if (isset($_SESSION['web-status'])) {
    $webStatus = $_SESSION['web-status'];
    if ($webStatus === 'authentication') {
        if ($actionType === 'Log-in') {
            $logInAs = 'Register Here!';
            $actionType = 'Register';
        } else {
            $logInAs = 'Login Here!';
            $actionType = 'Log-in';
        }
    } elseif ($webStatus === 'Join as Customer') {
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
    <form action="auth_portal.php" method="get">
      <button class="join-as" name="operation" value="<?php echo $actionType ?>"><?php echo $logInAs ?></button>
    </form>
  </nav>
</header>