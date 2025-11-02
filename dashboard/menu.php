<?php 
include '../php/config.php';

session_start();
if (!isset($_SESSION['username'])) {
    header('location: ../index.html');
    exit;
}
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
    <!-- Main -->
     <main>
        <section class="menu-container">
            <ul>
                <li>
                    <h1>List Menu</h1>
                </li>
                <li>
                    <a href="input-menu.html">Add Menu Item</a>
                </li>
            </ul>            
            <div class="menu-list">
                <!-- Menu items will be dynamically inserted here -->
                 <div class="menu-content">
                    <img src="data/img/menu-img/gambar1.jpg" alt="gambar1">
                    <div class="menu-desc">
                        <h2>Menu 1</h2>
                        <p>Descripsi : Menu 1 adalah hidangan lezat yang terbuat dari bahan-bahan segar.</p>
                        <p>tersedia</p>
                        <p>Harga: $10.00</p>
                        <p>waktu tambah: 12:00 PM</p>
                        <p>status: tersedia</p>
                        <p>aksi: <a href="edit-order.html">Edit</a> | <a href="delete-order.html">Hapus</a></p>
                    </div>
                </div>
            </div>
        </section>
        
     </main>
    <footer>
        <p>Version: <?php echo $version_info; ?></p>
    </footer>
</body>
</html>