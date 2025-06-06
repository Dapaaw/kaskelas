<?php
require '../config/koneksi.php';

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
    <link rel="stylesheet" href="../assets/style.css">
</head>

<body>
    <div class="container">
        <h2>Riwayat Pembayaran Kas</h2>

        <?php if (isset($_GET['status']) && $_GET['status'] == 'sukses') : ?>
            <div class="status-success">Pembayaran berhasil disimpan!</div>
        <?php endif; ?>

        <div class="form-actions">
            <a href="tambah_pembayaran.php" class="btn-primary">+ Tambah Pembayaran</a>
        </div>

        <div class="table-responsive">
            <table class="report-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Anggota</th>
                        <th>Tanggal</th>
                        <th>Jumlah</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
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
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>