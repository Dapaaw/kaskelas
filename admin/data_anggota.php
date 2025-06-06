<?php
require '../config/koneksi.php';

$query = "SELECT * FROM anggota ORDER BY id ASC";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Data Anggota</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>

<body>
    <div class="container">
        <h2>Daftar Anggota</h2>

        <?php if (isset($_GET['status']) && $_GET['status'] == 'sukses') : ?>
            <div class="status-success">Data berhasil disimpan!</div>
        <?php endif; ?>

        <div class="form-actions">
            <a href="input_anggota.php" class="btn-primary">+ Tambah Anggota Baru</a>
        </div>

        <div class="table-responsive">
            <table class="report-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Anggota</th>
                        <th>Aksi</th>
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
                            <td>
                                <a href="edit_anggota.php?id=<?= $row['id'] ?>" class="btn-secondary">Edit</a>
                                <a href="hapus_anggota.php?id=<?= $row['id'] ?>" class="btn-secondary" onclick="return confirm('Yakin mau hapus?')">Hapus</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>