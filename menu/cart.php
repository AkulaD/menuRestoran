<?php
include '../php/config.php';
session_start();

if (!isset($_SESSION['username'])) {
    header('location: ../index.html');
    exit;
}

if (!isset($_SESSION['cart']) || count($_SESSION['cart']) === 0) {
    echo "<p>Keranjang masih kosong. <a href='index.php'>Kembali ke Menu</a></p>";
    exit;
}

$total_harga = 0;
$menu_ids = implode(',', array_keys($_SESSION['cart']));
$query = "SELECT * FROM Menu WHERE MenuID IN ($menu_ids)";
$result = $conn->query($query);
$menu_data = [];

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $menu_data[$row['MenuID']] = $row;
    }
}

foreach ($_SESSION['cart'] as $id => $item) {
    $harga = $menu_data[$id]['Harga'] * $item['jumlah'];
    $total_harga += $harga;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nama'])) {
    $nama = $conn->real_escape_string($_POST['nama']);
    $nomer_bangku = $conn->real_escape_string($_POST['nomer_bangku']);
    $catatan = $conn->real_escape_string($_POST['catatan']);
    $total = $total_harga;

    $sql = "INSERT INTO Pemesanan (PelangganNama, NomerBangku, TotalHarga, Catatan)
            VALUES ('$nama', '$nomer_bangku', '$total', '$catatan')";
    if ($conn->query($sql)) {
        unset($_SESSION['cart']);
        echo "<script>alert('Pesanan berhasil dibuat!'); window.location='index.php';</script>";
        exit;
    } else {
        echo "<script>alert('Gagal menyimpan pesanan.');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang - Restoran</title>
    <link rel="stylesheet" href="../data/css/menu.css">
    <script src="../data/js/script.js" defer></script>
</head>
<body>
    <h1>Keranjang Anda</h1>
    <section>
        <?php foreach ($_SESSION['cart'] as $id => $item): ?>
            <?php $menu = $menu_data[$id]; ?>
            <div style="border:1px solid #ccc; padding:10px; margin:10px;">
                <h2><?php echo htmlspecialchars($menu['Nama']); ?></h2>
                <p>Jumlah: <?php echo $item['jumlah']; ?></p>
                <p>Harga per item: Rp<?php echo number_format($menu['Harga'], 0, ',', '.'); ?></p>
                <p>Total: Rp<?php echo number_format($menu['Harga'] * $item['jumlah'], 0, ',', '.'); ?></p>
            </div>
        <?php endforeach; ?>
    </section>

    <h3>Total Harga Keseluruhan: Rp<?php echo number_format($total_harga, 0, ',', '.'); ?></h3>

    <form method="POST">
        <label>Nama Pelanggan:</label><br>
        <input type="text" name="nama" required><br><br>

        <label>Tipe Pesanan:</label><br>
        <select name="tipe-pesanan" id="tipe-pesanan" required>
            <option value="">-- Pilih --</option>
            <option value="Dine In">Dine In</option>
            <option value="Take Away">Take Away</option>
        </select><br><br>

        <div id="nomor-bangku-container" style="display:none;">
            <label>Nomor Bangku:</label><br>
            <input type="number" name="nomor-bangku" min="1" placeholder="Masukkan nomor bangku">
            <br><br>
        </div>


        <label>Catatan:</label><br>
        <textarea name="catatan"></textarea><br><br>

        <button type="submit">Selesaikan Pesanan</button>
    </form>

    <footer>
        <a href="index.php">Kembali ke Menu</a>
    </footer>
</body>
</html>
