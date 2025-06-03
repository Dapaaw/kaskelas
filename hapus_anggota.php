<?php
require 'config/koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "DELETE FROM anggota WHERE id=$id";
    if ($conn->query($query)) {
        header("Location: data_anggota.php?status=sukses");
        exit;
    } else {
        echo "Gagal menghapus anggota.";
    }
} else {
    header("Location: data_anggota.php");
}
