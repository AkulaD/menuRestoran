<?php 
include '../php/config.php';
session_start();
if (!isset($_SESSION['username'])) {
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
    <title>Menu</title>
</head>
<body>
    <nav>
        <section class="container-nav">
            <div class="left-nav">
                <ul>
                    <li><a href="dashboard.php">Home</a></li>
                    <li><a href="order.php">Order</a></li>
                    <li><a href="menu.php">Menu</a></li>
                    <li><a href="History.php">History</a></li>
                </ul>
            </div>
            <div class="right-nav">
                <ul>
                    <li><a href="../php/logout.php">Logout</a></li>
                </ul>
            </div>
        </section>
    </nav>

    <main>
        <section class="menu-container">
            <ul>
                <li><h1>List Menu</h1></li>
                <li><a href="input-menu.php">Add Menu Item</a></li>
            </ul>
            <div class="menu-list">
                <?php if ($result && $result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <div class="menu-content">
                            <img src="../<?php echo htmlspecialchars($row['GambarURL']); ?>" alt="<?php echo htmlspecialchars($row['Nama']); ?>" width="150">
                            <div class="menu-desc">
                                <h2><?php echo htmlspecialchars($row['Nama']); ?></h2>
                                <p>Deskripsi: <?php echo htmlspecialchars($row['Deskripsi']); ?></p>
                                <p>Kategori: <?php echo htmlspecialchars($row['Kategori']); ?></p>
                                <p>Harga: Rp<?php echo number_format($row['Harga'], 0, ',', '.'); ?></p>
                                <p>Waktu Tambah: <?php echo htmlspecialchars($row['WaktuTambah']); ?></p>
                                <p>Status: <?php echo $row['Tersedia'] ? 'Tersedia' : 'Habis'; ?></p>
                                <p>Aksi: 
                                    <a href="edit-menu.php?id=<?php echo $row['MenuID']; ?>">Edit</a> | 
                                    <a href="../php/change-status-menu.php?id=<?php echo $row['MenuID']; ?>">
                                        <?php echo $row['Tersedia'] ? 'Tidak Tersedia' : 'Tersedia'; ?>
                                    </a> | 
                                    <a href="../php/delete-menu.php?id=<?php echo $row['MenuID']; ?>">Hapus</a>
                                </p>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p>Tidak ada menu tersedia.</p>
                <?php endif; ?>
            </div>
        </section>
    </main>

    <footer>
        <p>Version: <?php echo $version_info; ?></p>
    </footer>
</body>
</html>
