<?php
require '../config/koneksi.php';

$bulan = date('m');
$tahun = date('Y');

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
$totalBelumBayar = $result->num_rows;
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Belum Bayar - Kas Kelas</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>

<body>
    <div class="report-container">
        <h2 class="report-title">Daftar Anggota yang Belum Bayar</h2>
        <h3 style="text-align: center; color: #6c757d; margin-bottom: 30px;">
            Bulan <?= date('F Y') ?>
        </h3>

        <?php if ($totalBelumBayar > 0): ?>
            <div class="unpaid-warning">
                <strong>Perhatian!</strong> Ada <?= $totalBelumBayar ?> anggota yang belum melakukan pembayaran bulan ini.
            </div>

            <table class="report-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Anggota</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $result->data_seek(0); 
                    $no = 1;
                    while ($row = $result->fetch_assoc()) :
                    ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= htmlspecialchars($row['nama']) ?></td>
                            <td>
                                <span style="background: linear-gradient(135deg, #f8d7da, #f5c6cb); color: #721c24; padding: 5px 12px; border-radius: 20px; font-size: 0.85rem; font-weight: 500;">
                                    Belum Bayar
                                </span>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="no-data-message">
                <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin-bottom: 15px; color: #28a745;">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                    <polyline points="22,4 12,14.01 9,11.01"></polyline>
                </svg>
                <br>
                Semua anggota sudah melakukan pembayaran bulan ini!
            </div>
        <?php endif; ?>

        <div class="report-actions">
            <button class="print-button" onclick="window.print()">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="6,9 6,2 18,2 18,9"></polyline>
                    <path d="M6,18H4a2,2 0 0,1-2-2V11a2,2 0 0,1,2-2H20a2,2 0 0,1,2,2v5a2,2 0 0,1-2,2H18"></path>
                    <rect x="6" y="14" width="12" height="8"></rect>
                </svg>
                Cetak Laporan
            </button>
            <a href="../member/data_pembayaran.php" class="back-button">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M19 12H5M12 19l-7-7 7-7"></path>
                </svg>
                Kembali ke Pembayaran
            </a>
        </div>
    </div>
</body>

</html>