<?php
session_start();
require 'config/koneksi.php';

// Cek apakah user sudah login dan role bendahara
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'bendahara') {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Dashboard Bendahara Kas Kelas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }

        h2 {
            color: #333;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            margin-bottom: 10px;
        }

        a {
            text-decoration: none;
            color: #0056b3;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }

        .logout {
            margin-top: 20px;
            display: inline-block;
            padding: 8px 16px;
            background-color: #dc3545;
            color: white;
            border-radius: 5px;
            text-decoration: none;
        }

        .logout:hover {
            background-color: #c82333;
        }
    </style>
</head>

<body>

    <h2>Dashboard Bendahara</h2>
    <p>Selamat datang, <strong><?= htmlspecialchars($_SESSION['user']['nama']) ?></strong>!</p>

    <ul>
        <li><a href="tambah_anggota.php">➕ Tambah Anggota</a></li>
        <li><a href="data_anggota.php">👥 Lihat Data Anggota</a></li>
        <li><a href="tambah_pembayaran.php">💵 Input Pembayaran Kas Anggota</a></li>
        <li><a href="data_pembayaran.php">📋 Riwayat Pembayaran Kas</a></li>
        <li><a href="tambah_transaksi.php">📂 Input Transaksi Umum (Masuk/Keluar)</a></li>
        <li><a href="riwayat.php">📑 Riwayat Semua Transaksi Kas</a></li>
        <li><a href="laporan_saldo.php">💰 Laporan Saldo Kas</a></li>
        <li><a href="belum_bayar.php">❗ Daftar Anggota Belum Bayar</a></li>
        <li><a href="cetak_laporan_saldo.php" target="_blank">🖨️ Cetak Laporan Saldo (PDF Print)</a></li>
        <li><a href="pengaturan.php">Pengaturan Tarif Kas</a></li>
    </ul>

    <a href="logout.php" class="logout">Logout</a>

</body>

</html>