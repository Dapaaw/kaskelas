<?php
require 'config/koneksi.php';

if (!isset($_GET['id'])) {
    header("Location: data_anggota.php");
    exit;
}

$id = $_GET['id'];

if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];

    if (!empty($nama)) {
        $query = "UPDATE anggota SET nama='$nama' WHERE id=$id";
        if ($conn->query($query)) {
            header("Location: data_anggota.php?status=sukses");
            exit;
        } else {
            echo "Gagal mengedit data anggota.";
        }
    } else {
        echo "Nama tidak boleh kosong!";
    }
}

// Ambil data anggota lama
$result = $conn->query("SELECT * FROM anggota WHERE id=$id");
$data = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Edit Anggota</title>
</head>

<body>
    <h2>Edit Anggota</h2>
    <form method="post" action="">
        <label>Nama Anggota:</label><br>
        <input type="text" name="nama" value="<?= htmlspecialchars($data['nama']) ?>" required><br><br>
        <button type="submit" name="submit">Update</button>
    </form>
    <br>
    <a href="data_anggota.php">Kembali ke Data Anggota</a>
</body>

</html>