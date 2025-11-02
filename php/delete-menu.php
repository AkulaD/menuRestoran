<?php
include 'config.php';
session_start();
if (!isset($_SESSION['username'])) {
    header('location: ../index.html');
    exit;
}

if (!isset($_GET['id'])) {
    echo "ID tidak ditemukan.";
    exit;
}

$id = intval($_GET['id']);
$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $password = $_POST['password'];
    if ($password === "admin1234") {
        $query = "DELETE FROM Menu WHERE MenuID = $id";
        if ($conn->query($query)) {
            echo "<script>alert('Menu berhasil dihapus'); window.location.href='../dashboard/menu.php';</script>";
            exit;
        } else {
            $error = "Gagal menghapus menu.";
        }
    } else {
        $error = "Password salah.";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Hapus Menu</title>
</head>
<body>
    <h2>Konfirmasi Hapus Menu</h2>
    <?php if ($error): ?><p style="color:red;"><?php echo $error; ?></p><?php endif; ?>
    <p>Yakin ingin menghapus menu ini?</p>
    <form method="POST">
        <label>Password Admin:</label><br>
        <input type="password" name="password" required><br><br>
        <button type="submit">Hapus</button>
        <a href="../dashboard/menu.php">Batal</a>
    </form>
</body>
</html>
