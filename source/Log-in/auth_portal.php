<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $userOperation = $_GET['options'] ?? null;
    $logButton = $_GET['log-button'] ?? null;

    if (isset($userOperation) && $userOperation === 'register' || $userOperation === 'Register') {
        $operation = 'Register';
        $fileLink = 'register_checkID.php';
        $smallDesc = 'Join us today and enjoy exclusive benefits and discounts!';
    } elseif (!$userOperation || $userOperation === 'Log-in' || $userOperation === 'log-in') {
        $operation = 'Log-in';
        $fileLink = 'log_in.php';
        $smallDesc = 'Log in to access your personalized dashboard and special offers!';
    } else {
        header('Location: ../Customer/landing.php');
        exit();
    }

}
$_SESSION['web-status'] = 'authentication' ?? null;
$_SESSION['action-type'] = $operation ?? null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php include_once '../../includes/login_css_links.php'?>
  <link rel="stylesheet" href="../../public/css/Log-In/auth_portal.css">
  <title><?php echo $operation ?> Landing Page</title>
</head>
<body>
  <?php include_once '../../includes/login_logo.php'?>

  <form action="<?php echo $fileLink ?>" method="get">
    <h1 class="title"><span class="operation-type"><?php echo $operation ?></span> with FLICKS Today!</h1>
    <h2 class="title2"><?php echo $smallDesc ?></h2>
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
