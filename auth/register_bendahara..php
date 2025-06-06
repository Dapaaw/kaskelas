<?php
require '../config/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Hash password
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    // Insert ke database
    $sql = "INSERT INTO anggota (nama, username, password, role) VALUES (?, ?, ?, 'bendahara')";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $nama, $username, $passwordHash);

    if ($stmt->execute()) {
        echo "Registrasi bendahara berhasil!";
    } else {
        echo "Registrasi gagal: " . $stmt->error;
    }
}
?>

<!-- Form untuk registrasi -->
<form method="POST">
    Nama: <input type="text" name="nama" required><br>
    Username: <input type="text" name="username" required><br>
    Password: <input type="password" name="password" required><br>
    <button type="submit">Register</button>
</form>