<?php
session_start();

$users = [
    "customer" => ["password" => "customer", "level" => 1],
    "staff"    => ["password" => "admin1234", "level" => 2],
];

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

if ($username === '' || $password === '') {
    echo "<script>alert('Username dan Password wajib diisi!'); window.history.back();</script>";
    exit;
}

if (isset($users[$username]) && $users[$username]['password'] === $password) {
    $_SESSION['username'] = $username;
    $_SESSION['level'] = $users[$username]['level'];
    $level = $_SESSION['level'];

    if ($level == 1) {
        header('Location: ../dashboard/dashboard.php');
        exit;
    } elseif ($level == 2) {
        header('Location: ../menu/index.html');
        exit;
    } else {
        echo "<script>alert('Level tidak dikenali!'); window.history.back();</script>";
        exit;
    }
} else {
    echo "<script>alert('Username atau Password salah!'); window.history.back();</script>";
    exit;
}
?>
