<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

include 'koneksi.php';
$data = mysqli_query($conn, "SELECT * FROM tiket_pesawat");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Pemesanan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: white;
            margin: 0;
            padding: 20px;
            background: url('Image/Pesawat2.jpg') no-repeat center center fixed;
            background-size: cover;
        }

        h2 {
            color: #28a745;
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
        }
        th, td {
            padding: 12px;
            border: 1px solid #ccc;
            text-align: center;
        }
        th {
            background-color: #28a745;
            color: white;
        }
        a.btn-back {
            display: inline-block;
            margin-top: 30px;
            background-color: #28a745;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 6px;
        }
    </style>
</head>
<body>
    <h2>Daftar Pemesanan Tiket</h2>

    <table>
        <tr>
            <th>No</th>
            <th>Nama Pemesan</th>
            <th>Dari</th>
            <th>Ke</th>
            <th>Tanggal Berangkat</th>
            <th>Jumlah Tiket</th>
            <th>Maskapai</th>
            <th>Harga</th>
        </tr>
        <?php $no = 1; while($row = mysqli_fetch_assoc($data)): ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $row['nama_pemesan'] ?></td>
            <td><?= $row['dari'] ?></td>
            <td><?= $row['ke'] ?></td>
            <td><?= $row['tanggal_berangkat'] ?></td>
            <td><?= $row['jumlah_tiket'] ?></td>
            <td><?= $row['maskapai'] ?></td>
            <td><?= $row['harga'] ?></td>
        </tr>
        <?php endwhile; ?>
    </table>

    <center><a href="home.php" class="btn-back">Kembali ke Menu</a></center>
</body>
</html>
