<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $user = $_GET['options'];

    if (isset($user)) {
        if ($user === 'Admin') {
            $title = 'Existing Employee?';
            $desc = 'Only employees of FLICKS that is verified are allowed to have an account. Please verify if you are currently a verified employee or not.';
        } else {
            $title = 'Existing Card Member?';
            $desc = 'Only registered members of FLICKS are allowed to have an account. Please verify if you are currently a member or not.';
        }
    } else {
        header('Location: auth_portal.php');
    }
    $_SESSION['user-type'] = $user;

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php include_once '../../includes/login_css_links.php'?>
  <link rel="stylesheet" href="../../public/css/Log-In/register_checkID.css">
  <title>Check Identification Number</title>
</head>
<body>
  <?php include_once '../../includes/login_logo.php'?>

  <main>
    <section class="main-form">
      <h1 class="title"><?php echo $title ?></h1>
      <h2 class="title2"><?php echo $desc ?></h2>
      <form action="registration_form.php" class="main-input" method="get">
        <label for="username" class="input-form">
          <img src="../../public/images/id.png" alt="">
          <input id="username" type="text" name="username" placeholder="Identification Number">
        </label>
        <div class="click-buttons">
          <button name="options" value="cancel" class="go-back">Cancel</button>
          <button name="options" value="check" class="proceed">Check</button>
        </div>
        <button name="options" value="not-member" class="forgot">Not a member?</button>
      </form>
    </section>
  </main>

</body>
</html>
