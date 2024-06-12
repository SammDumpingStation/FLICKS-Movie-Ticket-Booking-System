<?php
session_start();
$user = $_SESSION['user-type'];
$username = $_GET['username'];
$password = $_GET['pwd'];
if (isset($_GET['log-in'])) {
  $_SESSION['user-name'] = $username;
  header("Location: ../{$user}/landing.php");
  exit();
}