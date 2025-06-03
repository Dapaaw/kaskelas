<?php
require 'config/koneksi.php';

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
</head>

<body>
    <h2>Tambah Anggota Baru</h2>
    <form method="post" action="">
        <label>Nama Anggota:</label><br>
        <input type="text" name="nama" required><br><br>
        <button type="submit" name="submit">Tambah</button>
    </form>
    <br>
    <a href="data_anggota.php">Kembali ke Data Anggota</a>
</body>

</html>