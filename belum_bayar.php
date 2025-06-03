<?php
require 'config/koneksi.php';

// Ambil bulan dan tahun sekarang
$bulan = date('m');
$tahun = date('Y');

// Cari anggota yang belum membayar bulan ini
$query = "
    SELECT a.id, a.nama
    FROM anggota a
    WHERE a.id NOT IN (
        SELECT DISTINCT k.id_anggota
        FROM kas k
        WHERE MONTH(k.tanggal) = '$bulan' AND YEAR(k.tanggal) = '$tahun' AND k.jenis = 'pemasukan'
    )
    ORDER BY a.nama ASC
";

$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Daftar Belum Bayar Bulan Ini</title>
</head>

<body>
    <h2>Daftar Anggota yang Belum Bayar Bulan <?= date('F Y') ?></h2>

    <table border="1" cellpadding="10">
        <tr>
            <th>No</th>
            <th>Nama Anggota</th>
        </tr>

        <?php
        $no = 1;
        while ($row = $result->fetch_assoc()) :
        ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= htmlspecialchars($row['nama']) ?></td>
            </tr>
        <?php endwhile; ?>
    </table>

    <br>
    <a href="data_pembayaran.php">Kembali ke Pembayaran</a>
</body>

</html>