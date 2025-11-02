<?php 
include '../php/config.php';

session_start();
if(!isset($_SESSION['username'])) {
    header('location: ../index.html');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add - Menu</title>
</head>
<body>
    <head>
        <a href="menu.php">Back</a>
    </head>

    <main>
        <section class="add-container">
            <h1>Add Menu</h1>
            <div class="form-content">
                <form action="../php/add-process.php" method="post"  enctype="multipart/form-data">
                    <div class="input-img">
                        <label for="img">Add Image (PNG)</label>
                        <input type="file" name="img" id="img" accept="image/*" required>
                    </div>
                    <div class="input-name">
                        <label for="name">Menu Name</label>
                        <input type="text" name="name" id="name" required>
                    </div>
                    <div class="input-deskripsi">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea name="deskripsi" id="deskripsi" required></textarea>
                    </div>
                    <div class="input-harga">
                        <label for="harga">Harga</label>
                        <input type="number" name="harga" id="harga" required>
                    </div>
                    <div class="input-kategori">
                        <label for="kategori">Kategori</label>
                        <select name="kategori" id="kategori" required>
                            <option value="Makanan">Makanan</option>
                            <option value="Minuman">Minuman</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                    </div>
                    <div class="input-submit">
                        <button type="submit">ADD</button>
                    </div>
                </form>
            </div>
        </section>
    </main>
</body>
</html>