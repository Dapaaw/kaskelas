<?php
$host = 'localhost';
$port = '3306';
$user = 'root';
$pass = ''; // Kosong jika tidak ada password
$db   = 'kas_kelas';

$conn = new mysqli($host, $user, $pass, $db, $port = '3307');

if ($conn->connect_error) {
    die("Koneksi database gagal: " . $conn->connect_error);
}
