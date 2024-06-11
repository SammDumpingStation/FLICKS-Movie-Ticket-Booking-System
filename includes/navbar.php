<?php 
  if (isset($_SESSION['user-type']) && isset($_SESSION['user-name'])) {
    $userType = $_SESSION['user-type'];
    $userName = $_SESSION['user-name'];
    $logStatus = 'Log-out';
    $landingPage = "/source/{$userType}/landing.php";
  }
  else {
    $userName = "Log-in for discounts!";
    $logStatus = "Log-in";
    $landingPage = "/source/Customer/landing.php";
  }
?>

<header>
    <nav class="flex-center navbar">
      <section class="flex-center">
        <a class="logo-link flex-center" href=<?php echo $landingPage?>>
          <img class="logo" src="/public/images/logo.png" alt="">
          <h1 class="logo-label">FLICKS</h1> 
        </a>       
      </section>

      <section class="search-div flex">
        <div class="search-bar">
          <input class="search-input" type="text" name="" id="" placeholder="Search for movies, showtimes, or cinemas...">
        </div>
          <button class="search-button flex">
            <img class="button-icon" src="/public/images/search.png" alt="">
          </button>
      </section>

      <form action="/includes/Central Controller/navbar_control.php" method="get" class="login-div flex-center">
        <h1 class="status"><?php echo $userName?></h1>
        <button class="login-button"><?php echo $logStatus?></button>
      </form>
    </nav>
  </header>