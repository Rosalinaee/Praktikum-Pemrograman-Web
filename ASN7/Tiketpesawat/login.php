<?php
session_start();
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    $query = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");
    $user = mysqli_fetch_assoc($query);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user'] = $user['username'];
        header("Location: tambah.php");
        exit;
    } else {
        $error = "Username atau password salah.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
              margin: 0;
            font-family: Arial, sans-serif;
            background: url('Image/Pesawat2.jpg') no-repeat center center fixed;
            background-size: cover;
        }

    
        .form-box {
            width: 400px;
            margin: 100px auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px #ccc;
            text-align: center;
        }

        h2 {
            margin-bottom: 20px;
            color: #28a745;
        }

        input[type="text"],
        input[type="password"] {
            width: 90%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            background-color: #28a745;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
        }

        a {
            display: block;
            margin-top: 15px;
            color: #007bff;
            text-decoration: none;
        }

        .error {
            color: red;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
<div class="form-box">
    <h2>Login</h2>
    <?php if (isset($error)) echo "<div class='error'>$error</div>"; ?>
    <form method="post">
        <input type="text" name="username" placeholder="Username" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <button type="submit">Login</button>
    </form>
    <p>Belum punya akun?</p><a href="register.php">Daftar</a>
</div>
</body>
</html>
