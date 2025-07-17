<?php
session_start();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Beranda - Pemesanan Tiket Pesawat</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: url('Image/Pesawat2.jpg') no-repeat center center fixed;
            background-size: cover;
        }

        .navbar {
            background-color: #28a745;
            color: white;
            padding: 15px 30px;
            font-size: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar .brand {
            font-weight: bold;
        }

        .navbar .nav-link {
            color: white;
            text-decoration: none;
            font-size: 16px;
            padding: 8px 12px;
            border-radius: 4px;
            transition: background 0.3s;
        }

        .navbar .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.2);
        }

        .container {
            text-align: center;
            padding: 100px 20px;
        }

        h1 {
            font-size: 36px;
            color: black;
        }

        p {
            font-size: 18px;
            color: white;
            margin-bottom: 30px;
        }

        .btn {
            background-color: #28a745;
            color: white;
            padding: 12px 24px;
            text-decoration: none;
            border-radius: 6px;
            font-size: 16px;
            margin: 5px;
        }

        .btn:hover {
            opacity: 0.9;
        }

        footer {
            color: white;
            text-align: center;
            padding: 15px 0;
            font-size: 14px;
        }
    </style>
</head>
<body>

    <div class="navbar">
        <div class="brand">✈ HappyFlight</div>
        <div class="menu-link">
            <?php if (isset($_SESSION['user'])): ?>
                <a href="logout.php" class="nav-link">Logout</a>
            <?php else: ?>
                <a href="login.php" class="nav-link">Login/Daftar</a>
            <?php endif; ?>
        </div>
    </div>

    <div class="container">
        <?php if (isset($_SESSION['user'])): ?>
            <h1>Selamat Datang, <?= $_SESSION['user'] ?>!</h1>
            <p>"Aplikasi ini memudahkan Anda untuk memesan tiket pesawat dengan cara yang praktis, cepat, dan nyaman".</p>
            <a href="index.php" class="btn">Cek Sekarang!</a>
        <?php else: ?>
            <h1>Selamat Datang!</h1>
            <p>"Aplikasi ini memudahkan Anda untuk memesan tiket pesawat dengan cara yang praktis, cepat, dan nyaman".</p>
            <a href="login.php" class="btn">Cek Sekarang!</a>
        <?php endif; ?>
    </div>

    <br><br><br>

    <footer>
        &copy; <?= date('Y') ?> HappyFlight.com - All rights reserved.
    </footer>

</body>
</html>
