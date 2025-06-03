<?php
session_start();
require 'config/koneksi.php';

// Jika sudah login, langsung redirect ke dashboard
if (isset($_SESSION['user'])) {
    header("Location: dashboard.php"); // Ubah ke halaman dashboard kamu
    exit;
}

// Proses login
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM anggota WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user'] = $user;
        header("Location: dashboard.php"); // Ganti ke halaman dashboard setelah login
        exit;
    } else {
        $error = "Username atau Password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Login Bendahara</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 50px;
            text-align: center;
        }

        .login-form {
            display: inline-block;
            margin-top: 20px;
            padding: 30px;
            border: 1px solid #ddd;
            border-radius: 10px;
        }

        input[type="text"],
        input[type="password"] {
            padding: 10px;
            width: 200px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        button {
            padding: 10px 30px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
        }

        .message {
            margin-bottom: 15px;
            color: green;
        }

        .error {
            margin-bottom: 15px;
            color: red;
        }
    </style>
</head>

<body>

    <h2>Login Bendahara</h2>

    <?php if (isset($_GET['message']) && $_GET['message'] == 'logout'): ?>
        <div class="message">Anda telah berhasil logout.</div>
    <?php endif; ?>

    <?php if (isset($error)): ?>
        <div class="error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form class="login-form" method="POST" action="">
        <input type="text" name="username" placeholder="Username" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <button type="submit" name="login">Login</button>
    </form>

</body>

</html>