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
</head>

<body>
    <h2>Daftar Anggota</h2>

    <?php if (isset($_GET['status']) && $_GET['status'] == 'sukses') : ?>
        <p style="color:green;">Data berhasil disimpan!</p>
    <?php endif; ?>

    <a href="input_anggota.php">+ Tambah Anggota Baru</a>
    <br><br>

    <table border="1" cellpadding="10">
        <tr>
            <th>No</th>
            <th>Nama Anggota</th>
            <th>Aksi</th>
        </tr>

        <?php
        $no = 1;
        while ($row = $result->fetch_assoc()) :
        ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= htmlspecialchars($row['nama']) ?></td>
                <td>
                    <a href="edit_anggota.php?id=<?= $row['id'] ?>">Edit</a> |
                    <a href="hapus_anggota.php?id=<?= $row['id'] ?>" onclick="return confirm('Yakin mau hapus?')">Hapus</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>

</html>