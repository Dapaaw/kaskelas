<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Kas Kelas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 50px;
        }

        h1 {
            margin-bottom: 30px;
        }

        .menu {
            display: inline-block;
            margin: 10px;
        }

        .menu a {
            text-decoration: none;
            background-color: #4CAF50;
            color: white;
            padding: 15px 30px;
            border-radius: 10px;
            display: inline-block;
            font-size: 18px;
            transition: background-color 0.3s;
        }

        .menu a:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>

    <h1>Selamat Datang di Sistem Kas Kelas</h1>

    <div class="menu">
        <a href="riwayat.php">Lihat Riwayat Kas</a>
    </div>
    <div class="menu">
        <a href="laporan_saldo.php">Lihat Saldo Kas</a>
    </div>
    <div class="menu">
        <a href="login.php">Login Bendahara</a>
    </div>

</body>

</html>