<?php
session_start();
require '../config/koneksi.php';

// Cek apakah user login sebagai bendahara
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'bendahara') {
    header("Location: ../auth/login.php");
    exit;
}

// Ambil tarif sekarang
$tarif = $conn->query("SELECT * FROM pengaturan LIMIT 1")->fetch_assoc();

// Proses update tarif
if (isset($_POST['submit'])) {
    $jumlah_tarif = intval($_POST['jumlah_tarif']);
    if ($tarif) {
        // Update tarif
        $conn->query("UPDATE pengaturan SET jumlah_tarif = $jumlah_tarif WHERE id = {$tarif['id']}");
    } else {
        // Insert jika belum ada
        $conn->query("INSERT INTO pengaturan (nama_tarif, jumlah_tarif) VALUES ('Tarif Kas Bulanan', $jumlah_tarif)");
    }
    header("Location: pengaturan.php?status=berhasil");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Pengaturan Tarif Kas</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>

<body>
    <div class="form-container">
        <h2 class="form-title">Pengaturan Tarif Kas Bulanan</h2>

        <?php if (isset($_GET['status']) && $_GET['status'] == 'berhasil') : ?>
            <div class="success-message">Tarif berhasil diperbarui!</div>
        <?php endif; ?>

        <div class="settings-info">
            <p>Atur jumlah tarif kas bulanan yang akan dikenakan kepada setiap anggota</p>
        </div>

        <form method="post" action="">
            <div class="form-group">
                <label class="form-label">Jumlah Tarif:</label>
                <div class="currency-input">
                    <input type="number" name="jumlah_tarif" class="form-control" value="<?= htmlspecialchars($tarif['jumlah_tarif']) ?>" required>
                </div>
            </div>
            <div class="form-actions">
                <button type="submit" name="submit" class="btn-primary">Simpan Perubahan</button>
                <a href="dashboard.php" class="btn-secondary">Kembali ke Dashboard</a>
            </div>
        </form>
    </div>
</body>

</html>