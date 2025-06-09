<?php
session_start();
require '../config/koneksi.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'bendahara') {
    header("Location: ../auth/login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Bendahara Kas Kelas</title>
    <link rel="stylesheet" href="../assets/style.css">
    <script src="https://unpkg.com/feather-icons"></script>
</head>

<body>
    <div class="container">
        <h2>Dashboard Bendahara</h2>
        <p class="welcome-text">Selamat datang, <strong><?= htmlspecialchars($_SESSION['user']['nama']) ?></strong>!</p>

        <div class="menu-grid">
            <div class="menu-item">
                <a href="input_anggota.php">
                    <div class="menu-icon">
                        <i data-feather="user-plus"></i>
                    </div>
                    Tambah Anggota
                </a>
            </div>

            <div class="menu-item">
                <a href="data_anggota.php">
                    <div class="menu-icon">
                        <i data-feather="users"></i>
                    </div>
                    Lihat Data Anggota
                </a>
            </div>

            <div class="menu-item">
                <a href="../member/tambah_pembayaran.php">
                    <div class="menu-icon">
                        <i data-feather="dollar-sign"></i>
                    </div>
                    Input Pembayaran Kas Anggota
                </a>
            </div>

            <div class="menu-item">
                <a href="../member/data_pembayaran.php">
                    <div class="menu-icon">
                        <i data-feather="list"></i>
                    </div>
                    Riwayat Pembayaran Kas
                </a>
            </div>

            <div class="menu-item">
                <a href="../member/tambah_transaksi.php">
                    <div class="menu-icon">
                        <i data-feather="folder-plus"></i>
                    </div>
                    Input Transaksi Umum (Masuk/Keluar)
                </a>
            </div>

            <div class="menu-item">
                <a href="../member/riwayat.php">
                    <div class="menu-icon">
                        <i data-feather="file-text"></i>
                    </div>
                    Riwayat Semua Transaksi Kas
                </a>
            </div>

            <div class="menu-item">
                <a href="../reports/laporan_saldo.php">
                    <div class="menu-icon">
                        <i data-feather="trending-up"></i>
                    </div>
                    Laporan Saldo Kas
                </a>
            </div>

            <div class="menu-item">
                <a href="../payment/belum_bayar.php">
                    <div class="menu-icon">
                        <i data-feather="alert-circle"></i>
                    </div>
                    Daftar Anggota Belum Bayar
                </a>
            </div>

            <div class="menu-item">
                <a href="../reports/cetak_laporan_saldo.php" target="_blank">
                    <div class="menu-icon">
                        <i data-feather="printer"></i>
                    </div>
                    Cetak Laporan Saldo (PDF Print)
                </a>
            </div>

            <div class="menu-item">
                <a href="../admin/pengaturan.php">
                    <div class="menu-icon">
                        <i data-feather="settings"></i>
                    </div>
                    Pengaturan Tarif Kas
                </a>
            </div>
        </div>

        <div class="logout-section">
            <a href="../auth/logout.php" class="logout">
                <i data-feather="log-out"></i>
                Logout
            </a>
        </div>
    </div>

    <script>
        feather.replace();
    </script>
</body>

</html>