<?php
session_start();

$userType = $_SESSION['user-type'];

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  $options = $_GET['option'] ?? null;
  if ($options === 'create') {
    header('Location: auth_portal.php');
    exit();
  }
  elseif ($options === 'cancel') {
    header('Location: auth_portal.php');
    exit();
  }
  elseif($options === 'log-in') {
    header("Location: log_in.php?options={$userType}");
    exit();
  }
}