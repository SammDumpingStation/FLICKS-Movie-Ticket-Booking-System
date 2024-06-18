<?php
date_default_timezone_set('Asia/Manila');
$user = $_SESSION['user-type'] ?? null;

if (isset($user) || isset($_SESSION['first-name']) && isset($_SESSION['last-name'])) {
    $userName = $_SESSION['first-name'] . " " . $_SESSION['last-name'];
    $userType = $_SESSION['user-type'];
    $logStatus = 'Log-out';
    $landingPage = "/source/{$userType}/landing.php";
} else {
    $userName = "Log-in for discounts!";
    $logStatus = "Log-in";
    $landingPage = "/source/Customer/landing.php";
} if (isset($_GET['nav-logo']) && $_GET['nav-logo'] === 'home') {
  header('Location: ' . $landingPage);
}

if (isset($_GET['search-button']) && $_GET['search-button'] === 'search') {
  $_SESSION['search'] = $_GET['search'];
  header('Location: search.php');
}
?>

<header>
    <nav class="flex-center navbar">
      <form action="" method="get" class="flex-center">
        <button class="logo-link flex-center" name="nav-logo" value="home">
          <img class="logo" src="/public/images/logo.png" alt="">
          <h1 class="logo-label">FLICKS</h1>
        </button>
      </form>

      <form action="" method="get" class="search-div flex">
        <div class="search-bar">
          <input class="search-input" type="text" name="search" placeholder="Search for movies...">
        </div>
          <button name="search-button" value="search" class="search-button flex">
            <img class="button-icon" src="/public/images/search.png" alt="">
          </button>
      </form>

      <form action="/source/Log-in/reset.php" method="get" class="login-div flex-center">
        <h1 class="status"><?php echo $userName ?></h1>
        <button class="login-button" name="log-button" value="<?php echo $logStatus ?>"><?php echo $logStatus ?></button>
      </form>
    </nav>
  </header>