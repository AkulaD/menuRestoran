<?php
include '../php/config.php';

session_start();
if (!isset($_SESSION['username'])) {
    header('Location: ../index.html');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Menu</title>
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
        <section class="order-list-content">
            <h1>List order</h1>
            <div class="order-list">
                <!-- Order list -->
                
            </div>
        </section>
    </main>
    
    <footer>
        <p>Version: <?php echo $version_info; ?></p>
    </footer>
</body>
</html>