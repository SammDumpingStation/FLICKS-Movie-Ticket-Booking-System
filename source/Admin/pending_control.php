<?php
session_start();
$cinemaNum = $_GET['cinema'];
if (isset($cinemaNum)) {
  echo $_SESSION['cinema-title'];
  echo $_SESSION['cinema-number'];
}