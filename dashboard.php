<?php
include 'config.php';
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
                    <li><a href="dashboard.html">Home</a></li>
                    <li><a href="order.html">Order</a></li>
                    <li><a href="menu.html">Menu</a></li>
                    <li><a href="History.html">History</a></li>
                </ul>
            </div>
            <div class="right-nav">
                <ul>
                    <li><a href="logout.php">Logout</a></li>
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