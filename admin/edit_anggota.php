<?php
require '../config/koneksi.php';

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

$result = $conn->query("SELECT * FROM anggota WHERE id=$id");
$data = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Edit Anggota</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>

<body>
    <div class="form-container">
        <h2 class="form-title">Edit Anggota</h2>
        <form method="post" action="">
            <div class="form-group">
                <label class="form-label">Nama Anggota:</label>
                <input type="text" name="nama" class="form-control" value="<?= htmlspecialchars($data['nama']) ?>" required>
            </div>
            <div class="form-actions">
                <button type="submit" name="submit" class="btn-primary">Update</button>
                <a href="data_anggota.php" class="btn-secondary">Kembali ke Data Anggota</a>
            </div>
        </form>
    </div>
</body>

</html>