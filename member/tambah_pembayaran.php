<?php
session_start();
require '../config/koneksi.php';

// Ambil daftar anggota
$anggota = $conn->query("SELECT * FROM anggota ORDER BY nama ASC");

// Ambil tarif kas
$tarif = $conn->query("SELECT * FROM pengaturan LIMIT 1")->fetch_assoc();
$jumlah_tarif = $tarif ? $tarif['jumlah_tarif'] : 0;

// Proses form pembayaran
if (isset($_POST['submit'])) {
    $id_anggota = $_POST['id_anggota'];
    $jumlah = $_POST['jumlah'];
    $tanggal = date('Y-m-d');

    if (!empty($id_anggota) && !empty($jumlah)) {
        // Insert ke kas
        $conn->query("INSERT INTO kas (tanggal, jenis, keterangan, jumlah, id_anggota) VALUES ('$tanggal', 'pemasukan', 'Pembayaran kas', '$jumlah', '$id_anggota')");
        // Update saldo anggota
        $conn->query("UPDATE anggota SET saldo = saldo + $jumlah WHERE id = $id_anggota");

        header("Location: data_pembayaran.php?status=sukses");
        exit;
    } else {
        echo "<div class='form-success-message'>Semua data harus diisi!</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Pembayaran Kas</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/style.css">
</head>

<body>
    <div class="payment-form-container">
        <h2 class="payment-form-title">Input Pembayaran Kas</h2>

        <form method="post" action="" class="payment-form">
            <div class="payment-form-group">
                <label class="payment-form-label">Nama Anggota:</label>
                <select name="id_anggota" class="payment-form-select" required>
                    <option value="">--Pilih Anggota--</option>
                    <?php while ($row = $anggota->fetch_assoc()) : ?>
                        <option value="<?= $row['id'] ?>"><?= htmlspecialchars($row['nama']) ?></option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="payment-form-group">
                <label class="payment-form-label">Jumlah Bayar (Rp):</label>
                <input type="number" name="jumlah" class="payment-form-input" value="<?= $jumlah_tarif ?>" required>
            </div>

            <button type="submit" name="submit" class="payment-submit-btn">Simpan Pembayaran</button>
        </form>

        <a href="data_pembayaran.php" class="payment-nav-link">Lihat Data Pembayaran</a>
    </div>
</body>

</html>