<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $user = $_SESSION['user-type'];
    $username = $_GET['username'];
    $password = $_GET['pwd'];
    if (isset($_GET['Log-in'])) {
        $_SESSION['user-name'] = $username;
        $_SESSION['user-type'];
        header("Location: ../{$user}/landing.php");
        exit();
    }
}
