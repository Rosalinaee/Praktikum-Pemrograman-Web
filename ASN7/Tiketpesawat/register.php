<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $check = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");
    if (mysqli_num_rows($check) > 0) {
        $error = "Username sudah terdaftar.";
    } else {
        mysqli_query($conn, "INSERT INTO users (username, password) VALUES ('$username', '$password')");
        header("Location: login.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
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
    <h2>Register</h2>
    <?php if (isset($error)) echo "<div class='error'>$error</div>"; ?>
    <form method="post">
        <input type="text" name="username" placeholder="Username" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <button type="submit">Daftar</button>
    </form>
    <p>Sudah punya akun?</p> <a href="login.php">Login</a>
</div>
</body>
</html>
