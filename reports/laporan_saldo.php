<?php
require '../config/koneksi.php';

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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Saldo - Kas Kelas</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>

<body>
    <div class="report-container">
        <h2 class="report-title">Laporan Saldo Kas Anggota</h2>

        <table class="report-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Anggota</th>
                    <th>Saldo (Rp)</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                while ($row = $result->fetch_assoc()) :
                    $saldoClass = '';
                    if ($row['saldo'] > 0) {
                        $saldoClass = 'saldo-positive';
                    } elseif ($row['saldo'] == 0) {
                        $saldoClass = 'saldo-zero';
                    } else {
                        $saldoClass = 'saldo-negative';
                    }
                ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= htmlspecialchars($row['nama']) ?></td>
                        <td class="<?= $saldoClass ?>">Rp <?= number_format($row['saldo'], 0, ',', '.') ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <div class="total-summary">
            <h3>Total Saldo Kas: Rp <?= number_format($total, 0, ',', '.') ?></h3>
        </div>

        <div class="report-actions">
            <button class="print-button" onclick="window.print()">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="6,9 6,2 18,2 18,9"></polyline>
                    <path d="M6,18H4a2,2 0 0,1-2-2V11a2,2 0 0,1,2-2H20a2,2 0 0,1,2,2v5a2,2 0 0,1-2,2H18"></path>
                    <rect x="6" y="14" width="12" height="8"></rect>
                </svg>
                Cetak Laporan
            </button>
            <a href="../member/dashboard.php" class="back-button">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M19 12H5M12 19l-7-7 7-7"></path>
                </svg>
                Kembali ke Dashboard
            </a>
        </div>
    </div>
</body>

</html>