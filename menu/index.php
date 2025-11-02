<?php 
include '../php/config.php';
session_start();
if(!isset($_SESSION['username'])) {
    header('location: ../index.html');
    exit;
}
$query = "SELECT * FROM Menu ORDER BY WaktuTambah DESC";
$result = $conn->query($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu - Restoran</title>
</head>
<body>
    <h1>Daftar Menu</h1>

    <main>
        <?php if ($result && $result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <div style="border:1px solid #ccc; padding:10px; margin:10px 0;">
                    <img src="../<?php echo htmlspecialchars($row['GambarURL']); ?>" alt="<?php echo htmlspecialchars($row['Nama']); ?>" width="120">
                    <h2><?php echo htmlspecialchars($row['Nama']); ?></h2>
                    <p>Deskripsi: <?php echo htmlspecialchars($row['Deskripsi']); ?></p>
                    <p>Kategori: <?php echo htmlspecialchars($row['Kategori']); ?></p>
                    <p>Harga: Rp<?php echo number_format($row['Harga'], 0, ',', '.'); ?></p>
                    <p>Status: <?php echo $row['Tersedia'] ? 'Tersedia' : 'Habis'; ?></p>
                    <p>Waktu Tambah: <?php echo htmlspecialchars($row['WaktuTambah']); ?></p>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>Tidak ada menu tersedia.</p>
        <?php endif; ?>
    </main>

    <footer>
        <a href="../php/logout.php">Logout</a>
    </footer>
</body>
</html>
