<?php
include 'config.php';
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: ../index.html');
    exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['name'] ?? '';
    $deskripsi = $_POST['deskripsi'] ?? '';
    $harga = $_POST['harga'] ?? 0;
    $kategori = $_POST['kategori'] ?? '';
    $gambar = $_FILES['img'] ?? null;
    if ($nama === '' || $harga <= 0 || !$gambar) {
        echo "<script>alert('Isi semua data dengan benar!'); window.history.back();</script>";
        exit;
    }
    $target_dir = "../data/img/menu-img/";
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }
    $sql = "INSERT INTO Menu (Nama, Deskripsi, Harga, Kategori) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssds", $nama, $deskripsi, $harga, $kategori);
    if ($stmt->execute()) {
        $menuID = $stmt->insert_id;
        $ext = pathinfo($gambar['name'], PATHINFO_EXTENSION);
        $newFileName = $menuID . '.' . $ext;
        $target_file = $target_dir . $newFileName;
        if (move_uploaded_file($gambar['tmp_name'], $target_file)) {
            $update = $conn->prepare("UPDATE Menu SET GambarURL = ? WHERE MenuID = ?");
            $pathForDB = "data/img/menu-img/" . $newFileName;
            $update->bind_param("si", $pathForDB, $menuID);
            $update->execute();
            echo "<script>alert('Menu berhasil ditambahkan!'); window.location.href='../dashboard/menu.php';</script>";
            exit;
        } else {
            echo "<script>alert('Gagal mengupload gambar!'); window.history.back();</script>";
            exit;
        }
    } else {
        echo "<script>alert('Gagal menambahkan data ke database!'); window.history.back();</script>";
        exit;
    }
} else {
    header('Location: ../dashboard/input-menu.php');
    exit;
}
?>
