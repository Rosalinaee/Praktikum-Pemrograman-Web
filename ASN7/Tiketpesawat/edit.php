<?php
include 'koneksi.php';

if (!isset($_GET['id'])) {
    echo "ID tidak ditemukan.";
    exit;
}

$id = intval($_GET['id']); // aman dari SQL injection dasar

// Ambil data awal
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM tiket_pesawat WHERE id = $id"));

if (!$data) {
    echo "Data tidak ditemukan.";
    exit;
}

// Jika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form dengan aman
    $nama_pemesan = mysqli_real_escape_string($conn, $_POST['nama_pemesan']);
    $dari = mysqli_real_escape_string($conn, $_POST['dari']);
    $ke   = mysqli_real_escape_string($conn, $_POST['ke']);
    $tanggal_berangkat = $_POST['tanggal_berangkat'];
    $jumlah_tiket = intval($_POST['jumlah_tiket']);
    $maskapai = mysqli_real_escape_string($conn, $_POST['maskapai']);

    // Update ke database
    $sql = "UPDATE tiket_pesawat SET
        nama_pemesan='$nama_pemesan',
        dari='$dari',
        ke='$ke',
        tanggal_berangkat='$tanggal_berangkat',
        jumlah_tiket=$jumlah_tiket,
        maskapai='$maskapai'
        WHERE id=$id";

    mysqli_query($conn, $sql);

    // Redirect
    header("Location: index.php");
    exit;
}

session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Pemesanan</title>
    <style>
        <?php include 'style.css'; ?>

         body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: url('Image/Pesawat2.jpg') no-repeat center center fixed;
            background-size: cover;
         }

        .btn-home {
            position: absolute;
            top: 20px;
            left: 20px;
            padding: 8px 16px;
            background-color: #f0f0f0;
            color: #333;
            text-decoration: none;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
        }

        .btn-home:hover {
            background-color: #e0e0e0;
        }
    </style>
</head>
<body>

    <!-- Tombol Home -->
    <a href="home.php" class="btn-home">✈Home</a>

    <div class="container">
        <h2>Edit Pemesanan Tiket</h2>
        <form action="edit.php?id=<?= $data['id'] ?>" method="post">
            <input type="hidden" name="id" value="<?= $data['id'] ?>">
            <div class="form-group">
                <label>Nama Pemesan</label>
                <input type="text" name="nama_pemesan" value="<?= $data['nama_pemesan'] ?>" required>
            </div>
            <div class="form-group">
                <label>Dari</label>
                <input type="text" name="dari" value="<?= $data['dari'] ?>" required>
            </div>
            <div class="form-group">
                <label>Ke</label>
                <input type="text" name="ke" value="<?= $data['ke'] ?>" required>
            </div>
            <div class="form-group">
                <label>Tanggal Berangkat</label>
                <input type="date" name="tanggal_berangkat" value="<?= $data['tanggal_berangkat'] ?>" required>
            </div>
            <div class="form-group">
                <label>Jumlah Tiket</label>
                <input type="number" name="jumlah_tiket" value="<?= $data['jumlah_tiket'] ?>" required>
            </div>
            <div class="form-group">
                <label>Maskapai</label>
                <input type="text" name="maskapai" value="<?= $data['maskapai'] ?>" required>
            </div>
            <button type="submit" class="btn btn-edit">Simpan Perubahan</button>
            <a href="index.php" class="btn btn-back">Kembali</a>
        </form>
    </div>
</body>
</html>
