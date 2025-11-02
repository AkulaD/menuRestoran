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

// Ambil status saat ini
$query = "SELECT Tersedia FROM Menu WHERE MenuID = $id";
$result = $conn->query($query);
if ($result && $row = $result->fetch_assoc()) {
    $status_baru = $row['Tersedia'] ? 0 : 1;
    $query_update = "UPDATE Menu SET Tersedia = $status_baru WHERE MenuID = $id";
    if ($conn->query($query_update)) {
        $pesan = $status_baru ? "Menu tersedia kembali." : "Menu diubah menjadi tidak tersedia.";
        echo "<script>alert('$pesan'); window.location.href='../dashboard/menu.php';</script>";
        exit;
    } else {
        echo "<script>alert('Gagal mengubah status.'); window.location.href='../dashboard/menu.php';</script>";
        exit;
    }
} else {
    echo "<script>alert('Menu tidak ditemukan.'); window.location.href='../dashboard/menu.php';</script>";
    exit;
}
?>
