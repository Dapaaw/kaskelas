<?php
session_start();
require 'config/koneksi.php';

// Cek apakah user login sebagai bendahara
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'bendahara') {
    header("Location: login.php");
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
</head>

<body>
    <h2>Pengaturan Tarif Kas Bulanan</h2>

    <?php if (isset($_GET['status']) && $_GET['status'] == 'berhasil') : ?>
        <p style="color:green;">Tarif berhasil diperbarui!</p>
    <?php endif; ?>

    <form method="post" action="">
        <label>Jumlah Tarif (Rp):</label><br>
        <input type="number" name="jumlah_tarif" value="<?= htmlspecialchars($tarif['jumlah_tarif']) ?>" required><br><br>

        <button type="submit" name="submit">Simpan Perubahan</button>
    </form>

    <br>
    <a href="dashboard.php">Kembali ke Dashboard</a>
</body>

</html>