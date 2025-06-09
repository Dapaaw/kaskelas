<?php
require '../config/koneksi.php';

$sql_pemasukan = "SELECT SUM(jumlah) AS total_pemasukan FROM kas WHERE jenis = 'pemasukan'";
$result_pemasukan = $conn->query($sql_pemasukan);
$row_pemasukan = $result_pemasukan->fetch_assoc();
$total_pemasukan = $row_pemasukan['total_pemasukan'] ?? 0;

$sql_pengeluaran = "SELECT SUM(jumlah) AS total_pengeluaran FROM kas WHERE jenis = 'pengeluaran'";
$result_pengeluaran = $conn->query($sql_pengeluaran);
$row_pengeluaran = $result_pengeluaran->fetch_assoc();
$total_pengeluaran = $row_pengeluaran['total_pengeluaran'] ?? 0;

$saldo = $total_pemasukan - $total_pengeluaran;

$tanggal_cetak = date('d-m-Y');

session_start();
$nama_bendahara = isset($_SESSION['user']['nama']) ? $_SESSION['user']['nama'] : 'Bendahara';
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Laporan Saldo Kas</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/style.css">
</head>

<body>
    <div class="print-document">
        <div class="print-header">
            <h2>Laporan Saldo Kas Kelas</h2>
            <p>Tanggal Cetak: <?= $tanggal_cetak ?></p>
        </div>

        <table class="print-table">
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

        <div class="print-signature">
            <p>Mengetahui,</p>
            <p style="margin-top: 80px;"><u><?= htmlspecialchars($nama_bendahara) ?></u><br>Bendahara Kelas</p>
        </div>

        <div class="print-button-container noprint">
            <button onclick="window.print()" class="print-btn">Cetak</button>
        </div>
    </div>
</body>

</html>