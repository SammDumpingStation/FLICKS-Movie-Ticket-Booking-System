<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php include_once '../../includes/login_css_links.php'?>
  <link rel="stylesheet" href="../../public/css/Log-In/register.css">
  <title>Check Identification Number</title>
</head>
<body>
  <?php include_once '../../includes/login_logo.php'?>

  <main>
    <section class="main-form">
      <h1 class="title">Are you a FLICKS Member?</h1>
      <h2 class="title-desc">*Only registered members of FLICKS are allowed to have an account. Please verify if you are currently a member or not.*</h2>
      <section class="main-input">
        <label for="username" class="input-form">
          <img src="../../public/images/id.png" alt="">
          <input id="username" type="text" name="username" placeholder="Identification Number">
        </label>
        <div class="click-buttons">
          <a href="auth_portal.php"><button name="operation" value="cancel" class="go-back">Cancel</button></a>
          <a href="registration_form.php"><button name="operation" value="Check" class="proceed">Check</button></a>
        </div>
        
        <p class="forgot">Not a member?</p>
      </section>
    </section>
  </main>

</body>
</html>
