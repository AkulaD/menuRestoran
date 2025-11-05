<?php 
include '../php/config.php';
session_start();
if(!isset($_SESSION['username'])) {
    header('location: ../index.html');
    exit;
}
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}
if (isset($_GET['reset']) && $_GET['reset'] == '1') {
    unset($_SESSION['cart']); 
    header("Location: index.php");
    exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['menu_id'])) {
    $menu_id = $_POST['menu_id'];
    $jumlah = (int)$_POST['jumlah'];
    if ($jumlah > 0) {
        if (!isset($_SESSION['cart'][$menu_id])) {
            $_SESSION['cart'][$menu_id] = ['jumlah' => $jumlah];
        } else {
            $_SESSION['cart'][$menu_id]['jumlah'] += $jumlah;
        }
    }
}
$query = "SELECT * FROM Menu ORDER BY Kategori, WaktuTambah DESC";
$result = $conn->query($query);
$menu_by_category = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $menu_by_category[$row['Kategori']][] = $row;
    }
}
$cart_total = 0;
foreach ($_SESSION['cart'] as $item) {
    $cart_total += $item['jumlah'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu - Restoran</title>
    <link rel="stylesheet" href="../data/css/menu.css">
    <script src="../data/js/script.js" defer></script>
    <link rel="stylesheet" href="../data/css/index.css">
</head>
<body>
    <nav>
        <section class="nav-container">
            <div class="left-nav">
                <ul>
                    <li><a href="#Makanan">Makanan</a></li>
                    <li><a href="#Minuman">Minuman</a></li>
                    <li><a href="#Lainnya">Lainnya</a></li>
                </ul>
            </div>
            <div class="right-nav">
                <ul>
                    <li>
                        <a href="cart.php">
                            <img src="../data/img/cart-icon.png" alt="cart-icon" style="width:24px;height:24px;">
                            <span>(<?php echo $cart_total; ?>)</span>
                        </a>
                    </li>
                    <li><a href="index.php?reset=1">Reset Keranjang</a></li>
                </ul>
            </div>
        </section>
    </nav>
    <main>
        <h1>Daftar Menu</h1>
        <?php if (!empty($menu_by_category)): ?>
            <?php foreach ($menu_by_category as $kategori => $menus): ?>
                <section id="<?php echo htmlspecialchars($kategori); ?>">
                    <h3><?php echo htmlspecialchars($kategori); ?></h3>
                    <?php foreach ($menus as $row): ?>
                        <div style="border:1px solid #ccc; padding:10px; margin:10px 0;">
                            <img src="../<?php echo htmlspecialchars($row['GambarURL']); ?>" alt="<?php echo htmlspecialchars($row['Nama']); ?>" width="120">
                            <h2><?php echo htmlspecialchars($row['Nama']); ?></h2>
                            <p>Deskripsi: <?php echo htmlspecialchars($row['Deskripsi']); ?></p>
                            <p>Harga: Rp<?php echo number_format($row['Harga'], 0, ',', '.'); ?></p>
                            <p>Status: <?php echo $row['Tersedia'] ? 'Tersedia' : 'Habis'; ?></p>
                            <?php if ($row['Tersedia']): ?>
                            <form method="POST">
                                <input type="hidden" name="menu_id" value="<?php echo $row['MenuID']; ?>">
                                <label>Jumlah:</label><br>
                                <div class="input-body">
                                    <button type="button" class="btn-minus">-</button>
                                    <input type="number" name="jumlah" min="0" value="0">
                                    <button type="button" class="btn-plus">+</button>
                                </div>
                                <button type="submit">Tambah ke Keranjang</button>
                            </form>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </section>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Tidak ada menu tersedia.</p>
        <?php endif; ?>
    </main>
    <footer>
        <a href="../php/logout.php">Logout</a>
    </footer>
</body>
</html>
