<?php
require 'config/koneksi.php';

$sql = "SELECT kas.*, anggota.nama FROM kas LEFT JOIN anggota ON kas.id_anggota = anggota.id ORDER BY kas.tanggal DESC";
$result = $conn->query($sql);
?>

<h2>Riwayat Kas Kelas</h2>
<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th>Tanggal</th>
        <th>Jenis</th>
        <th>Keterangan</th>
        <th>Jumlah</th>
        <th>Oleh</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= htmlspecialchars($row['tanggal']) ?></td>
            <td><?= htmlspecialchars($row['jenis']) ?></td>
            <td><?= htmlspecialchars($row['keterangan']) ?></td>
            <td><?= number_format($row['jumlah']) ?></td>
            <td><?= htmlspecialchars($row['nama']) ?></td>
        </tr>
    <?php endwhile; ?>
</table>