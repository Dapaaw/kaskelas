<?php
require '../config/koneksi.php';

// Hitung total pemasukan
$sql_pemasukan = "SELECT SUM(jumlah) AS total_pemasukan FROM kas WHERE jenis = 'pemasukan'";
$result_pemasukan = $conn->query($sql_pemasukan);
$row_pemasukan = $result_pemasukan->fetch_assoc();
$total_pemasukan = $row_pemasukan['total_pemasukan'] ?? 0;

// Hitung total pengeluaran
$sql_pengeluaran = "SELECT SUM(jumlah) AS total_pengeluaran FROM kas WHERE jenis = 'pengeluaran'";
$result_pengeluaran = $conn->query($sql_pengeluaran);
$row_pengeluaran = $result_pengeluaran->fetch_assoc();
$total_pengeluaran = $row_pengeluaran['total_pengeluaran'] ?? 0;

// Hitung saldo akhir
$saldo = $total_pemasukan - $total_pengeluaran;

// Tanggal hari ini
$tanggal_cetak = date('d-m-Y');

// Nama bendahara dari session login
session_start();
$nama_bendahara = isset($_SESSION['user']['nama']) ? $_SESSION['user']['nama'] : 'Bendahara';
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Cetak Laporan Saldo Kas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 30px;
            text-align: center;
        }

        .header {
            margin-bottom: 30px;
        }

        table {
            width: 50%;
            margin: auto;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table,
        th,
        td {
            border: 1px solid #333;
        }

        th,
        td {
            padding: 10px;
            font-size: 16px;
        }

        .ttd {
            margin-top: 50px;
            text-align: right;
            margin-right: 100px;
        }

        @media print {
            .noprint {
                display: none;
            }
        }
    </style>
</head>

<body>

    <div class="header">
        <h2>Laporan Saldo Kas Kelas</h2>
        <p>Tanggal Cetak: <?= $tanggal_cetak ?></p>
    </div>

    <table>
        <tr>
            <th>Jenis</th>
            <th>Jumlah (Rp)</th>
        </tr>
        <tr>
            <td>Total Pemasukan</td>
            <td><?= number_format($total_pemasukan, 0, ',', '.') ?></td>
        </tr>
        <tr>
            <td>Total Pengeluaran</td>
            <td><?= number_format($total_pengeluaran, 0, ',', '.') ?></td>
        </tr>
        <tr>
            <th>Saldo Akhir</th>
            <th><?= number_format($saldo, 0, ',', '.') ?></th>
        </tr>
    </table>

    <div class="ttd">
        <p>Mengetahui,</p>
        <p style="margin-top: 80px;"><u><?= htmlspecialchars($nama_bendahara) ?></u><br>Bendahara Kelas</p>
    </div>

    <div class="noprint" style="margin-top: 30px;">
        <button onclick="window.print()">Cetak</button>
    </div>

</body>

</html>