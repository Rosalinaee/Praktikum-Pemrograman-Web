<?php
include 'koneksi.php';
$result = mysqli_query($conn, "SELECT * FROM tiket_pesawat");

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
    <title>Daftar Pemesanan Tiket Pesawat</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background: url('Image/Pesawat2.jpg') no-repeat center center fixed;
            background-size: cover;
        }

        .btn-home {
            position: absolute;
            top: 20px;
            left: 20px;
            background-color: white;
            color: #28a745;
            padding: 8px 16px;
            text-decoration: none;
            font-weight: bold;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 14px;
        }

        .btn-home:hover {
            background-color: #f0f0f0;
        }

        .container {
            width: 900px;
            margin: 0 auto;
            background: #fff;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        h2 {
            margin-top: 0;
            text-align: center;
            color: #333;
        }

        .btn {
            text-decoration: none;
            padding: 8px 12px;
            border-radius: 5px;
            margin-right: 5px;
            font-size: 14px;
        }

        .btn-add {
            background-color: #28a745;
            color: white;
        }

        .btn-edit {
            background-color: #ffc107;
            color: black;
        }

        .btn-delete {
            background-color: #dc3545;
            color: white;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th, table td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: center;
        }

        table th {
            background-color: #28a745;
            color: white;
        }
    </style>
</head>
<body>

<a href="home.php" class="btn-home">✈Home
    <a href="logout.php" style="
    position: absolute;
    top: 20px;
    right: 20px;
    background-color: #dc3545;
    color: white;
    padding: 8px 14px;
    text-decoration: none;
    border-radius: 5px;
    font-weight: bold;
">Logout</a>

</a>

<div class="container">
    <h2>Daftar Pemesanan Tiket Pesawat</h2>
    <a href="tambah.php" class="btn btn-add">Pesan Tiket</a>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Dari</th>
                <th>Ke</th>
                <th>Tanggal</th>
                <th>Jumlah</th>
                <th>Maskapai</th>
                <Th>Harga</Th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php $no = 1; while ($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $row['nama_pemesan'] ?></td>
                <td><?= $row['dari'] ?></td>
                <td><?= $row['ke'] ?></td>
                <td><?= $row['tanggal_berangkat'] ?></td>
                <td><?= $row['jumlah_tiket'] ?></td>
                <td><?= $row['maskapai'] ?></td>
                <td><?= $row['harga'] ?></td>
                <td>
                    <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-edit">Edit</a>
                    <a href="hapus.php?id=<?= $row['id'] ?>" class="btn btn-delete" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>
</body>
</html>
