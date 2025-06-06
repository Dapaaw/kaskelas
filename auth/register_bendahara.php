<?php
require '../config/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO anggota (nama, username, password, role) VALUES (?, ?, ?, 'bendahara')";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $nama, $username, $passwordHash);

    if ($stmt->execute()) {
        $success = "Registrasi bendahara berhasil!";
    } else {
        $error = "Registrasi gagal: " . $stmt->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Registrasi Bendahara</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>

<body class="form-page">
    <div class="form-container">
        <h2 class="form-title">Registrasi Bendahara</h2>

        <?php if (isset($success)) : ?>
            <div class="status-success"><?= $success ?></div>
        <?php endif; ?>

        <?php if (isset($error)) : ?>
            <div class="status-error"><?= $error ?></div>
        <?php endif; ?>

        <form method="POST" class="payment-form">
            <div class="form-group">
                <label class="form-label">Nama</label>
                <input type="text" name="nama" class="form-control" required>
            </div>

            <div class="form-group">
                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-control" required>
            </div>

            <div class="form-group">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-primary">Register</button>
            </div>
        </form>
    </div>
</body>

</html>