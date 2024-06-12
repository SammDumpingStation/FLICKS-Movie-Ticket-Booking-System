<?php
session_start();
$user =  $_SESSION['user-type'];
$username = $_GET['username'];
$password = $_GET['pwd'];
if (isset($_GET['Log-in'])) {
  $_SESSION['user-name'] = $username;
  $_SESSION['user-type'];
  header("Location: ../{$user}/landing.php");
  exit();
}