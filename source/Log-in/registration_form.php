<?php
session_start();
include_once '../../classes/dbh.class.php';
$dbhconnect = new Dbh();
$option = $_POST['option'] ?? null;
$userType = $_SESSION['user-type'];

if ($userType === 'Admin') {
    $desc = 'Register to manage movies and approve tickets!';
} elseif ($userType === 'Customer') {
    $desc = 'Register to watch movies and get discounts!';
} else {
    $desc = 'Nothing to see here';
}
$_SESSION['description'] = $desc;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if ($option === 'cancel') {
        unset($_SESSION['user-type']);
        unset($_SESSION['id-num']);
        header('Location: auth_portal.php?options=register');
        exit;
    } elseif ($option === 'create') {
        //Add a new Customer/Admin
        $userType = $_SESSION['user-type'] ?? null;
        $id = $_SESSION['id-num'] ?? null;
        $fName = $_POST['first-name'] ?? null;
        $lName = $_POST['last-name'] ?? null;
        $email = $_POST['email'] ?? null;
        $phoneNumber = $_POST['phone-number'] ?? null;
        $pwd = $_POST['pwd'] ?? null;
        $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
        $repeatPwd = $_POST['repeat-pwd'] ?? null;

        if ($userType === 'Customer') {
            $query = "INSERT INTO customer (user_type, first_name, last_name, email, phone_number, customer_password, member_id, created_at) VALUES (:user_type, :first_name, :last_name, :email, :phone_number, :pwd, :refID, NOW())";
        } elseif ($userType === 'Admin') {
            $query = "INSERT INTO admin (user_type, first_name, last_name, email, phone_number, admin_password, employee_id, created_at) VALUES (:user_type, :first_name, :last_name, :email, :phone_number, :pwd, :refID, NOW())";
        }

        try {
            $stmt = $dbhconnect->connection()->prepare($query);
            $stmt->bindParam(":user_type", $userType, PDO::PARAM_STR);
            $stmt->bindParam(":first_name", $fName, PDO::PARAM_STR);
            $stmt->bindParam(":last_name", $lName, PDO::PARAM_STR);
            $stmt->bindParam(":email", $email, PDO::PARAM_STR);
            $stmt->bindParam(":phone_number", $phoneNumber, PDO::PARAM_STR);
            $stmt->bindParam(":pwd", $hashedPwd, PDO::PARAM_STR);
            $stmt->bindParam(":refID", $id, PDO::PARAM_STR);

            if (!$stmt->execute()) {
                throw new Exception("Failed to insert customer data");
            } else {
                header('Location: auth_portal.php');
                exit;
            }
        } catch (\Throwable $th) {
            // Handle the exception here
            die("Query Failed. " . $th->getMessage());
            exit;
        }
    }
}
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
    <form class="main-form" action="" method="post">
      <section>
        <h1 class="title">Registration Form for <?php echo $_SESSION['user-type'] ?></h1>
        <h2><?php echo $desc ?? $_SESSION['description'] ?? null ?></h2>
        <input type="hidden" name="desc" value="<?php echo $desc ?? $_SESSION['description'] ?? null ?>" id="">
      </section>
      <section class="main-input">
        <div class="name-section">
          <label for="fname" class="input-div half">
            <h6>First Name</h6>
            <input type="text" name="first-name" id="fname" placeholder="First Name">
          </label>
          <label for="lname" class="input-div half last-name">
            <h6>Last Name</h6>
          <input type="text" name="last-name" id="lname" placeholder="Last Name">
          </label>
        </div>

        <label for="email" class="input-div">
          <h6>Email</h6>
        <input type="text" name="email" id="email" placeholder="Email">
        </label>

        <label for="p-number" class="input-div">
          <h6>Phone Number</h6>
        <input type="text" name="phone-number" id="p-number" placeholder="Phone Number">
        </label>

        <label for="pwd" class="input-div pwd">
          <h6>Password</h6>
          <img id="toggleBtn" src="../../public/images/view.png" alt="">
          <input type="password" name="pwd" id="pwd" placeholder="Password">
        </label>

        <label for="repeat-pwd" class="input-div pwd">
          <h6>Repeat Password</h6>
          <img id="repeatBtn" src="../../public/images/view.png" alt="">
          <input type="password" name="repeat-pwd" id="repeat-pwd" placeholder="Repeat Password">
        </label>
      </section>

      <section class="click-buttons">
          <button name="option" value="cancel" class="go-back">Cancel</button>
          <button name="option" value="create" class="proceed">Create Account</button>
      </section>

      <p class="forgot">Already have an account? <button class="log-in" name="option" value="log-in">Log-in</button></p>
    </form>
  </main>


<script>
        const passwordField = document.getElementById('pwd');
        const toggleBtn = document.getElementById('toggleBtn');
        const repeatPassField = document.getElementById('repeat-pwd');
        const repeatBtn = document.getElementById('repeatBtn');

        toggleBtn.addEventListener('click', function() {
            const currentType = passwordField.getAttribute('type');
            const imgSrc = toggleBtn.getAttribute('src');

            if (currentType === 'password') {
                passwordField.setAttribute('type', 'text');
                toggleBtn.setAttribute('src', '../../public/images/hide.png');
            } else {
                passwordField.setAttribute('type', 'password');
                toggleBtn.setAttribute('src', '../../public/images/view.png');
            }
        });
        repeatBtn.addEventListener('click', function() {
            const currentType = repeatPassField.getAttribute('type');
            const imgSrc = repeatBtn.getAttribute('src');

            if (currentType === 'password') {
                repeatPassField.setAttribute('type', 'text');
                repeatBtn.setAttribute('src', '../../public/images/hide.png');
            } else {
                repeatPassField.setAttribute('type', 'password');
                repeatBtn.setAttribute('src', '../../public/images/view.png');
            }
        });
    </script>
</body>
</html>