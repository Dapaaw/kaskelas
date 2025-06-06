<?php
session_start();
require '../config/koneksi.php';

// Cek apakah user sudah login dan role = bendahara
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'bendahara') {
    header("Location: ../auth/login.php");
    exit;
}

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
        echo "Transaksi berhasil ditambahkan.";
    } else {
        echo "Gagal menambahkan transaksi: " . $stmt->error;
    }
}
?>

<h2>Tambah Transaksi</h2>
<form method="POST">
    Tanggal: <input type="date" name="tanggal" required><br>
    Jenis:
    <select name="jenis" required>
        <option value="pemasukan">Pemasukan</option>
        <option value="pengeluaran">Pengeluaran</option>
    </select><br>
    Keterangan: <textarea name="keterangan" required></textarea><br>
    Jumlah: <input type="number" name="jumlah" required><br>
    <button type="submit">Simpan</button>
</form>