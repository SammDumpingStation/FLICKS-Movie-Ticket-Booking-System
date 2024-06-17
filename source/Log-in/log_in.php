<?php
session_start();
include_once '../../classes/dbh.class.php';
$dbhconnect = new Dbh();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $chose = $_GET['options'] ?? null;
    $verdict = null;

    if (isset($_GET['portal-button']) && $_GET['portal-button'] === 'cancel') {
        session_unset();
        session_destroy();
        header('Location: ../Customer/landing.php');
        exit();
    } else {
        if (isset($chose)) {
            if ($chose === 'Customer') {
                $user = 'Customer';
                $opposite = 'Admin';
                $description = 'Log-in to get discounts when using FLICKS!';
            } elseif ($chose === 'Admin') {
                $user = 'Admin';
                $opposite = 'Customer';
                $description = 'Manage Movies and Approve Tickets with FLICKS!';
            }
            $_SESSION['web-status'] = "Join as {$opposite}";
            $_SESSION['user-type'] = $user;
            $_SESSION['opposite'] = $opposite;
            $_SESSION['descript'] = $description;
        } else {
            header('Location: auth_portal.php');
            exit;
        }
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $userType = $_SESSION['user-type'];
        $input = $_POST['input-user'];
        $pwd = $_POST['pwd'];

        if ($userType === 'Admin') {
            $userQuery = "SELECT * FROM admin WHERE first_name = :input OR email = :input";
        } elseif ($userType === 'Customer') {
            $userQuery = "SELECT * FROM customer WHERE first_name = :input OR email = :input";
        }

        $userStmt = $dbhconnect->connection()->prepare($userQuery);
        $userStmt->bindParam(":input", $input, PDO::PARAM_STR);
        $userStmt->execute();
        $result = $userStmt->fetch(PDO::FETCH_ASSOC);

        if (!$result) {
            $verdict = "*Username not found*";
        } else {
            if ($userType === 'Admin') {
                $pwdHashed = $result['admin_password'];
            } elseif ($userType === 'Customer') {
                $pwdHashed = $result['customer_password'];
            }

            if (password_verify($pwd, $pwdHashed)) {
                $_SESSION['first-name'] = $result['first_name'];
                $_SESSION['email'] = $result['email'];
                $_SESSION['last-name'] = $result['last_name'];
                $_SESSION['phone-number'] = $result['phone_number'];

                header("Location: ../{$userType}/landing.php");
                exit();
            } else {
                $verdict = "*Wrong Password*";
            }
        }
    } catch (\Throwable $th) {
        die("Query Failed. " . $th->getMessage());
    }
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
  <?php include_once '../../includes/login_logo.php'?>

  <main>
    <form class="main-form" action="" method="post">
      <h1 class="title">Welcome <?php echo $_SESSION['user-type'] ?>!</h1>
      <h2 class="title-desc"><?php echo $_SESSION['descript'] ?></h2>
      <section class="main-input">
        <label for="username" class="input-form">
          <img src="../../public/images/user.png" alt="">
          <input id="username" type="text" name="input-user" placeholder="Username or Email">
        </label>
        <label for="password" class="input-form">
          <img src="../../public/images/padlock.png" alt="">
          <input id="password" type="password" name="pwd" placeholder="Password">
          <img src="../../public/images/hide.png" alt="">
        </label>
        <label for="keep-login" class="keep-login">
          <input type="checkbox" name="keep-login" id="keep-login">
          <p>Keep me Logged In</p>
        </label>
        <h3 class="verdict"><?php echo $verdict ?? null ?></h3>
        <button class="proceed" name="Log-in" value="Log-in">Log-in</button>
        <button class="forgot">Forgot Password?</button>
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
          <button class="opposite-button" name="options" value="<?php echo $_SESSION['opposite'] ?>">
            Log-in as <?php echo $_SESSION['opposite'] ?>
          </button>
        </form>
        <form class="last-form" action="auth_portal.php" method="get">
          <button type="submit" class="register-button" name="options" value="register">
            Register</button>
        </form>
      </section>
    </section>
  </main>

</body>
</html>
