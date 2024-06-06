<?php
session_start();
include 'functions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $user = loginUser($username, $password);
    if ($user) {
        $_SESSION['user'] = $user; 
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Login gagal.";
    }
}
?>