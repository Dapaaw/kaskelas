<?php
require '../config/koneksi.php';

// Ambil semua pembayaran
$query = "SELECT kas.*, anggota.nama 
          FROM kas 
          LEFT JOIN anggota ON kas.id_anggota = anggota.id 
          WHERE kas.jenis = 'pemasukan'
          ORDER BY kas.tanggal DESC";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Data Pembayaran Kas</title>
</head>

<body>
    <h2>Riwayat Pembayaran Kas</h2>

    <?php if (isset($_GET['status']) && $_GET['status'] == 'sukses') : ?>
        <p style="color:green;">Pembayaran berhasil disimpan!</p>
    <?php endif; ?>

    <a href="tambah_pembayaran.php">+ Tambah Pembayaran</a><br><br>

    <table border="1" cellpadding="10">
        <tr>
            <th>No</th>
            <th>Nama Anggota</th>
            <th>Tanggal</th>
            <th>Jumlah</th>
            <th>Keterangan</th>
        </tr>

        <?php
        $no = 1;
        while ($row = $result->fetch_assoc()) :
        ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= htmlspecialchars($row['nama']) ?></td>
                <td><?= date('d-m-Y', strtotime($row['tanggal'])) ?></td>
                <td>Rp <?= number_format($row['jumlah'], 0, ',', '.') ?></td>
                <td><?= htmlspecialchars($row['keterangan']) ?></td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>

</html>