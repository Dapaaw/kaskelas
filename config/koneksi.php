<?php
$host = 'localhost';
$user = 'root';
$pass = ''; 
$db   = 'kas_kelas';

$conn = new mysqli($host, $user, $pass, $db, );

if ($conn->connect_error) {
    die("Koneksi database gagal: " . $conn->connect_error);
}
