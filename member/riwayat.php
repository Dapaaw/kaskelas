<?php
require '../config/koneksi.php';

$sql = "SELECT kas.*, anggota.nama FROM kas LEFT JOIN anggota ON kas.id_anggota = anggota.id ORDER BY kas.tanggal DESC";
$result = $conn->query($sql);

$query_pemasukan = "SELECT SUM(jumlah) AS total FROM kas WHERE jenis='pemasukan'";
$query_pengeluaran = "SELECT SUM(jumlah) AS total FROM kas WHERE jenis='pengeluaran'";

$pemasukan = $conn->query($query_pemasukan)->fetch_assoc()['total'] ?? 0;
$pengeluaran = $conn->query($query_pengeluaran)->fetch_assoc()['total'] ?? 0;
$saldo = $pemasukan - $pengeluaran;
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Kas Kelas</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>

<body>
    <div class="report-container">
        <h2 class="report-title">Riwayat Kas Kelas</h2>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin-bottom: 30px;">
            <div style="background: linear-gradient(135deg, #d4edda, #c3e6cb); border: 2px solid #c3e6cb; border-radius: 12px; padding: 15px; text-align: center;">
                <h4 style="margin: 0; color: #155724;">Total Pemasukan</h4>
                <p style="margin: 5px 0 0 0; font-size: 1.2rem; font-weight: 600; color: #155724;">
                    Rp <?= number_format($pemasukan, 0, ',', '.') ?>
                </p>
            </div>
            <div style="background: linear-gradient(135deg, #f8d7da, #f5c6cb); border: 2px solid #f5c6cb; border-radius: 12px; padding: 15px; text-align: center;">
                <h4 style="margin: 0; color: #721c24;">Total Pengeluaran</h4>
                <p style="margin: 5px 0 0 0; font-size: 1.2rem; font-weight: 600; color: #721c24;">
                    Rp <?= number_format($pengeluaran, 0, ',', '.') ?>
                </p>
            </div>
            <div style="background: linear-gradient(135deg, #e8f4fd, #d1ecf1); border: 2px solid #bee5eb; border-radius: 12px; padding: 15px; text-align: center;">
                <h4 style="margin: 0; color: #0c5460;">Saldo Akhir</h4>
                <p style="margin: 5px 0 0 0; font-size: 1.2rem; font-weight: 600; color: #0c5460;">
                    Rp <?= number_format($saldo, 0, ',', '.') ?>
                </p>
            </div>
        </div>

        <?php if ($result->num_rows > 0): ?>
            <table class="report-table">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Jenis</th>
                        <th>Keterangan</th>
                        <th>Jumlah (Rp)</th>
                        <th>Oleh</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= date('d/m/Y', strtotime($row['tanggal'])) ?></td>
                            <td>
                                <span class="<?= $row['jenis'] == 'pemasukan' ? 'jenis-pemasukan' : 'jenis-pengeluaran' ?>">
                                    <?= ucfirst(htmlspecialchars($row['jenis'])) ?>
                                </span>
                            </td>
                            <td><?= htmlspecialchars($row['keterangan']) ?></td>
                            <td style="<?= $row['jenis'] == 'pemasukan' ? 'color: #28a745; font-weight: 600;' : 'color: #dc3545; font-weight: 600;' ?>">
                                <?= $row['jenis'] == 'pemasukan' ? '+' : '-' ?> <?= number_format($row['jumlah'], 0, ',', '.') ?>
                            </td>
                            <td><?= htmlspecialchars($row['nama'] ?? 'Sistem') ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="no-data-message">
                <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin-bottom: 15px;">
                    <circle cx="12" cy="12" r="10"></circle>
                    <path d="M16 16s-1.5-2-4-2-4 2-4 2"></path>
                    <line x1="9" y1="9" x2="9.01" y2="9"></line>
                    <line x1="15" y1="9" x2="15.01" y2="9"></line>
                </svg>
                <br>
                Belum ada riwayat transaksi kas.
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
            <a href="../index.php" class="back-button">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M19 12H5M12 19l-7-7 7-7"></path>
                </svg>
                Kembali ke Dashboard
            </a>
        </div>
    </div>
</body>
</html>