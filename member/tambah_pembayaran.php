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
        echo "Semua data harus diisi!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Input Pembayaran Kas</title>
</head>

<body>
    <h2>Input Pembayaran Kas</h2>

    <form method="post" action="">
        <label>Nama Anggota:</label><br>
        <select name="id_anggota" required>
            <option value="">--Pilih Anggota--</option>
            <?php while ($row = $anggota->fetch_assoc()) : ?>
                <option value="<?= $row['id'] ?>"><?= htmlspecialchars($row['nama']) ?></option>
            <?php endwhile; ?>
        </select><br><br>

        <label>Jumlah Bayar (Rp):</label><br>
        <input type="number" name="jumlah" value="<?= $jumlah_tarif ?>" required><br><br>

        <button type="submit" name="submit">Simpan Pembayaran</button>
    </form>

    <br>
    <a href="data_pembayaran.php">Lihat Data Pembayaran</a>
</body>

</html>