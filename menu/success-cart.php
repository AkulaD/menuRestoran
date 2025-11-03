<?php
session_start();
include '../php/config.php';
if(!isset($_SESSION['username'])) {
    header('location: ../index.html');
    exit;
}

$query = "SELECT kodeBayar, PelangganNama, TotalHarga FROM Pemesanan ORDER BY PemesananID DESC LIMIT 1";
$result = $conn->query($query);

if ($result && $result->num_rows > 0) {
    $data = $result->fetch_assoc();
    $kodeBayar = $data['kodeBayar'];
    $nama = $data['PelangganNama'];
    $total = $data['TotalHarga'];
} else {
    echo "<script>alert('Data pesanan tidak ditemukan.'); window.location='index.php';</script>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Berhasil</title>
</head>
<body>
    <h1>Pesanan Berhasil Dibuat!</h1>
    <p>Kode Bayar: <?php echo $kodeBayar; ?></p>
    <p>Nama Pelanggan: <?php echo htmlspecialchars($nama); ?></p>
    <p>Total Bayar: Rp<?php echo number_format($total, 0, ',', '.'); ?></p>
    <p>Silahkan bayar di kasir untuk memproses pesanan Anda.</p>
    <a href="index.php">Kembali ke Menu</a>
</body>
</html>
