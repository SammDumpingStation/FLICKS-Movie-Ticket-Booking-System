<?php
  session_start();
  

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php include_once '../../includes/login_css_links.php'?>
  <link rel="stylesheet" href="../../public/css/Log-In/register-form.css">
  <title>Registration Form</title>
</head>
<body>
  <?php include_once '../../includes/login_logo.php'?>

  <main>
    <form class="main-form">
      <section>
        <h1 class="title">Registration Form for Customers</h1>
        <h2>Register to watch movies and get discounts!</h2>
      </section>
      <section class="main-input">
        <div class="name-section">
          <label for="fname" class="input-div half">
            <h6>First Name</h6>
            <input type="text" name="" id="fname" placeholder="First Name">
          </label>
          <label for="lname" class="input-div half last-name">
            <h6>Last Name</h6>
          <input type="text" name="" id="lname" placeholder="Last Name">
          </label>
        </div>

        <label for="email" class="input-div">
          <h6>Email</h6>
        <input type="text" name="" id="email" placeholder="Email">
        </label>

        <label for="p-number" class="input-div">
          <h6>Phone Number</h6>
        <input type="text" name="" id="p-number" placeholder="Phone Number">
        </label>

        <label for="pwd" class="input-div lname">
          <h6>Password</h6>
        <input type="text" name="" id="pwd" placeholder="Password">
        </label>

        <label for="repeat-pwd" class="input-div lname">
          <h6>Repeat Password</h6>
        <input type="text" name="" id="repeat-pwd" placeholder="Repeat Password">
        </label>
      </section>

      <section class="click-buttons">
          <a href="auth_portal.php"><button name="operation" value="cancel" class="go-back">Cancel</button></a>
          <a href="registration_form.php"><button name="operation" value="Check" class="proceed">Create Account</button></a>
      </section>
            
      <p class="forgot">Already have an account? <button class="log-in">Log-in</button></p>
    </form>    
  </main>

</body>
</html>