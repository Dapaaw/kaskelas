<?php
session_start();
require 'config/koneksi.php';

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM anggota WHERE username='$username' AND role='bendahara'";
$result = $conn->query($sql);

if ($result && $result->num_rows == 1) {
    $user = $result->fetch_assoc();
    if (password_verify($password, $user['password'])) {
        $_SESSION['user'] = $user;
        header("Location: dashboard.php");
        exit;
    }
}

echo "Login gagal. Pastikan username dan password benar.";
