<?php
session_start();
include_once '../../classes/dbh.class.php';
$dbhconnect = new Dbh();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $user = $_GET['options'] ?? ($_SESSION['user-type'] ?? null);
    $id = $_GET['id-num'] ?? ($_SESSION['id-num'] ?? null);
    $buttons = $_GET['buttons'] ?? null;
    $title = $_GET['title'] ?? null;
    $desc = $_GET['desc'] ?? null;
    $status = $_GET['status'] ?? null;
    $action = 'Check';

    if (isset($buttons) && $buttons === 'Cancel') {
        unset($_SESSION['user-type']);
        unset($_SESSION['id-num']);
        header('Location: auth_portal.php?options=register');
        exit;
    } elseif (isset($buttons) && $buttons === 'Check' || $buttons === 'Try Again') {
        if ($user === 'Admin') {
            $checkQuery = "SELECT * FROM employee_id WHERE identification_num = :id;";
        } elseif ($user === 'Customer') {
            $checkQuery = "SELECT * FROM member_id WHERE identification_num = :id;";
        }
        if (empty($id)) {
            $verdict = '*Please enter your identification number*';
            $action = "Try Again";
            $verdictClass = 'not-okay';
        } else {
            $_SESSION['id-num'] = $id;
            $stmt = $dbhconnect->connection()->prepare($checkQuery);
            $stmt->bindParam(":id", $id, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                $verdict = '*You are a Registered User. Please click proceed to get started.*';
                $action = 'Proceed';
                $verdictClass = 'okay';
            } elseif (empty($result)) {
                $verdict = '*You are currently not a member. Please buy a membership card at our physical store. Thank You!*';
                $action = "Try Again";
                $verdictClass = 'not-okay';
            }
        }

    } elseif (isset($buttons) && $buttons === 'Proceed') {
        header('Location: registration_form.php');
        exit;
    } elseif (empty($buttons)) {
        if (isset($user)) {
            if ($user === 'Admin') {
                $title = 'Existing Employee?';
                $desc = 'Only employees of FLICKS that is verified are allowed to have an account. Please verify if you are currently a verified employee or not.';
            } elseif ($user === 'Customer') {
                $title = 'Existing Card Member?';
                $desc = 'Only registered members of FLICKS are allowed to have an account. Please verify if you are currently a member or not.';
            }
        }
    } else {
        header('Location: auth_portal.php?=error');
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
    <section action="" method="get" class="main-form">
      <h1 class="title"><?php echo $title ?></h1>

      <h2 class="title2"><?php echo $desc ?></h2>

      <form action="" class="main-input" method="get">
      <input type="hidden" name="title" value="<?php echo $title ?>" id="">
      <input type="hidden" name="desc" value="<?php echo $desc ?>" id="">
        <label for="id-num" class="input-form">
          <img src="../../public/images/id.png" alt="">
          <input id="id-num" type="text" name="id-num" placeholder="Identification Number" value="<?php echo $id ?>">
        </label>
        <h2 class="<?php echo $verdictClass ?>"><?php echo $verdict ?? null ?></h2>
        <div class="click-buttons">
          <button name="buttons" value="Cancel" class="go-back">Cancel</button>
          <button name="buttons" value="<?php echo $action ?>" class="proceed"><?php echo $action ?></button>
        </div>
        <button name="buttons" value="not-member" class="forgot">Not a member?</button>
      </form>
    </section>
  </main>

</body>
</html>
