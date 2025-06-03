<?php
require 'config/koneksi.php';

// Ambil saldo semua anggota
$query = "SELECT nama, saldo FROM anggota ORDER BY nama ASC";
$result = $conn->query($query);

// Hitung total saldo kas
$query_total = "SELECT SUM(jumlah) AS total FROM kas WHERE jenis='pemasukan'";
$result_total = $conn->query($query_total);
$total = $result_total->fetch_assoc()['total'] ?? 0;
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Saldo</title>
</head>

<body>
    <h2>Laporan Saldo Kas Anggota</h2>

    <table border="1" cellpadding="10">
        <tr>
            <th>No</th>
            <th>Nama Anggota</th>
            <th>Saldo (Rp)</th>
        </tr>

        <?php
        $no = 1;
        while ($row = $result->fetch_assoc()) :
        ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= htmlspecialchars($row['nama']) ?></td>
                <td>Rp <?= number_format($row['saldo'], 0, ',', '.') ?></td>
            </tr>
        <?php endwhile; ?>
    </table>

    <h3>Total Saldo Kas: Rp <?= number_format($total, 0, ',', '.') ?></h3>

    <br>
    <button onclick="window.print()">Cetak Laporan</button>
</body>

</html>