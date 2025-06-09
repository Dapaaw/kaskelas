<?php
session_start();
require '../config/koneksi.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'bendahara') {
    header("Location: ../auth/login.php");
    exit;
}

$success_message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tanggal = $_POST['tanggal'];
    $jenis = $_POST['jenis'];
    $keterangan = $_POST['keterangan'];
    $jumlah = $_POST['jumlah'];
    $id_anggota = $_SESSION['user']['id'];

    $sql = "INSERT INTO kas (tanggal, jenis, keterangan, jumlah, id_anggota) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssii", $tanggal, $jenis, $keterangan, $jumlah, $id_anggota);

    if ($stmt->execute()) {
        $success_message = "Transaksi berhasil ditambahkan.";
    } else {
        $success_message = "Gagal menambahkan transaksi: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Transaksi</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/style.css">
</head>

<body>
    <div class="transaction-form-container">
        <h2 class="transaction-form-title">Tambah Transaksi</h2>

        <?php if (!empty($success_message)): ?>
            <div class="form-success-message"><?= $success_message ?></div>
        <?php endif; ?>

        <form method="POST" class="transaction-inline-form">
            <div class="transaction-inline-group">
                <label class="transaction-form-label">Tanggal:</label>
                <input type="date" name="tanggal" class="transaction-form-input" required>
            </div>

            <div class="transaction-inline-group">
                <label class="transaction-form-label">Jenis:</label>
                <select name="jenis" class="transaction-form-select" required>
                    <option value="pemasukan">Pemasukan</option>
                    <option value="pengeluaran">Pengeluaran</option>
                </select>
            </div>

            <div class="transaction-form-group">
                <label class="transaction-form-label">Keterangan:</label>
                <textarea name="keterangan" class="transaction-form-textarea" required></textarea>
            </div>

            <div class="transaction-inline-group">
                <label class="transaction-form-label">Jumlah:</label>
                <input type="number" name="jumlah" class="transaction-form-input" required>
            </div>

            <button type="submit" class="transaction-submit-btn">Simpan</button>
        </form>
    </div>
</body>

</html>