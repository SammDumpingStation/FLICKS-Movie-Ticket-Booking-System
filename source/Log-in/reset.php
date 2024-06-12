<?php
session_start();
$logButton = $_GET['log-button'];
if (isset($logButton) && $logButton === 'Log-out') {
    session_unset();
    session_destroy();
    header('Location: auth_portal.php');
    exit;
}
else {
  header('Location: auth_portal.php');
  exit;
}
