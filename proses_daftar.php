<?php
include 'functions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    if (registerUser($nama, $username, $password)) {
        header("Location: login.html");
    } else {
        echo "Pendaftaran gagal.";
    }
}
?>