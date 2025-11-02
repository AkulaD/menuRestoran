<?php
include '../php/config.php';
session_start();
if (!isset($_SESSION['username'])) {
    header('location: ../index.html');
    exit;
}

if (!isset($_GET['id'])) {
    header('location: menu.php');
    exit;
}

$id = intval($_GET['id']);
$query = "SELECT * FROM Menu WHERE MenuID = $id";
$result = $conn->query($query);

if (!$result || $result->num_rows === 0) {
    echo "Menu tidak ditemukan.";
    exit;
}

$row = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $deskripsi = $_POST['deskripsi'];
    $kategori = $_POST['kategori'];
    $harga = $_POST['harga'];
    $tersedia = isset($_POST['tersedia']) ? 1 : 0;

    if (!empty($_FILES['gambar']['name'])) {
        $target_dir = "../uploads/";
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        $target_file = $target_dir . basename($_FILES["gambar"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        $valid_ext = ['jpg', 'jpeg', 'png', 'gif'];
        if (in_array($imageFileType, $valid_ext)) {
            move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file);
            $gambarURL = "uploads/" . basename($_FILES["gambar"]["name"]);
        } else {
            echo "Format gambar tidak valid.";
            exit;
        }

        $update = "UPDATE Menu SET 
                    Nama='$nama', 
                    Deskripsi='$deskripsi', 
                    Kategori='$kategori', 
                    Harga='$harga', 
                    Tersedia='$tersedia', 
                    GambarURL='$gambarURL'
                    WHERE MenuID=$id";
    } else {
        $update = "UPDATE Menu SET 
                    Nama='$nama', 
                    Deskripsi='$deskripsi', 
                    Kategori='$kategori', 
                    Harga='$harga', 
                    Tersedia='$tersedia'
                    WHERE MenuID=$id";
    }

    if ($conn->query($update)) {
        header("Location: menu.php");
        exit;
    } else {
        echo "Gagal memperbarui data: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Menu</title>
</head>
<body>
    <h1>Edit Menu</h1>

    <form method="POST" enctype="multipart/form-data">
        <p>Nama: <input type="text" name="nama" value="<?php echo htmlspecialchars($row['Nama']); ?>" required></p>
        <p>Deskripsi: <textarea name="deskripsi" required><?php echo htmlspecialchars($row['Deskripsi']); ?></textarea></p>
        <p>Kategori: <input type="text" name="kategori" value="<?php echo htmlspecialchars($row['Kategori']); ?>" required></p>
        <p>Harga: <input type="number" name="harga" value="<?php echo htmlspecialchars($row['Harga']); ?>" required></p>
        <p>
            Status: 
            <label><input type="checkbox" name="tersedia" <?php echo $row['Tersedia'] ? 'checked' : ''; ?>> Tersedia</label>
        </p>
        <p>Gambar Saat Ini:</p>
        <img src="../<?php echo htmlspecialchars($row['GambarURL']); ?>" width="150"><br>
        <p>Ganti Gambar: <input type="file" name="gambar" accept="image/*"></p>
        <p><button type="submit">Simpan Perubahan</button></p>
    </form>

    <p><a href="menu.php">← Kembali ke Menu</a></p>
</body>
</html>
