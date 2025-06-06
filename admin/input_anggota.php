<?php
require '../config/koneksi.php';

if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];

    if (!empty($nama)) {
        $query = "INSERT INTO anggota (nama) VALUES ('$nama')";
        if ($conn->query($query)) {
            header("Location: data_anggota.php?status=sukses");
            exit;
        } else {
            echo "Gagal menambahkan anggota.";
        }
    } else {
        echo "Nama tidak boleh kosong!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Tambah Anggota</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>

<body>
    <div class="form-container">
        <h2 class="form-title">Tambah Anggota Baru</h2>
        <form method="post" action="">
            <div class="form-group">
                <label class="form-label">Nama Anggota:</label>
                <input type="text" name="nama" class="form-control" required>
            </div>
            <div class="form-actions">
                <button type="submit" name="submit" class="btn-primary">Tambah</button>
                <a href="data_anggota.php" class="btn-secondary">Kembali ke Data Anggota</a>
            </div>
        </form>
    </div>
</body>

</html>