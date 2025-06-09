<?php
session_start();
require '../config/koneksi.php';

if (isset($_SESSION['user'])) {
    header("Location: ../admin/dashboard.php"); 
    exit;
}

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
        header("Location: ../admin/dashboard.php"); 
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Bendahara</title>
    <link rel="stylesheet" href="../assets/style.css">
    <script src="https://unpkg.com/feather-icons"></script>
</head>

<body>
    <div class="login-container">
        <h2 class="login-title">Login Bendahara</h2>

        <?php if (isset($_GET['message']) && $_GET['message'] == 'logout'): ?>
            <div class="message">Anda telah berhasil logout.</div>
        <?php endif; ?>

        <?php if (isset($error)): ?>
            <div class="error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form class="login-form" method="POST" action="">
            <div class="input-group">
                <i class="input-icon" data-feather="user"></i>
                <input type="text" name="username" placeholder="Username" class="form-input" required>
            </div>

            <div class="input-group">
                <i class="input-icon" data-feather="lock"></i>
                <input type="password" name="password" placeholder="Password" class="form-input" required>
            </div>

            <button type="submit" name="login" class="login-button">Login</button>
        </form>
    </div>

    <script>
        feather.replace();
    </script>
</body>

</html>